@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Product Detail</h1>
            <p class="text-sm text-slate-500 mt-1">Manage specifications and stock levels for this item.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('products.edit', $product) }}" class="btn-primary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Specifications
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-8">
            <div class="card-premium p-8">
                <div class="flex items-start justify-between">
                    <div class="space-y-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400 uppercase tracking-widest">
                            {{ $product->category->name ?? 'General' }}
                        </span>
                        <h2 class="text-4xl font-black text-slate-900 dark:text-white">{{ $product->name }}</h2>
                        <p class="text-slate-500 dark:text-slate-400 leading-relaxed">{{ $product->description ?? 'No description provided for this product.' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Base Price</p>
                        <p class="text-3xl font-black text-indigo-600 dark:text-indigo-400">${{ number_format($product->price, 2) }}</p>
                    </div>
                </div>

                <div class="mt-12 grid grid-cols-3 gap-6 border-t border-slate-50 dark:border-slate-700 pt-8">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">SKU Identification</p>
                        <p class="text-sm font-mono font-bold text-slate-900 dark:text-white tracking-tighter">{{ $product->sku }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Inventory</p>
                        <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $product->inventories->sum('quantity') }} Units</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Lifetime Sales</p>
                        <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $product->saleItems->sum('quantity') }} Sold</p>
                    </div>
                </div>
            </div>

            <!-- Sales History -->
            <div class="card-premium">
                <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Recent Sales Activity</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-900/50">
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Date</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Customer</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Quantity</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Revenue</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                            @foreach($product->saleItems->take(10) as $item)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                <td class="px-8 py-4 text-sm text-slate-500">{{ $item->created_at->format('M d, Y') }}</td>
                                <td class="px-8 py-4 text-sm font-bold text-slate-900 dark:text-white">{{ $item->sale->customer->name ?? 'Guest' }}</td>
                                <td class="px-8 py-4 text-sm text-right font-mono">{{ $item->quantity }}</td>
                                <td class="px-8 py-4 text-sm text-right font-bold text-slate-900 dark:text-white">${{ number_format($item->quantity * $item->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar Stock Info -->
        <div class="space-y-8">
            <div class="card-premium p-8">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Stock by Branch</h3>
                <div class="space-y-6">
                    @forelse($product->inventories as $inventory)
                    <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-slate-900 ring-1 ring-slate-100 dark:ring-slate-800 transition hover:ring-indigo-500/30">
                        <div>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $inventory->branch->name }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">{{ $inventory->branch->location }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-black {{ $inventory->quantity <= $inventory->low_stock_threshold ? 'text-rose-600' : 'text-slate-900 dark:text-white' }}">
                                {{ $inventory->quantity }}
                            </p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Available</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10 px-4 border-2 border-dashed border-slate-100 dark:border-slate-800 rounded-2xl">
                        <p class="text-sm text-slate-400 font-medium">No stock records found.</p>
                        <a href="{{ route('inventories.create') }}" class="mt-4 inline-block text-xs font-bold text-indigo-600 hover:text-indigo-500">Initialize Stock</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
