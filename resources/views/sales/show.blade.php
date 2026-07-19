<x-app-layout>
    <div class="flex">
        <!-- Print wrapper: Hide sidebar and navigation during browser printing -->
        <div class="no-print">
            @include("layouts.partials.sidebar")
        </div>

        <main class="w-full">
            <x-slot name="header">
                <div class="flex justify-between items-center no-print">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __("POS Sale Invoice") }}
                    </h2>
                    <div class="flex space-x-2">
                        <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm shadow flex items-center transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-3a2 2 0 00-2-2H9a2 2 0 00-2 2v3a2 2 0 002 2zm5-14V3m0 0l-3 3m3-3l3 3"></path></svg>
                            Print Invoice
                        </button>
                        <a href="{{ route('sales.pdf', $sale->id) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded text-sm shadow flex items-center transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Download Invoice
                        </a>
                        <a href="{{ route('sales.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded text-sm shadow flex items-center transition">
                            Back to Sales
                        </a>
                    </div>
                </div>
            </x-slot>

            <div class="py-6">
                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <!-- Invoice Card -->
                    <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-8 print:border-0 print:shadow-none" id="invoice-print-area">
                        <!-- Header Section -->
                        <div class="flex justify-between border-b pb-6 mb-6">
                            <div>
                                <h1 class="text-3xl font-extrabold text-indigo-600 tracking-tight">SINODTECH ERP</h1>
                                <p class="text-xs text-gray-500 mt-1">
                                    123 Business Avenue, Suite 100<br>
                                    support@sinodtech.com | +1 (555) 123-4567
                                </p>
                            </div>
                            <div class="text-right">
                                <h2 class="text-xl font-bold text-gray-800">INVOICE</h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    <strong>Invoice ID:</strong> #{{ $sale->id }}<br>
                                    <strong>Date:</strong> {{ $sale->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="grid grid-cols-2 gap-6 mb-8 text-sm">
                            <div>
                                <h3 class="font-semibold text-gray-700 uppercase tracking-wider text-xs mb-2">Customer Details:</h3>
                                <p class="text-gray-900 font-bold">{{ $sale->customer->name ?? 'Walk-in Customer' }}</p>
                                <p class="text-gray-500">{{ $sale->customer->email ?? 'N/A' }}</p>
                                <p class="text-gray-500">{{ $sale->customer->phone ?? 'N/A' }}</p>
                            </div>
                            <div class="text-right">
                                <h3 class="font-semibold text-gray-700 uppercase tracking-wider text-xs mb-2">Payment Info:</h3>
                                <p class="text-gray-900"><span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded font-bold uppercase">{{ $sale->payment_method }}</span></p>
                            </div>
                        </div>

                        <!-- Items Table -->
                        <div class="border rounded-lg overflow-hidden mb-6">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b text-xs font-semibold text-gray-700 uppercase">
                                        <th class="py-3 px-4">Product Name</th>
                                        <th class="py-3 px-4 text-right w-20">Qty</th>
                                        <th class="py-3 px-4 text-right w-32">Unit Price</th>
                                        <th class="py-3 px-4 text-right w-32">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y text-sm">
                                    @foreach ($sale->items as $item)
                                        <tr class="hover:bg-gray-50 text-gray-800">
                                            <td class="py-4 px-4 font-medium">{{ $item->product->name ?? 'Unknown Product' }}</td>
                                            <td class="py-4 px-4 text-right">{{ $item->quantity }}</td>
                                            <td class="py-4 px-4 text-right">${{ number_format($item->price, 2) }}</td>
                                            <td class="py-4 px-4 text-right font-semibold">${{ number_format($item->quantity * $item->price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Summary Column -->
                        <div class="flex justify-end text-sm">
                            <div class="w-72 space-y-2 border-t pt-4">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal:</span>
                                    <span class="font-medium">${{ number_format($sale->subtotal, 2) }}</span>
                                </div>
                                @if($sale->discount > 0)
                                    <div class="flex justify-between text-red-600">
                                        <span>Discount:</span>
                                        <span>-${{ number_format($sale->discount, 2) }}</span>
                                    </div>
                                @endif
                                @if($sale->tax > 0)
                                    <div class="flex justify-between text-gray-600">
                                        <span>Tax:</span>
                                        <span>+${{ number_format($sale->tax, 2) }}</span>
                                    </div>
                                @endif
                                @if($sale->shipping > 0)
                                    <div class="flex justify-between text-gray-600">
                                        <span>Shipping:</span>
                                        <span>+${{ number_format($sale->shipping, 2) }}</span>
                                    </div>
                                @endif
                                <div class="flex justify-between text-base font-bold text-gray-900 border-t pt-2">
                                    <span>Grand Total:</span>
                                    <span>${{ number_format($sale->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Thank You Banner -->
                        <div class="text-center text-xs text-gray-400 mt-12 border-t pt-4">
                            Thank you for shopping with us! For questions contact billing@sinodtech.com.
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Print Media Query Styling -->
    <style>
        @media print {
            body {
                background: white;
                color: black;
            }
            .no-print, header, nav, #sidebar {
                display: none !important;
            }
            main {
                width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .py-6, .py-12 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
            #invoice-print-area {
                border: 0 !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
        }
    </style>
</x-app-layout>
