@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.principles.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">&larr; Back to Dashboard</a>
        <h1 class="mt-2 text-3xl font-bold text-slate-900">Add New Lesson</h1>
        <p class="mt-2 text-sm text-slate-600">Select a principle and fill in the lesson details below.</p>
    </div>

    <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl p-8">
        <form action="{{ route('admin.lessons.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="principle_id" class="block text-sm font-semibold text-slate-700">Select Principle</label>
                <select name="principle_id" id="principle_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" required>
                    <option value="">-- Choose a Principle --</option>
                    @foreach($principles as $principle)
                        <option value="{{ $principle->id }}">{{ $principle->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700">Lesson Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="e.g. Why Nutrition Matters" required>
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-slate-700">Content</label>
                <textarea name="content" id="content" rows="6" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="Explain the principle in detail..." required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="benefits" class="block text-sm font-semibold text-slate-700">Benefits (Optional)</label>
                    <textarea name="benefits" id="benefits" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"></textarea>
                </div>
                <div>
                    <label for="tips" class="block text-sm font-semibold text-slate-700">Practical Tips (Optional)</label>
                    <textarea name="tips" id="tips" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border"></textarea>
                </div>
            </div>

            <div>
                <label for="bible_verse" class="block text-sm font-semibold text-slate-700">Bible Verse (Optional)</label>
                <input type="text" name="bible_verse" id="bible_verse" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="e.g. Genesis 1:29">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Save Lesson
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
