<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("Add Stock Record") }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <form action="{{ route("inventories.store") }}" method="POST">
                                @csrf
                                <!-- Product Select -->
                                <div class="mb-4">
                                    <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
                                    <select name="product_id" id="product_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        <option value="">Select a product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ old("product_id") == $product->id ? "selected" : "" }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("product_id")
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Branch Select -->
                                <div class="mb-4">
                                    <label for="branch_id" class="block text-gray-700 text-sm font-bold mb-2">Branch / Warehouse:</label>
                                    <select name="branch_id" id="branch_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        <option value="">Select a branch</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ old("branch_id") == $branch->id ? "selected" : "" }}>{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("branch_id")
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Quantity -->
                                <div class="mb-6">
                                    <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                                    <input type="number" name="quantity" id="quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ old("quantity", 0) }}" min="0" required>
                                    @error("quantity")
                                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-between border-t pt-4">
                                    <a href="{{ route('inventories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-sm transition">
                                        Cancel
                                    </a>
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm shadow transition">
                                        Add Stock Record
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
