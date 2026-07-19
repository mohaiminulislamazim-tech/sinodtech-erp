@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Branches</h1>
        <a href="{{ route('branches.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
            Register Branch
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-4">
        <form action="{{ route('branches.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or location..." class="w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-indigo-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-200 transition">
                Search
            </button>
        </form>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($branches as $branch)
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
            <div>
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $branch->name }}</h3>
                    <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 dark:bg-indigo-400/10 dark:text-indigo-400">
                        Active
                    </span>
                </div>
                <p class="mt-2 text-sm text-slate-500 flex items-center">
                    <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $branch->location }}
                </p>

                <div class="mt-6 grid grid-cols-2 gap-4 border-t border-slate-50 dark:border-slate-700 pt-4">
                    <div class="text-center">
                        <p class="text-[10px] uppercase font-bold text-slate-400">Employees</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $branch->employees_count }}</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] uppercase font-bold text-slate-400">Stock Items</p>
                        <p class="text-lg font-bold text-slate-900 dark:text-white">{{ $branch->inventories_count }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('branches.show', $branch) }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-900 transition">View Dashboard</a>
                <a href="{{ route('branches.edit', $branch) }}" class="text-sm font-bold text-slate-600 hover:text-slate-900 transition">Settings</a>
            </div>
        </div>
        @endforeach
    </div>

    @if($branches->hasPages())
    <div class="pt-6">
        {{ $branches->links() }}
    </div>
    @endif
</div>
@endsection
