<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("Record Transaction") }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <form action="{{ route("transactions.store") }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="sale_id" class="block text-gray-700 text-sm font-bold mb-2">Sale:</label>
                                    <select name="sale_id" id="sale_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select a sale</option>
                                        @foreach ($sales as $sale)
                                            <option value="{{ $sale->id }}" {{ old("sale_id") == $sale->id ? "selected" : "" }}>
                                                Sale #{{ $sale->id }} - {{ $sale->customer->name ?? 'N/A' }} (${{ number_format($sale->total_amount, 2) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("sale_id")
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="payment_method" class="block text-gray-700 text-sm font-bold mb-2">Payment Method:</label>
                                    <select name="payment_method" id="payment_method" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="Cash" {{ old("payment_method") == "Cash" ? "selected" : "" }}>Cash</option>
                                        <option value="Credit Card" {{ old("payment_method") == "Credit Card" ? "selected" : "" }}>Credit Card</option>
                                        <option value="Bank Transfer" {{ old("payment_method") == "Bank Transfer" ? "selected" : "" }}>Bank Transfer</option>
                                        <option value="Mobile Payment" {{ old("payment_method") == "Mobile Payment" ? "selected" : "" }}>Mobile Payment</option>
                                    </select>
                                    @error("payment_method")
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="amount" class="block text-gray-700 text-sm font-bold mb-2">Amount Paid:</label>
                                    <input type="text" name="amount" id="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old("amount") }}">
                                    @error("amount")
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Record Transaction
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
