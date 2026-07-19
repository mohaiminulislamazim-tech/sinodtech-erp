@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Employees</h1>
        <a href="{{ route('employees.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
            Add Employee
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-4">
        <form action="{{ route('employees.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..." class="w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-indigo-500">
            </div>
            <div class="w-full md:w-48">
                <select name="branch_id" class="w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-indigo-500">
                    <option value="">All Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-200 transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($employees as $employee)
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="h-12 w-12 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 font-bold">
                    {{ strtoupper(substr($employee->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ $employee->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ $employee->email }}</p>
                </div>
                <div>
                    <span class="inline-flex items-center rounded-full px-2 py-1 text-xs font-medium {{ $employee->status === 'active' ? 'bg-emerald-50 text-emerald-700 ring-emerald-600/20' : 'bg-slate-50 text-slate-700 ring-slate-600/20' }} ring-1 ring-inset">
                        {{ ucfirst($employee->status) }}
                    </span>
                </div>
            </div>
            
            <div class="mt-6 border-t border-slate-50 dark:border-slate-700 pt-4 grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-tight">Branch</p>
                    <p class="text-sm text-slate-900 dark:text-white">{{ $employee->branch->name ?? 'None' }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase font-bold text-slate-400 tracking-tight">Joined</p>
                    <p class="text-sm text-slate-900 dark:text-white">{{ $employee->created_at->format('M Y') }}</p>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('employees.show', $employee) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-900 transition">Profile</a>
                <a href="{{ route('employees.edit', $employee) }}" class="text-xs font-bold text-slate-600 hover:text-slate-900 transition">Manage</a>
            </div>
        </div>
        @endforeach
    </div>

    @if($employees->hasPages())
    <div class="pt-6">
        {{ $employees->links() }}
    </div>
    @endif
</div>
@endsection
