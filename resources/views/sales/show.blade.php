@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Sale Detail #{{ $sale->id }}</h1>
        <div class="flex space-x-3">
            <a href="{{ route('sales.pdf', $sale) }}" class="inline-flex items-center px-4 py-2 bg-rose-600 text-white rounded-lg font-semibold text-xs uppercase tracking-widest hover:bg-rose-700 transition">
                Download PDF
            </a>
            <a href="{{ route('sales.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-lg font-semibold text-xs uppercase tracking-widest hover:bg-slate-200 transition">
                Back to List
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Items -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Line Items</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-slate-700">
                                <th class="px-6 py-4">Product</th>
                                <th class="px-6 py-4 text-right">Qty</th>
                                <th class="px-6 py-4 text-right">Unit Price</th>
                                <th class="px-6 py-4 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                            @foreach($sale->items as $item)
                            <tr>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $item->product->name }}</p>
                                    <p class="text-[10px] text-slate-400 font-mono uppercase">{{ $item->product->sku }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-right text-slate-600 dark:text-slate-400">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-sm text-right text-slate-600 dark:text-slate-400">${{ number_format($item->price, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-right font-bold text-slate-900 dark:text-white">${{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary & Customer -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-6">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-6">Payment Summary</h3>
                <div class="space-y-3 border-b border-slate-50 dark:border-slate-700 pb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Subtotal</span>
                        <span class="font-medium text-slate-900 dark:text-white">${{ number_format($sale->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Discount</span>
                        <span class="font-medium text-rose-600">-${{ number_format($sale->discount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Tax</span>
                        <span class="font-medium text-slate-900 dark:text-white">${{ number_format($sale->tax, 2) }}</span>
                    </div>
                </div>
                <div class="flex justify-between pt-4">
                    <span class="text-base font-bold text-slate-900 dark:text-white">Total Amount</span>
                    <span class="text-xl font-black text-indigo-600 dark:text-indigo-400">${{ number_format($sale->total_amount, 2) }}</span>
                </div>
                <div class="mt-6">
                    <span class="inline-flex w-full items-center justify-center rounded-xl px-4 py-2 bg-slate-50 dark:bg-slate-900 text-xs font-bold text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-slate-700">
                        Paid via {{ ucfirst($sale->payment_method) }}
                    </span>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-6">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Customer Info</h3>
                <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $sale->customer->name ?? 'Guest Customer' }}</p>
                @if($sale->customer)
                    <p class="text-xs text-slate-500 mt-1">{{ $sale->customer->email }}</p>
                    <p class="text-xs text-slate-500">{{ $sale->customer->phone }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
