@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.principles.index') }}" class="text-blue-600 hover:underline">&larr; Back to Principles</a>
    <h1 class="text-3xl font-bold text-gray-800 mt-2">Add New Principle</h1>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('admin.principles.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Principle Name</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required placeholder="e.g. Nutrition">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Image URL (Optional)</label>
            <input type="text" name="image" class="w-full border rounded px-3 py-2" placeholder="e.g. nutrition.png">
        </div>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save Principle</button>
    </form>
</div>
@endsection
