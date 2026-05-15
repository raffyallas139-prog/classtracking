@extends('layouts.app')

@content
<div class="max-w-md mx-auto mt-16 bg-white border border-slate-200 rounded-xl p-8 shadow-sm">
    <h2 class="text-2xl font-bold text-slate-900 text-center mb-1">Welcome Back</h2>
    <p class="text-sm text-slate-500 text-center mb-6">Log in to manage laboratory tracking details</p>

    @if($errors->any())
        <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="/login" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Email Address</label>
            <input type="email" name="email" required class="w-full border border-slate-200 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1">Password</label>
            <input type="password" name="password" required class="w-full border border-slate-200 rounded-lg p-3 text-sm focus:outline-none focus:border-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium p-3 rounded-lg text-sm mt-2 transition-colors">
            Log In
        </button>
    </form>
</div>
@endsection