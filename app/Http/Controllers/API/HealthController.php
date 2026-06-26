<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Principle;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Http;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Log;

class HealthController extends Controller
{
    public function principles()
    {
        return Principle::all();
    }

    public function show($id)
    {
        return Principle::with([
            'lessons',
            'quizzes.options'
        ])->findOrFail($id);
    }

    public function saveToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string'
        ]);

        DeviceToken::updateOrCreate(
            ['token' => $request->token],
            ['token' => $request->token]
        );

        return response()->json(['message' => 'Token saved successfully']);
    }

    /**
     * Admin method to send push notifications to all registered devices.
     */
    public function sendPushNotification(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string'
        ]);

        $tokens = DeviceToken::pluck('token')->toArray();

        if (empty($tokens)) {
            return response()->json(['message' => 'No devices registered'], 400);
        }

        $credentialsJson = env('FIREBASE_CREDENTIALS');

        if (!$credentialsJson) {
            return response()->json([
                'message' => 'Firebase credentials not configured on server.',
                'error' => 'Missing FIREBASE_CREDENTIALS environment variable.'
            ], 500);
        }

        try {
            $credentials = json_decode($credentialsJson, true);
            $projectId = $credentials['project_id'] ?? null;

            if (!$projectId) {
                throw new \Exception("Invalid credentials: project_id not found.");
            }

            // Get OAuth2 Access Token
            $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
            $auth = new ServiceAccountCredentials($scopes, $credentials);
            $accessToken = $auth->fetchAuthToken()['access_token'];

            $successCount = 0;
            $failureCount = 0;

            foreach ($tokens as $token) {
                $response = Http::withToken($accessToken)->post("https://fcm.googleapis.com/v1/projects/$projectId/messages:send", [
                    'message' => [
                        'token' => $token,
                        'notification' => [
                            'title' => $request->title,
                            'body' => $request->body,
                        ],
                    ],
                ]);

                if ($response->successful()) {
                    $successCount++;
                } else {
                    $failureCount++;
                    Log::error("FCM Delivery Failed for token $token: " . $response->body());
                }
            }

            return response()->json([
                'message' => 'Notification dispatch complete',
                'summary' => [
                    'total_devices' => count($tokens),
                    'successful' => $successCount,
                    'failed' => $failureCount
                ]
            ]);

        } catch (\Exception $e) {
            Log::error("FCM Dispatch Error: " . $e->getMessage());
            return response()->json([
                'message' => 'Failed to dispatch notifications',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
