@extends('layouts.guest')

@section('content')
<div class="space-y-8">
    <div class="text-center">
        <div class="mx-auto h-12 w-12 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
            <span class="text-white font-black text-2xl">S</span>
        </div>
        <h2 class="mt-6 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Welcome back</h2>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Sign in to manage your business</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
            <x-text-input id="email" class="block mt-1 w-full input-premium" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@sinodtech.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-indigo-600 hover:text-indigo-500 transition" href="{{ route('password.request') }}">
                        Forgot?
                    </a>
                @endif
            </div>
            <x-text-input id="password" class="block mt-1 w-full input-premium" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded-md border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-slate-900 dark:border-slate-700" name="remember">
            <label for="remember_me" class="ml-2 text-sm text-slate-600 dark:text-slate-400 font-medium cursor-pointer">{{ __('Keep me signed in') }}</label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary justify-center py-3 text-base">
                {{ __('Sign in') }}
            </button>
        </div>

        <div class="text-center">
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:text-indigo-500 transition">Get started</a>
            </p>
        </div>
    </form>
</div>
@endsection
