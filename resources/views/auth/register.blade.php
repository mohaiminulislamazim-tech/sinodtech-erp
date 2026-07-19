@extends('layouts.guest')

@section('content')
<div class="space-y-8">
    <div class="text-center">
        <div class="mx-auto h-12 w-12 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
            <span class="text-white font-black text-2xl">S</span>
        </div>
        <h2 class="mt-6 text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Create your account</h2>
        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Join SinodTech ERP platform</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-1">
            <x-input-label for="name" :value="__('Full Name')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
            <x-text-input id="name" class="block mt-1 w-full input-premium" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="space-y-1">
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
            <x-text-input id="email" class="block mt-1 w-full input-premium" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Branch & Role Selection -->
        <div class="grid grid-cols-2 gap-4">
            <div class="space-y-1">
                <x-input-label for="branch_id" :value="__('Primary Branch')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                <select id="branch_id" name="branch_id" class="block mt-1 w-full input-premium" required>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-1">
                <x-input-label for="role_id" :value="__('Designation')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
                <select id="role_id" name="role_id" class="block mt-1 w-full input-premium" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Password -->
        <div class="space-y-1">
            <x-input-label for="password" :value="__('Password')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
            <x-text-input id="password" class="block mt-1 w-full input-premium" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs font-bold uppercase tracking-wider text-slate-500" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full input-premium" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary justify-center py-3 text-base">
                {{ __('Create Account') }}
            </button>
        </div>

        <div class="text-center">
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500 transition">Sign in</a>
            </p>
        </div>
    </form>
</div>
@endsection
