@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Categories</h1>
        <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
            Add Category
        </a>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-6 flex flex-col justify-between hover:shadow-md transition">
            <div>
                <div class="h-12 w-12 rounded-xl bg-indigo-50 dark:bg-indigo-400/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $category->name }}</h3>
                <p class="text-sm text-slate-500 mt-1">{{ $category->products_count }} Products</p>
            </div>
            
            <div class="mt-6 flex justify-end space-x-2 border-t border-slate-50 dark:border-slate-700 pt-4">
                <a href="{{ route('categories.show', $category) }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-900">View Items</a>
                <a href="{{ route('categories.edit', $category) }}" class="text-xs font-bold text-slate-600 hover:text-slate-900">Edit</a>
            </div>
        </div>
        @endforeach
    </div>

    @if($categories->hasPages())
    <div class="pt-6">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection
