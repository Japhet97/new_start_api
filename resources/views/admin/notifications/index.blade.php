@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Push Notifications</h1>
            <p class="mt-2 text-sm text-slate-600">Send a real-time message to all {{ $deviceCount }} registered devices.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-200 overflow-hidden">
        <form action="{{ route('admin.notifications.send') }}" method="POST" class="p-8">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-semibold text-slate-900">Notification Title</label>
                    <div class="mt-2">
                        <input type="text" name="title" id="title" required
                            placeholder="e.g., Drink Water!"
                            class="block w-full rounded-lg border-0 py-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <p class="mt-2 text-xs text-slate-500">Keep it short and catchy.</p>
                </div>

                <div>
                    <label for="body" class="block text-sm font-semibold text-slate-900">Message Content</label>
                    <div class="mt-2">
                        <textarea name="body" id="body" rows="4" required
                            placeholder="e.g., It's time for your 3rd glass of the day. Stay hydrated!"
                            class="block w-full rounded-lg border-0 py-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    <p class="mt-2 text-xs text-slate-500">This is the main text the user will see on their lock screen.</p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex items-center text-sm text-amber-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        This will be sent to <strong>{{ $deviceCount }}</strong> users instantly.
                    </div>
                    <button type="submit"
                        class="inline-flex items-center rounded-lg bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        Send Notification
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-12 bg-indigo-50 rounded-xl p-6 border border-indigo-100">
        <h2 class="text-lg font-bold text-indigo-900 mb-2">How it works</h2>
        <ul class="text-sm text-indigo-800 space-y-2">
            <li class="flex items-start">
                <span class="mr-2">•</span>
                <span>The system authenticates using your <strong>FIREBASE_CREDENTIALS</strong>.</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">•</span>
                <span>It loops through all tokens stored in the <strong>device_tokens</strong> table.</span>
            </li>
            <li class="flex items-start">
                <span class="mr-2">•</span>
                <span>Notifications are sent via <strong>FCM v1</strong> directly to the users' devices.</span>
            </li>
        </ul>
    </div>
</div>
@endsection
