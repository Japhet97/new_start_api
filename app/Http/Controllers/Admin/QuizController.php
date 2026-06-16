<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Principle;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function create()
    {
        $principles = Principle::all();
        return view('admin.quizzes.create', compact('principles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'principle_id' => 'required|exists:principles,id',
            'question' => 'required|string',
            'correct_answer' => 'required|string|max:1',
            'options' => 'required|array|min:2',
            'options.*.label' => 'required|string|max:1',
            'options.*.text' => 'required|string',
        ]);

        $quiz = Quiz::create([
            'principle_id' => $validated['principle_id'],
            'question' => $validated['question'],
            'correct_answer' => $validated['correct_answer'],
        ]);

        foreach ($validated['options'] as $option) {
            $quiz->options()->create([
                'option_label' => $option['label'],
                'option_text' => $option['text'],
            ]);
        }

        return redirect()->route('admin.principles.show', $validated['principle_id'])->with('success', 'Quiz added successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $principleId = $quiz->principle_id;
        $quiz->delete();
        return redirect()->route('admin.principles.show', $principleId)->with('success', 'Quiz deleted successfully.');
    }
}
