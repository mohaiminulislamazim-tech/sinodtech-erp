@extends('layouts.app')

@section('content')
<div class="space-y-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">{{ $customer->name }}</h1>
            <p class="text-sm text-slate-500 mt-1 flex items-center">
                <svg class="w-4 h-4 mr-1 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                {{ $customer->email }}
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-5 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl font-bold text-sm hover:bg-slate-200 transition">
                Edit Profile
            </a>
            <button onclick="openPromoModal()" class="btn-primary">
                Send Promotion
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Stats -->
        <div class="lg:col-span-1 space-y-6">
            <div class="card-premium p-8">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">Customer Insights</h3>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-slate-500 text-sm">Total Orders</span>
                        <span class="font-bold text-slate-900 dark:text-white">{{ $customer->sales->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500 text-sm">Lifetime Value</span>
                        <span class="font-bold text-indigo-600 dark:text-indigo-400">${{ number_format($customer->sales->sum('total_amount'), 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500 text-sm">Last Purchase</span>
                        <span class="font-bold text-slate-900 dark:text-white">{{ $customer->sales->first()?->created_at->diffForHumans() ?? 'Never' }}</span>
                    </div>
                </div>
            </div>

            <div class="card-premium p-8">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Contact Details</h3>
                <p class="text-sm text-slate-900 dark:text-white font-medium">{{ $customer->phone }}</p>
                <p class="text-sm text-slate-500 mt-2 leading-relaxed">{{ $customer->address ?? 'No address registered.' }}</p>
            </div>
        </div>

        <!-- Sales Ledger -->
        <div class="lg:col-span-2 space-y-8">
            <div class="card-premium">
                <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-700 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/50">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Transaction History</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Order ID</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Date</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Amount</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                            @foreach($customer->sales as $sale)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                                <td class="px-8 py-4 text-sm font-bold text-slate-900 dark:text-white">#{{ $sale->id }}</td>
                                <td class="px-8 py-4 text-sm text-slate-500">{{ $sale->created_at->format('M d, Y') }}</td>
                                <td class="px-8 py-4 text-sm text-right font-bold text-slate-900 dark:text-white">${{ number_format($sale->total_amount, 2) }}</td>
                                <td class="px-8 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-400/10 dark:text-emerald-400 uppercase tracking-tighter">Completed</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Promo Modal -->
<div id="promo-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closePromoModal()"></div>
        <div class="relative bg-white dark:bg-slate-800 rounded-3xl shadow-2xl w-full max-w-lg p-8 transform transition-all">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6">Send Promotional Offer</h3>
            <form action="{{ route('promotions.send') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Email Subject</label>
                    <input type="text" name="title" class="input-premium" placeholder="e.g. Exclusive 20% Discount for You!" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Message Content</label>
                    <textarea name="content" rows="5" class="input-premium" placeholder="Write your personalized message here..." required></textarea>
                </div>
                <div class="pt-4 flex justify-end space-x-3">
                    <button type="button" onclick="closePromoModal()" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700">Cancel</button>
                    <button type="submit" class="btn-primary">Send Email</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openPromoModal() { document.getElementById('promo-modal').classList.remove('hidden'); }
    function closePromoModal() { document.getElementById('promo-modal').classList.add('hidden'); }
</script>
@endsection
