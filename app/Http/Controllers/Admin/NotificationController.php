<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceToken;
use Illuminate\Support\Facades\Http;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function index()
    {
        $deviceCount = DeviceToken::count();
        return view('admin.notifications.index', compact('deviceCount'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:500'
        ]);

        $tokens = DeviceToken::pluck('token')->toArray();

        if (empty($tokens)) {
            return back()->withErrors(['error' => 'No devices registered to receive notifications.']);
        }

        $credentialsJson = env('FIREBASE_CREDENTIALS');

        if (!$credentialsJson) {
            return back()->withErrors(['error' => 'Firebase credentials not configured on server (Missing FIREBASE_CREDENTIALS).']);
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

            return back()->with('success', "Notification dispatch complete! Sent to $successCount devices ($failureCount failed).");

        } catch (\Exception $e) {
            Log::error("FCM Dispatch Error: " . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to dispatch notifications: ' . $e->getMessage()]);
        }
    }
}
