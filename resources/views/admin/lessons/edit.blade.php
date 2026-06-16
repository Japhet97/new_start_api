@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.principles.show', $lesson->principle_id) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">&larr; Back to Principle</a>
        <h1 class="mt-2 text-3xl font-bold text-slate-900">Edit Lesson: {{ $lesson->title }}</h1>
    </div>

    <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl p-8">
        <form action="{{ route('admin.lessons.update', $lesson) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="principle_id" class="block text-sm font-semibold text-slate-700">Principle</label>
                <select name="principle_id" id="principle_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" required>
                    @foreach($principles as $principle)
                        <option value="{{ $principle->id }}" @if($lesson->principle_id == $principle->id) selected @endif>{{ $principle->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700">Lesson Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $lesson->title) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" required>
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700">Content</label>
                <textarea name="content" id="content" rows="6" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" required>{{ old('content', $lesson->content) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="benefits" class="block text-sm font-semibold text-slate-700">Benefits (Optional)</label>
                    <textarea name="benefits" id="benefits" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">{{ old('benefits', $lesson->benefits) }}</textarea>
                </div>
                <div>
                    <label for="tips" class="block text-sm font-semibold text-slate-700">Practical Tips (Optional)</label>
                    <textarea name="tips" id="tips" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">{{ old('tips', $lesson->tips) }}</textarea>
                </div>
            </div>

            <div>
                <label for="bible_verse" class="block text-sm font-semibold text-slate-700">Bible Verse (Optional)</label>
                <input type="text" name="bible_verse" id="bible_verse" value="{{ old('bible_verse', $lesson->bible_verse) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border">
            </div>

            <div class="pt-4 flex items-center justify-between">
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition">
                    Update Lesson
                </button>
                
                <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this lesson?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm font-bold text-rose-600 hover:text-rose-500">Delete Lesson</button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection
