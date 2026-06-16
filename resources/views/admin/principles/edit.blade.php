@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.principles.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">&larr; Back to Dashboard</a>
        <h1 class="mt-2 text-3xl font-bold text-slate-900">Edit Principle: {{ $principle->name }}</h1>
        <p class="mt-2 text-sm text-slate-600">Update the principle's basic information.</p>
    </div>

    <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-xl p-8">
        <form action="{{ route('admin.principles.update', $principle) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700">Principle Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $principle->name) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" required>
            </div>

            <div>
                <label for="image" class="block text-sm font-semibold text-slate-700">Icon/Image Path</label>
                <input type="text" name="image" id="image" value="{{ old('image', $principle->image) }}" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2 border" placeholder="assets/icons/name.png">
                <p class="mt-1 text-xs text-slate-500 italic">This path is used by the app to find the correct icon.</p>
            </div>

            <div class="pt-4 flex items-center justify-between">
                <button type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    Update Principle
                </button>
                
                <form action="{{ route('admin.principles.destroy', $principle) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this principle? All related lessons and quizzes will be removed.');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm font-bold text-rose-600 hover:text-rose-500">Delete Principle</button>
                </form>
            </div>
        </form>
    </div>
</div>
@endsection
