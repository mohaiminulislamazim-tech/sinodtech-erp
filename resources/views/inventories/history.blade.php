<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __("Inventory History Logs") }}
                    </h2>
                    <a href="{{ route('inventories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-sm shadow">
                        Back to Inventory
                    </a>
                </div>
            </x-slot>

            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Stock Transaction Audit Trail</h3>

                            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                                <thead class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Date/Time</th>
                                        <th scope="col" class="px-6 py-3">Product</th>
                                        <th scope="col" class="px-6 py-3">Branch</th>
                                        <th scope="col" class="px-6 py-3">Action Type</th>
                                        <th scope="col" class="px-6 py-3 text-right">Quantity</th>
                                        <th scope="col" class="px-6 py-3">Description</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100 text-gray-800">
                                    @forelse ($logs as $log)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                                {{ $log->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="px-6 py-4 font-medium">
                                                {{ $log->inventory->product->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $log->inventory->branch->name ?? 'Main Warehouse' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($log->type === 'Stock In')
                                                    <span class="bg-emerald-100 text-emerald-800 text-xs px-2 py-0.5 rounded font-bold uppercase">Stock In</span>
                                                @elseif($log->type === 'Stock Out')
                                                    <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded font-bold uppercase">Stock Out</span>
                                                @else
                                                    <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-0.5 rounded font-bold uppercase">{{ $log->type }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-right font-bold {{ $log->type === 'Stock Out' ? 'text-red-600' : 'text-emerald-600' }}">
                                                {{ $log->type === 'Stock Out' ? '-' : '+' }}{{ $log->quantity }}
                                            </td>
                                            <td class="px-6 py-4 text-gray-600 max-w-xs truncate">
                                                {{ $log->description ?? '-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">No stock history logs recorded yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $logs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
