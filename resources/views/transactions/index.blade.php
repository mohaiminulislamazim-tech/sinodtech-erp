@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Financial Transaction Ledger</h1>
            <p class="text-sm text-slate-500 mt-1 flex items-center">
                <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Detailed audit trail of all income and expenses.
            </p>
        </div>
        <a href="{{ route('transactions.create') }}" class="btn-primary">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Manual Entry
        </a>
    </div>

    <!-- Filters -->
    <div class="card-premium p-6">
        <form action="{{ route('transactions.index') }}" method="GET" class="flex flex-col md:flex-row gap-6">
            <div class="flex-1">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Branch Location</label>
                <select name="branch_id" class="input-premium">
                    <option value="">All Global Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-64">
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Flow Type</label>
                <select name="type" class="input-premium">
                    <option value="">All Cash Flows</option>
                    <option value="income" {{ request('type') == 'income' ? 'selected' : '' }}>Revenue/Income</option>
                    <option value="expense" {{ request('type') == 'expense' ? 'selected' : '' }}>Operating Expense</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full md:w-auto px-8 py-2.5 bg-slate-900 dark:bg-indigo-600 text-white rounded-xl font-bold text-sm hover:opacity-90 transition shadow-lg shadow-indigo-500/10">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Ledger Table -->
    <div class="card-premium">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-800">
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Transaction Date</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Origin Branch</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Description & Reference</th>
                        <th class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Amount (USD)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-800/50">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/30 transition-colors">
                        <td class="px-8 py-5 text-sm text-slate-500 font-medium">{{ $transaction->created_at->format('M d, Y') }} <span class="text-[10px] text-slate-400 ml-1">{{ $transaction->created_at->format('H:i') }}</span></td>
                        <td class="px-8 py-5">
                            <div class="flex items-center">
                                <div class="h-2 w-2 rounded-full bg-indigo-500 mr-2"></div>
                                <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $transaction->branch->name ?? 'Global' }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $transaction->description }}</p>
                            @if($transaction->sale)
                                <a href="{{ route('sales.show', $transaction->sale) }}" class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 hover:underline">REFERENCE: SALE #{{ $transaction->sale->id }}</a>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-right">
                            <span class="text-base font-black {{ $transaction->type === 'income' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $transaction->type === 'income' ? '+' : '-' }} ${{ number_format($transaction->amount, 2) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="h-16 w-16 bg-slate-50 dark:bg-slate-900 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </div>
                                <p class="text-slate-500 font-medium">No transactions matching your criteria.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
        <div class="px-8 py-6 border-t border-slate-50 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-900/30">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
