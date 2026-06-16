@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.principles.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">&larr; Back to Dashboard</a>
        <div class="flex items-center justify-between mt-2">
            <h1 class="text-3xl font-bold text-slate-900">{{ $principle->name }}</h1>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.principles.edit', $principle) }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-500 underline">Edit Principle</a>
                <span class="text-slate-300">|</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                    Principle ID: {{ $principle->id }}
                </span>
            </div>
        </div>
    </div>

    <div class="space-y-12">
        <!-- Lessons Section -->
        <section>
            <div class="flex items-center justify-between mb-6 border-b border-slate-200 pb-4">
                <h2 class="text-2xl font-bold text-slate-800">Lessons</h2>
                <a href="{{ route('admin.lessons.create', ['principle_id' => $principle->id]) }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-500 underline">+ Add Lesson</a>
            </div>
            
            @if($principle->lessons->isEmpty())
                <div class="bg-white rounded-lg border-2 border-dashed border-slate-300 p-8 text-center text-slate-500">
                    No lessons added yet for this principle.
                </div>
            @else
                <div class="grid gap-6">
                    @foreach($principle->lessons as $lesson)
                        <div class="bg-white p-6 rounded-xl shadow-sm ring-1 ring-slate-200 group">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-slate-900">{{ $lesson->title }}</h3>
                                <div class="flex space-x-3 opacity-0 group-hover:opacity-100 transition">
                                    <a href="{{ route('admin.lessons.edit', $lesson) }}" class="text-sm font-bold text-indigo-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Delete this lesson?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-bold text-rose-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-slate-600 line-clamp-3 mb-4">{{ $lesson->content }}</p>
                            @if($lesson->bible_verse)
                                <div class="text-sm font-medium text-indigo-600 italic">"{{ $lesson->bible_verse }}"</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Quizzes Section -->
        <section>
            <div class="flex items-center justify-between mb-6 border-b border-slate-200 pb-4">
                <h2 class="text-2xl font-bold text-slate-800">Quizzes</h2>
                <a href="{{ route('admin.quizzes.create', ['principle_id' => $principle->id]) }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-500 underline">+ Add Quiz</a>
            </div>

            @if($principle->quizzes->isEmpty())
                <div class="bg-white rounded-lg border-2 border-dashed border-slate-300 p-8 text-center text-slate-500">
                    No quiz questions added yet for this principle.
                </div>
            @else
                <div class="grid gap-6">
                    @foreach($principle->quizzes as $quiz)
                        <div class="bg-white p-6 rounded-xl shadow-sm ring-1 ring-slate-200 group">
                            <div class="flex justify-between items-start mb-4">
                                <p class="text-lg font-semibold text-slate-900">{{ $quiz->question }}</p>
                                <div class="flex items-center space-x-3">
                                    <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2 py-1 rounded">Correct: {{ $quiz->correct_answer }}</span>
                                    <form action="{{ route('admin.quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Delete this quiz question?');" class="opacity-0 group-hover:opacity-100 transition">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm font-bold text-rose-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($quiz->options as $option)
                                    <div class="p-3 rounded-lg border @if($quiz->correct_answer == $option->option_label) border-emerald-500 bg-emerald-50 @else border-slate-200 bg-slate-50 @endif text-sm">
                                        <span class="font-bold text-slate-500 mr-2">{{ $option->option_label }}.</span> {{ $option->option_text }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
</div>
@endsection
