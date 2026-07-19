<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("Edit Stock") }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <form action="{{ route("inventories.update", $inventory) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="mb-4">
                                    <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
                                    <select name="product_id" id="product_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        <option value="">Select a product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" {{ old("product_id", $inventory->product_id) == $product->id ? "selected" : "" }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("product_id")
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                                    <input type="text" name="quantity" id="quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old("quantity", $inventory->quantity) }}">
                                    @error("quantity")
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Update Stock
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
