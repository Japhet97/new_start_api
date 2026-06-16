@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.principles.index') }}" class="text-blue-600 hover:underline">&larr; Back to Principles</a>
    <h1 class="text-3xl font-bold text-gray-800 mt-2">Manage: {{ $principle->name }}</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Lessons Section -->
    <div>
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Lessons</h2>
        @foreach($principle->lessons as $lesson)
            <div class="bg-white p-4 rounded shadow mb-3">
                <h3 class="font-bold">{{ $lesson->title }}</h3>
                <p class="text-sm text-gray-600 truncate">{{ $lesson->content }}</p>
            </div>
        @endforeach

        <div class="bg-gray-200 p-6 rounded-lg mt-4">
            <h3 class="font-bold mb-4">Add Lesson</h3>
            <form action="{{ route('admin.principles.addLesson', $principle) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="title" placeholder="Lesson Title" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <textarea name="content" placeholder="Content" class="w-full border rounded px-3 py-2 h-24" required></textarea>
                </div>
                <div class="mb-3">
                    <textarea name="benefits" placeholder="Benefits (Optional)" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <div class="mb-3">
                    <input type="text" name="bible_verse" placeholder="Bible Verse (Optional)" class="w-full border rounded px-3 py-2">
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 w-full">Add Lesson</button>
            </form>
        </div>
    </div>

    <!-- Quizzes Section -->
    <div>
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Quizzes</h2>
        @foreach($principle->quizzes as $quiz)
            <div class="bg-white p-4 rounded shadow mb-3">
                <p class="font-bold">{{ $quiz->question }}</p>
                <p class="text-sm text-green-600">Correct: {{ $quiz->correct_answer }}</p>
            </div>
        @endforeach

        <div class="bg-gray-200 p-6 rounded-lg mt-4">
            <h3 class="font-bold mb-4">Add Quiz</h3>
            <form action="{{ route('admin.principles.addQuiz', $principle) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="question" placeholder="Question" class="w-full border rounded px-3 py-2" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="correct_answer" placeholder="Correct Answer (e.g. A)" class="w-full border rounded px-3 py-2" required maxlength="1">
                </div>
                
                <h4 class="font-bold text-sm mb-2 uppercase">Options</h4>
                <div class="grid grid-cols-2 gap-2 mb-3">
                    <div>
                        <input type="hidden" name="options[0][label]" value="A">
                        <input type="text" name="options[0][text]" placeholder="Option A text" class="w-full border rounded px-2 py-1 text-sm" required>
                    </div>
                    <div>
                        <input type="hidden" name="options[1][label]" value="B">
                        <input type="text" name="options[1][text]" placeholder="Option B text" class="w-full border rounded px-2 py-1 text-sm" required>
                    </div>
                </div>

                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 w-full">Add Quiz</button>
            </form>
        </div>
    </div>
</div>
@endsection
