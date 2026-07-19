<x-app-layout>
    <div class="flex" x-data="pos()">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("POS Terminal - Create Sale") }}
                </h2>
            </x-slot>

            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong>Validation Errors:</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form @submit.prevent="submit" action="{{ route('sales.store') }}" method="POST" id="pos-form">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Left: Sale Items POS Table -->
                            <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-lg font-bold text-gray-900">Sale Cart Items</h3>
                                    <button type="button" @click="addItem" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm flex items-center transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        Add Item
                                    </button>
                                 </div>

                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse">
                                        <thead>
                                            <tr class="border-b text-gray-700 text-xs font-semibold uppercase bg-gray-50">
                                                <th class="py-3 px-4 w-1/2">Product Search</th>
                                                <th class="py-3 px-4 w-1/6">Quantity</th>
                                                <th class="py-3 px-4 w-1/6 text-right">Price</th>
                                                <th class="py-3 px-4 w-1/6 text-right">Total</th>
                                                <th class="py-3 px-4 text-center w-12"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            <template x-for="(item, index) in items" :key="index">
                                                <tr class="item-row">
                                                    <td class="py-4 px-4 relative">
                                                        <!-- Dynamic Search Field -->
                                                        <div class="relative">
                                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                                </svg>
                                                            </div>
                                                            <input type="text" placeholder="Type product name or SKU..."
                                                                   class="product-search-input shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 pl-10 pr-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow"
                                                                   required autocomplete="off"
                                                                   x-model="item.search"
                                                                   @input.debounce.300ms="searchProducts(index)"
                                                                   @keydown.down.prevent="selectNextProduct(index)"
                                                                   @keydown.up.prevent="selectPreviousProduct(index)"
                                                                   @keydown.enter.prevent="selectProduct(index)"
                                                                   >
                                                        </div>
                                                        <!-- Hidden input for ID -->
                                                        <input type="hidden" :name="`items[${index}][product_id]`" x-model="item.product_id" required>

                                                        <!-- Selected Product Info Banner -->
                                                        <div x-show="item.product_id" class="selected-product-info text-xs mt-2 bg-blue-50 p-2 rounded border border-blue-100">
                                                            <div class="flex justify-between items-center text-blue-800 font-semibold mb-1">
                                                                <span x-text="item.sku"></span>
                                                                <span x-text="item.category" class="text-[10px] uppercase bg-blue-200 px-1.5 py-0.5 rounded"></span>
                                                            </div>
                                                            <div class="flex justify-between text-blue-700">
                                                                <span>Price: <span class="font-bold" x-text="formatCurrency(item.price)"></span></span>
                                                                <span>Stock: <span class="font-bold" x-text="item.stock"></span></span>
                                                            </div>
                                                        </div>

                                                        <!-- Dropdown Suggestions Popup -->
                                                        <div x-show="item.suggestions.length > 0" class="suggestions-dropdown absolute left-4 right-4 mt-1 z-50 bg-white border border-gray-200 rounded-lg shadow-xl max-h-60 overflow-y-auto">
                                                            <template x-for="(product, productIndex) in item.suggestions" :key="product.id">
                                                                <div @click="selectProduct(index, productIndex)"
                                                                     :class="{ 'bg-blue-100': item.selectedSuggestionIndex === productIndex }"
                                                                     class="py-3 px-4 text-sm border-b border-gray-100 last:border-0 transition-colors cursor-pointer hover:bg-blue-50">
                                                                    <div class="flex justify-between items-start mb-1">
                                                                        <span class="font-bold text-gray-800" x-text="product.name"></span>
                                                                        <span class="font-bold text-blue-600" x-text="formatCurrency(product.price)"></span>
                                                                    </div>
                                                                    <div class="flex justify-between items-center text-xs">
                                                                        <span class="text-gray-500 font-mono" x-text="product.sku"></span>
                                                                        <span :class="product.stock > 0 ? 'text-emerald-600 font-semibold' : 'text-red-500 font-bold'"
                                                                              x-text="product.stock > 0 ? `${product.stock} in stock` : 'Out of Stock'">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </td>
                                                    <td class="py-4 px-4">
                                                        <input type="number" :name="`items[${index}][quantity]`"
                                                               class="quantity-input shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow"
                                                               min="1" x-model.number="item.quantity" required
                                                               :disabled="!item.product_id"
                                                               @input="calculateTotal(index)">
                                                        <div class="text-[10px] text-red-500 font-semibold mt-1"
                                                             x-show="item.quantity > item.stock"
                                                        >
                                                            Exceeds stock!
                                                        </div>
                                                    </td>
                                                    <td class="py-4 px-4 text-right font-medium text-gray-600 product-price-display" x-text="formatCurrency(item.price)"></td>
                                                    <td class="py-4 px-4 text-right font-bold text-gray-900 row-total-display" x-text="formatCurrency(item.total)"></td>
                                                    <td class="py-4 px-4 text-center">
                                                        <button type="button" @click="removeItem(index)" class="text-red-400 hover:text-red-600 hover:bg-red-50 p-1.5 rounded-md transition-colors font-bold">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Right: Customer, Payment & Calculations -->
                            <div class="lg:col-span-1 space-y-6">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sticky top-6">
                                    <h3 class="text-lg font-bold text-gray-900 mb-6 border-b pb-2">Sale Details</h3>

                                    <!-- Customer Select -->
                                    <div class="mb-5">
                                        <label for="customer_id" class="block text-gray-700 text-sm font-bold mb-2">Customer:</label>
                                        <select name="customer_id" id="customer_id" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow" required>
                                            <option value="">Select a customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ old("customer_id") == $customer->id ? "selected" : "" }}>
                                                    {{ $customer->name }} ({{ $customer->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="mb-6">
                                        <label for="payment_method" class="block text-gray-700 text-sm font-bold mb-2">Payment Method:</label>
                                        <select name="payment_method" id="payment_method" class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2.5 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow" required>
                                            <option value="Cash">Cash</option>
                                            <option value="Card">Card</option>
                                            <option value="Mobile Banking">Mobile Banking</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                    </div>

                                    <!-- Live Calculations Summary -->
                                    <div class="space-y-4 border-t border-b border-gray-100 py-5 my-5 text-sm bg-gray-50/50 rounded-lg px-4">
                                        <div class="flex justify-between items-center text-gray-600">
                                            <span class="font-medium">Subtotal:</span>
                                            <span class="font-bold text-gray-800" x-text="formatCurrency(subtotal)"></span>
                                            <input type="hidden" name="subtotal" :value="subtotal">
                                        </div>
                                        <div class="flex justify-between items-center text-gray-600">
                                            <span class="font-medium">Discount ($):</span>
                                            <input type="number" name="discount" class="shadow-sm border border-gray-300 rounded w-24 py-1 px-2 text-right text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" min="0" step="0.01" x-model.number="discount">
                                        </div>
                                        <div class="flex justify-between items-center text-gray-600">
                                            <span class="font-medium">Tax ($):</span>
                                            <input type="number" name="tax" class="shadow-sm border border-gray-300 rounded w-24 py-1 px-2 text-right text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" min="0" step="0.01" x-model.number="tax">
                                        </div>
                                        <div class="flex justify-between items-center text-gray-600">
                                            <span class="font-medium">Shipping ($):</span>
                                            <input type="number" name="shipping" class="shadow-sm border border-gray-300 rounded w-24 py-1 px-2 text-right text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition-shadow" min="0" step="0.01" x-model.number="shipping">
                                        </div>
                                        <div class="flex justify-between items-center text-lg font-bold text-gray-900 border-t border-gray-200 pt-4 mt-2">
                                            <span>Balance Due:</span>
                                            <span class="text-blue-600 text-xl" x-text="formatCurrency(grandTotal)"></span>
                                            <input type="hidden" name="total_amount" :value="grandTotal">
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <button type="submit"
                                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 shadow-lg shadow-emerald-600/30 transition-all duration-200 flex justify-center items-center gap-2 text-lg"
                                                :disabled="!canSubmit"
                                                :class="{ 'opacity-50 cursor-not-allowed': !canSubmit }">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Complete Sale
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    @push("scripts")
    <script>
        function pos() {
            return {
                items: [{
                    product_id: '',
                    search: '',
                    suggestions: [],
                    selectedSuggestionIndex: -1,
                    price: 0,
                    quantity: 1,
                    total: 0,
                    stock: 0,
                    sku: '',
                    category: '',
                }],
                discount: 0,
                tax: 0,
                shipping: 0,

                get subtotal() {
                    return this.items.reduce((acc, item) => acc + item.total, 0);
                },

                get grandTotal() {
                    return this.subtotal - this.discount + this.tax + this.shipping;
                },

                get canSubmit() {
                    return this.items.length > 0 && this.items.every(item => item.product_id && item.quantity > 0 && item.quantity <= item.stock);
                },

                addItem() {
                    this.items.push({
                        product_id: '',
                        search: '',
                        suggestions: [],
                        selectedSuggestionIndex: -1,
                        price: 0,
                        quantity: 1,
                        total: 0,
                        stock: 0,
                        sku: '',
                        category: '',
                    });
                },

                removeItem(index) {
                    this.items.splice(index, 1);
                },

                async searchProducts(index) {
                    const search = this.items[index].search;
                    if (search.length < 2) {
                        this.items[index].suggestions = [];
                        return;
                    }

                    const response = await fetch(`/api/v1/products?search=${encodeURIComponent(search)}`);
                    const data = await response.json();
                    this.items[index].suggestions = data.data;
                },

                selectProduct(index, productIndex = null) {
                    if (productIndex === null) {
                        productIndex = this.items[index].selectedSuggestionIndex;
                    }

                    if (productIndex >= 0 && productIndex < this.items[index].suggestions.length) {
                        const product = this.items[index].suggestions[productIndex];
                        this.items[index].product_id = product.id;
                        this.items[index].price = product.price;
                        this.items[index].stock = product.stock;
                        this.items[index].sku = product.sku;
                        this.items[index].category = product.category ? product.category.name : 'N/A';
                        this.items[index].search = product.name;
                        this.items[index].suggestions = [];
                        this.calculateTotal(index);
                    }
                },

                calculateTotal(index) {
                    const item = this.items[index];
                    item.total = item.price * item.quantity;
                },

                formatCurrency(amount) {
                    return new Intl.NumberFormat('en-US', {
                        style: 'currency',
                        currency: 'USD'
                    }).format(amount);
                },

                selectNextProduct(index) {
                    const item = this.items[index];
                    if (item.selectedSuggestionIndex < item.suggestions.length - 1) {
                        item.selectedSuggestionIndex++;
                    }
                },

                selectPreviousProduct(index) {
                    const item = this.items[index];
                    if (item.selectedSuggestionIndex > 0) {
                        item.selectedSuggestionIndex--;
                    }
                },

                submit() {
                    if (this.canSubmit) {
                        this.$el.submit();
                    }
                }
            }
        }
    </script>
    @endpush
</x-app-layout>
