<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __("Inventory Management") }}
                    </h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('inventories.transfer.form') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm shadow">
                            Stock Transfer
                        </a>
                        <a href="{{ route('inventories.history') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded text-sm shadow">
                            Inventory History
                        </a>
                        <a href="{{ route("inventories.create") }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm shadow">
                            + Add Stock Record
                        </a>
                    </div>
                </div>
            </x-slot>

            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if (session("success"))
                        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline">{{ session("success") }}</span>
                        </div>
                    @endif

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <!-- Filters & Header -->
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-bold text-gray-900">Current Stock Levels</h3>
                                <div class="flex space-x-2">
                                    <a href="{{ route('inventories.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-3 rounded text-xs border border-gray-300 {{ !request('low_stock') ? 'bg-indigo-50 border-indigo-500 text-indigo-600' : '' }}">
                                        All Inventory
                                    </a>
                                    <a href="{{ route('inventories.index', ['low_stock' => 1]) }}" class="bg-red-50 hover:bg-red-100 text-red-700 font-semibold py-2 px-3 rounded text-xs border border-red-300 {{ request('low_stock') ? 'bg-red-100 border-red-500' : '' }}">
                                        ⚠️ Low Stock Alerts
                                    </a>
                                </div>
                            </div>

                            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                                <thead class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Product</th>
                                        <th scope="col" class="px-6 py-3">Branch</th>
                                        <th scope="col" class="px-6 py-3 text-right">Quantity</th>
                                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                                        <th scope="col" class="px-6 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100 text-gray-800">
                                    @forelse ($inventories as $inventory)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 font-medium">{{ $inventory->product->name ?? "N/A" }}</td>
                                            <td class="px-6 py-4">{{ $inventory->branch->name ?? "Main Warehouse" }}</td>
                                            <td class="px-6 py-4 text-right font-bold {{ $inventory->quantity < 10 ? 'text-red-600' : 'text-gray-900' }}">
                                                {{ $inventory->quantity }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if ($inventory->quantity < 10)
                                                    <span class="bg-red-100 text-red-800 text-xs px-2.5 py-0.5 rounded-full font-semibold uppercase">Low Stock</span>
                                                @else
                                                    <span class="bg-emerald-100 text-emerald-800 text-xs px-2.5 py-0.5 rounded-full font-semibold uppercase">In Stock</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-right whitespace-nowrap text-xs font-semibold space-x-2">
                                                <!-- Show Adjust Button -->
                                                <button onclick="toggleAdjustModal({{ $inventory->id }}, '{{ addslashes($inventory->product->name) }}', {{ $inventory->quantity }})" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 border border-indigo-200 py-1.5 px-3 rounded shadow-sm transition">
                                                    Quick Adjust
                                                </button>
                                                
                                                <a href="{{ route("inventories.show", $inventory) }}" class="text-blue-600 hover:text-blue-900 py-1 px-2 border rounded">Logs</a>
                                                <a href="{{ route("inventories.edit", $inventory) }}" class="text-amber-600 hover:text-amber-900 py-1 px-2 border rounded">Edit</a>
                                                
                                                <form action="{{ route("inventories.destroy", $inventory) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this inventory record?');">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="text-red-600 hover:text-red-900 py-1 px-2 border rounded">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">No stock records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $inventories->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Quick Adjust Modal -->
    <div id="adjust-modal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 relative">
            <button onclick="closeAdjustModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            <h3 class="text-lg font-bold text-gray-900 mb-4">Stock In / Stock Out Adjustment</h3>
            <p class="text-sm text-gray-600 mb-6">Adjusting stock for: <strong id="modal-product-name" class="text-indigo-600"></strong> (Current Qty: <span id="modal-current-qty" class="font-bold"></span>)</p>

            <form id="adjust-form" method="POST" action="">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Adjustment Type:</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="type" value="Stock In" checked class="form-radio text-indigo-600">
                            <span class="ml-2 text-sm text-gray-700 font-semibold text-emerald-600">Stock In (Increment)</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="type" value="Stock Out" class="form-radio text-indigo-600">
                            <span class="ml-2 text-sm text-gray-700 font-semibold text-red-600">Stock Out (Decrement)</span>
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="modal-quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                    <input type="number" name="quantity" id="modal-quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" min="1" value="1" required>
                </div>

                <div class="mb-6">
                    <label for="modal-description" class="block text-gray-700 text-sm font-bold mb-2">Description / Reason:</label>
                    <input type="text" name="description" id="modal-description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g. Received shipment, Damaged stock, etc.">
                </div>

                <div class="flex justify-end space-x-2 border-t pt-4">
                    <button type="button" onclick="closeAdjustModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded text-sm">Cancel</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm shadow">Apply Adjustment</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleAdjustModal(id, name, currentQty) {
            const form = document.getElementById('adjust-form');
            form.action = `/inventories/${id}/adjust`;
            document.getElementById('modal-product-name').textContent = name;
            document.getElementById('modal-current-qty').textContent = currentQty;
            document.getElementById('adjust-modal').classList.remove('hidden');
        }

        function closeAdjustModal() {
            document.getElementById('adjust-modal').classList.add('hidden');
        }
    </script>
</x-app-layout>
