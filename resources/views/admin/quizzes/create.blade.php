@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.principles.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">&larr; Back to Dashboard</a>
        <h1 class="mt-2 text-3xl font-bold text-slate-900">Add New Quiz</h1>
        <p class="mt-2 text-sm text-slate-600">Select a principle and create a question with multiple choices.</p>
    </div>

    <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl p-8">
        <form action="{{ route('admin.quizzes.store') }}" method="POST" class="space-y-6">
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
                <label for="question" class="block text-sm font-semibold text-slate-700">Question</label>
                <input type="text" name="question" id="question" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="e.g. Which of these is a healthy fat?" required>
            </div>

            <div>
                <label for="correct_answer" class="block text-sm font-semibold text-slate-700">Correct Answer Letter</label>
                <select name="correct_answer" id="correct_answer" class="mt-1 block w-64 rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" required>
                    <option value="A">Option A</option>
                    <option value="B">Option B</option>
                    <option value="C">Option C</option>
                    <option value="D">Option D</option>
                </select>
            </div>

            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider">Answer Options</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 rounded-lg">
                        <label class="block text-xs font-bold text-indigo-600 uppercase mb-2">Option A</label>
                        <input type="hidden" name="options[0][label]" value="A">
                        <input type="text" name="options[0][text]" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="Option A text" required>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-lg">
                        <label class="block text-xs font-bold text-indigo-600 uppercase mb-2">Option B</label>
                        <input type="hidden" name="options[1][label]" value="B">
                        <input type="text" name="options[1][text]" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="Option B text" required>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-lg">
                        <label class="block text-xs font-bold text-indigo-600 uppercase mb-2">Option C (Optional)</label>
                        <input type="hidden" name="options[2][label]" value="C">
                        <input type="text" name="options[2][text]" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="Option C text">
                    </div>

                    <div class="p-4 bg-slate-50 rounded-lg">
                        <label class="block text-xs font-bold text-indigo-600 uppercase mb-2">Option D (Optional)</label>
                        <input type="hidden" name="options[3][label]" value="D">
                        <input type="text" name="options[3][text]" class="block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="Option D text">
                    </div>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Save Quiz Question
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
