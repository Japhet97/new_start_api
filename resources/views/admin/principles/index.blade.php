@extends('layouts.admin')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Health Principles</h1>
        <p class="mt-2 text-sm text-slate-600">Click a principle to modify its lessons and quiz questions.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($principles as $principle)
    <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden hover:shadow-md transition group">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="h-12 w-12 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-700 font-bold text-xl group-hover:bg-indigo-600 group-hover:text-white transition">
                    {{ substr($principle->name, 0, 1) }}
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.principles.edit', $principle) }}" class="p-2 text-slate-400 hover:text-indigo-600 transition" title="Edit Principle">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </a>
                </div>
            </div>
            
            <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $principle->name }}</h3>
            
            <div class="flex items-center space-x-4 mb-6 text-sm">
                <span class="text-slate-500"><span class="font-bold text-slate-900">{{ $principle->lessons_count }}</span> Lessons</span>
                <span class="text-slate-500"><span class="font-bold text-slate-900">{{ $principle->quizzes_count }}</span> Quizzes</span>
            </div>

            <a href="{{ route('admin.principles.show', $principle) }}" class="block w-full text-center py-2 px-4 rounded-lg bg-slate-100 text-slate-700 font-bold hover:bg-indigo-600 hover:text-white transition">
                Manage Content
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection
