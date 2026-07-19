<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __("Branch Stock Transfer") }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Transfer Stock Between Branches</h3>

                            <form action="{{ route('inventories.transfer') }}" method="POST">
                                @csrf

                                <!-- Product Select -->
                                <div class="mb-4">
                                    <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Select Product:</label>
                                    <select name="product_id" id="product_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        <option value="">Select product...</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }} (${{ number_format($product->price, 2) }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- From Branch -->
                                <div class="mb-4">
                                    <label for="from_branch_id" class="block text-gray-700 text-sm font-bold mb-2">From Branch (Source):</label>
                                    <select name="from_branch_id" id="from_branch_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        <option value="">Select source branch...</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- To Branch -->
                                <div class="mb-4">
                                    <label for="to_branch_id" class="block text-gray-700 text-sm font-bold mb-2">To Branch (Destination):</label>
                                    <select name="to_branch_id" id="to_branch_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                        <option value="">Select destination branch...</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Transfer Quantity -->
                                <div class="mb-4">
                                    <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Transfer Quantity:</label>
                                    <input type="number" name="quantity" id="quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" min="1" value="1" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-6">
                                    <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Transfer Reason / Remarks (Optional):</label>
                                    <input type="text" name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g. Stock replenishment, branch request">
                                </div>

                                <div class="flex items-center justify-between border-t pt-4">
                                    <a href="{{ route('inventories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-sm transition">
                                        Back
                                    </a>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm shadow transition">
                                        Initiate Stock Transfer
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
