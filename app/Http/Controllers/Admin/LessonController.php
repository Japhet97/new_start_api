<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Principle;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function create()
    {
        $principles = Principle::all();
        return view('admin.lessons.create', compact('principles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'principle_id' => 'required|exists:principles,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'benefits' => 'nullable|string',
            'tips' => 'nullable|string',
            'bible_verse' => 'nullable|string|max:255',
        ]);

        Lesson::create($validated);

        return redirect()->route('admin.principles.index')->with('success', 'Lesson added successfully.');
    }
}
