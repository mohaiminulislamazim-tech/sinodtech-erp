@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Point of Sale</h1>
        <div class="text-sm text-slate-500 dark:text-slate-400">
            Branch: <span class="font-semibold text-slate-900 dark:text-white">{{ Auth::user()->employee->branch->name ?? 'Default' }}</span>
        </div>
    </div>

    <form action="{{ route('sales.store') }}" method="POST" id="pos-form" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        <!-- Product Selection -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Search Products</label>
                    <div class="relative">
                        <input type="text" id="product-search" placeholder="Scan barcode or type name..." class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 pl-10">
                        <svg class="w-5 h-5 absolute left-3 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>

                <!-- Cart Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-100 dark:border-slate-700">
                                <th class="py-3">Product</th>
                                <th class="py-3">Price</th>
                                <th class="py-3">Qty</th>
                                <th class="py-3">Total</th>
                                <th class="py-3 text-right"></th>
                            </tr>
                        </thead>
                        <tbody id="cart-items" class="divide-y divide-slate-50 dark:divide-slate-700/50">
                            <!-- Items added via JS -->
                        </tbody>
                    </table>
                    <div id="empty-cart" class="py-12 text-center text-slate-500 dark:text-slate-400">
                        <p>No items in cart</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Sidebar -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 p-6 sticky top-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-6">Order Summary</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Customer</label>
                        <select name="customer_id" class="w-full rounded-xl border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="border-t border-slate-100 dark:border-slate-700 pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Subtotal</span>
                            <span id="summary-subtotal" class="font-medium text-slate-900 dark:text-white">$0.00</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Discount</span>
                            <input type="number" name="discount" id="pos-discount" value="0" class="w-20 text-right rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 dark:text-white text-sm py-1">
                        </div>
                        <div class="flex justify-between text-lg font-bold border-t border-slate-100 dark:border-slate-700 pt-4">
                            <span class="text-slate-900 dark:text-white">Total</span>
                            <span id="summary-total" class="text-indigo-600 dark:text-indigo-400">$0.00</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Payment Method</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="relative flex cursor-pointer rounded-xl border border-slate-200 dark:border-slate-700 p-3 focus:outline-none transition hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                <input type="radio" name="payment_method" value="cash" checked class="sr-only">
                                <span class="text-sm font-medium text-slate-900 dark:text-white">Cash</span>
                            </label>
                            <label class="relative flex cursor-pointer rounded-xl border border-slate-200 dark:border-slate-700 p-3 focus:outline-none transition hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                <input type="radio" name="payment_method" value="card" class="sr-only">
                                <span class="text-sm font-medium text-slate-900 dark:text-white">Card</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-lg shadow-lg shadow-indigo-200 dark:shadow-none transition-transform active:scale-[0.98]">
                        Complete Sale
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Minimalistic POS cart logic
    let cart = [];
    const products = @json($products);

    document.getElementById('product-search').addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        if (query.length < 2) return;

        const product = products.find(p => p.name.toLowerCase().includes(query) || p.sku.toLowerCase().includes(query));
        if (product) {
            addToCart(product);
            e.target.value = '';
        }
    });

    function addToCart(product) {
        const existing = cart.find(item => item.id === product.id);
        if (existing) {
            existing.qty++;
        } else {
            cart.push({ ...product, qty: 1 });
        }
        renderCart();
    }

    function renderCart() {
        const tbody = document.getElementById('cart-items');
        const empty = document.getElementById('empty-cart');
        tbody.innerHTML = '';
        
        if (cart.length === 0) {
            empty.classList.remove('hidden');
        } else {
            empty.classList.add('hidden');
            let subtotal = 0;
            cart.forEach((item, index) => {
                const total = item.price * item.qty;
                subtotal += total;
                tbody.innerHTML += `
                    <tr class="text-sm">
                        <td class="py-4 font-medium text-slate-900 dark:text-white">${item.name}<input type="hidden" name="items[${index}][product_id]" value="${item.id}"></td>
                        <td class="py-4">$${item.price}<input type="hidden" name="items[${index}][price]" value="${item.price}"></td>
                        <td class="py-4">
                            <input type="number" name="items[${index}][quantity]" value="${item.qty}" class="w-16 rounded-lg border-slate-200 dark:border-slate-700 dark:bg-slate-900 py-1" onchange="updateQty(${item.id}, this.value)">
                        </td>
                        <td class="py-4 font-semibold">$${total.toFixed(2)}</td>
                        <td class="py-4 text-right">
                            <button type="button" onclick="removeItem(${item.id})" class="text-rose-500 hover:text-rose-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </td>
                    </tr>
                `;
            });
            updateSummary(subtotal);
        }
    }

    function updateQty(id, qty) {
        const item = cart.find(i => i.id === id);
        if (item) item.qty = parseInt(qty);
        renderCart();
    }

    function removeItem(id) {
        cart = cart.filter(i => i.id !== id);
        renderCart();
    }

    function updateSummary(subtotal) {
        const discount = parseFloat(document.getElementById('pos-discount').value) || 0;
        document.getElementById('summary-subtotal').innerText = '$' + subtotal.toFixed(2);
        document.getElementById('summary-total').innerText = '$' + (subtotal - discount).toFixed(2);
    }

    document.getElementById('pos-discount').addEventListener('input', () => renderCart());
</script>

<style>
    input[type="radio"]:checked + span {
        @apply ring-2 ring-indigo-600 border-indigo-600 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-400;
    }
</style>
@endsection
