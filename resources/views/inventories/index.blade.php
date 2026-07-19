@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Inventory Management</h1>
        <div class="flex gap-2">
            <a href="{{ route('inventories.transfer.form') }}" class="inline-flex items-center px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition font-semibold text-xs uppercase tracking-widest">
                Transfer Stock
            </a>
            <a href="{{ route('inventories.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                New Record
            </a>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-4">
        <form action="{{ route('inventories.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products or branches..." class="w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700">
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Branch</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($inventories as $inventory)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $inventory->product->name }}</div>
                            <div class="text-xs text-slate-500 font-mono">{{ $inventory->product->sku }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2 py-1 rounded-md bg-slate-100 dark:bg-slate-900 text-xs font-medium text-slate-700 dark:text-slate-300">
                                {{ $inventory->branch->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold {{ $inventory->quantity <= $inventory->low_stock_threshold ? 'text-rose-600' : 'text-slate-900 dark:text-white' }}">
                                {{ $inventory->quantity }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($inventory->quantity <= 0)
                                <span class="inline-flex items-center rounded-full bg-rose-50 px-2 py-1 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-600/20 dark:bg-rose-400/10 dark:text-rose-400">Out of Stock</span>
                            @elseif($inventory->quantity <= $inventory->low_stock_threshold)
                                <span class="inline-flex items-center rounded-full bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20 dark:bg-amber-400/10 dark:text-amber-400">Low Stock</span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20 dark:bg-emerald-400/10 dark:text-emerald-400">Healthy</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <button onclick="openAdjustModal({{ $inventory->id }}, {{ $inventory->quantity }})" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 transition text-sm">Adjust</button>
                            <a href="{{ route('inventories.edit', $inventory) }}" class="text-slate-600 hover:text-slate-900 dark:text-slate-400 transition text-sm">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($inventories->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700">
            {{ $inventories->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Simple Adjustment Modal -->
<div id="adjust-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-slate-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeAdjustModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full p-6">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Adjust Stock Level</h3>
            <form id="adjust-form" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">New Quantity</label>
                        <input type="number" name="quantity" id="adjust-qty" class="mt-1 w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Reason for adjustment</label>
                        <input type="text" name="reason" placeholder="e.g. Stock audit, breakage..." class="mt-1 w-full rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white" required>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeAdjustModal()" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-bold">Update Inventory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openAdjustModal(id, currentQty) {
        document.getElementById('adjust-form').action = `/inventories/${id}/adjust`;
        document.getElementById('adjust-qty').value = currentQty;
        document.getElementById('adjust-modal').classList.remove('hidden');
    }
    function closeAdjustModal() {
        document.getElementById('adjust-modal').classList.add('hidden');
    }
</script>
@endsection
