<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Principle;

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
}