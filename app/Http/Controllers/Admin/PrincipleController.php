<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Principle;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizOption;
use Illuminate\Http\Request;

class PrincipleController extends Controller
{
    public function index()
    {
        $principles = Principle::withCount(['lessons', 'quizzes'])->get();
        return view('admin.principles.index', compact('principles'));
    }

    public function create()
    {
        return view('admin.principles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        $principle = Principle::create($validated);

        return redirect()->route('admin.principles.show', $principle)->with('success', 'Principle created successfully.');
    }

    public function edit(Principle $principle)
    {
        return view('admin.principles.edit', compact('principle'));
    }

    public function update(Request $request, Principle $principle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        $principle->update($validated);

        return redirect()->route('admin.principles.index')->with('success', 'Principle updated successfully.');
    }

    public function destroy(Principle $principle)
    {
        $principle->delete();
        return redirect()->route('admin.principles.index')->with('success', 'Principle deleted successfully.');
    }

    public function show(Principle $principle)
    {
        $principle->load(['lessons', 'quizzes.options']);
        return view('admin.principles.show', compact('principle'));
    }

    public function addLesson(Request $request, Principle $principle)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'benefits' => 'nullable|string',
            'tips' => 'nullable|string',
            'bible_verse' => 'nullable|string|max:255',
        ]);

        $principle->lessons()->create($validated);

        return back()->with('success', 'Lesson added successfully.');
    }

    public function addQuiz(Request $request, Principle $principle)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'correct_answer' => 'required|string|max:1',
            'options' => 'required|array|min:2',
            'options.*.label' => 'required|string|max:1',
            'options.*.text' => 'required|string',
        ]);

        $quiz = $principle->quizzes()->create([
            'question' => $validated['question'],
            'correct_answer' => $validated['correct_answer'],
        ]);

        foreach ($validated['options'] as $option) {
            $quiz->options()->create([
                'option_label' => $option['label'],
                'option_text' => $option['text'],
            ]);
        }

        return back()->with('success', 'Quiz added successfully.');
    }
}
