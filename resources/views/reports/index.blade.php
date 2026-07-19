<x-app-layout>
    <div class="flex">
        @include("layouts.partials.sidebar")

        <main class="w-full">
            <x-slot name="header">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __("Analytical CRM & ERP Reports") }}
                    </h2>
                    <div class="flex space-x-2">
                        <!-- Export Actions -->
                        <button onclick="window.print()" class="bg-gray-100 hover:bg-gray-200 text-gray-800 border font-bold py-2 px-4 rounded text-sm flex items-center transition shadow-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-3a2 2 0 00-2-2H9a2 2 0 00-2 2v3a2 2 0 002 2zm5-14V3m0 0l-3 3m3-3l3 3"></path></svg>
                            Print Screen
                        </button>
                        <a href="{{ route('reports.export.pdf', request()->all()) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm flex items-center transition shadow-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Export PDF
                        </a>
                        <a href="{{ route('reports.export.excel', request()->all()) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded text-sm flex items-center transition shadow-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Export Excel/CSV
                        </a>
                    </div>
                </div>
            </x-slot>

            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Reports Filter Dashboard Bar -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border p-6">
                        <form method="GET" action="{{ route('reports.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Report Type -->
                            <div>
                                <label for="type" class="block text-gray-700 text-xs font-bold mb-1 uppercase tracking-wider">Report Type:</label>
                                <select name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    <option value="sales" {{ $type === 'sales' ? 'selected' : '' }}>Daily/Monthly/Yearly Sales</option>
                                    <option value="profit" {{ $type === 'profit' ? 'selected' : '' }}>Profit & Loss Report</option>
                                    <option value="inventory" {{ $type === 'inventory' ? 'selected' : '' }}>Full Inventory Valuation</option>
                                    <option value="low_stock" {{ $type === 'low_stock' ? 'selected' : '' }}>Low Stock Level Report</option>
                                    <option value="customers" {{ $type === 'customers' ? 'selected' : '' }}>Customer Sales Breakdown</option>
                                    <option value="employee" {{ $type === 'employee' ? 'selected' : '' }}>Employee Contribution</option>
                                    <option value="branch" {{ $type === 'branch' ? 'selected' : '' }}>Branch Performance</option>
                                </select>
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label for="start_date" class="block text-gray-700 text-xs font-bold mb-1 uppercase tracking-wider">Start Date:</label>
                                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="end_date" class="block text-gray-700 text-xs font-bold mb-1 uppercase tracking-wider">End Date:</label>
                                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            </div>

                            <!-- Branch Filter (Only active on Inventory/Low stock) -->
                            <div class="flex items-end space-x-2">
                                <div class="w-full">
                                    <label for="branch_id" class="block text-gray-700 text-xs font-bold mb-1 uppercase tracking-wider">Filter Branch (Optional):</label>
                                    <select name="branch_id" id="branch_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        <option value="">All Branches</option>
                                        @foreach($branches as $b)
                                            <option value="{{ $b->id }}" {{ $branchId == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm shadow transition leading-tight h-10">
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Summary Cards -->
                    @if ($type === 'sales' || $type === 'profit')
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div class="bg-white border rounded-lg p-6 shadow-sm">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Total Completed Transactions</p>
                                <h3 class="text-2xl font-extrabold text-gray-900">{{ $data['summary']['total_count'] ?? 0 }}</h3>
                            </div>
                            <div class="bg-white border rounded-lg p-6 shadow-sm">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Total Revenue Collected</p>
                                <h3 class="text-2xl font-extrabold text-indigo-600">${{ number_format($data['summary']['total_revenue'] ?? 0, 2) }}</h3>
                            </div>
                            <div class="bg-white border rounded-lg p-6 shadow-sm">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Estimated Profit Margin</p>
                                <h3 class="text-2xl font-extrabold text-emerald-600">${{ number_format($data['summary']['total_profit'] ?? 0, 2) }}</h3>
                            </div>
                        </div>
                    @elseif ($type === 'inventory' || $type === 'low_stock')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-white border rounded-lg p-6 shadow-sm">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Total Items Quantity</p>
                                <h3 class="text-2xl font-extrabold text-gray-900">{{ $data['summary']['total_quantity'] ?? 0 }} units</h3>
                            </div>
                            <div class="bg-white border rounded-lg p-6 shadow-sm">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Total Assets Cost Valuation</p>
                                <h3 class="text-2xl font-extrabold text-indigo-600">${{ number_format($data['summary']['total_asset_value'] ?? 0, 2) }}</h3>
                            </div>
                        </div>
                    @endif

                    <!-- Detailed Table Render Section -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-6 uppercase tracking-wider text-xs border-b pb-2">Compiled Report Records</h3>

                            <div class="overflow-x-auto">
                                @if ($type === 'sales' || $type === 'profit')
                                    <table class="w-full text-left border-collapse text-sm">
                                        <thead>
                                            <tr class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase border-b">
                                                <th class="py-3 px-4">Date</th>
                                                <th class="py-3 px-4 text-center">Sales Count</th>
                                                <th class="py-3 px-4 text-right">Subtotal</th>
                                                <th class="py-3 px-4 text-right">Discount Given</th>
                                                <th class="py-3 px-4 text-right">Total Tax</th>
                                                <th class="py-3 px-4 text-right">Revenue</th>
                                                <th class="py-3 px-4 text-right">Est. Profit (40%)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y text-gray-800">
                                            @forelse($data['records'] as $row)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-3 px-4 font-semibold text-indigo-600">{{ $row->date }}</td>
                                                    <td class="py-3 px-4 text-center">{{ $row->count }}</td>
                                                    <td class="py-3 px-4 text-right">${{ number_format($row->subtotal, 2) }}</td>
                                                    <td class="py-3 px-4 text-right text-red-600">-${{ number_format($row->discount, 2) }}</td>
                                                    <td class="py-3 px-4 text-right">${{ number_format($row->tax, 2) }}</td>
                                                    <td class="py-3 px-4 text-right font-bold text-gray-900">${{ number_format($row->revenue, 2) }}</td>
                                                    <td class="py-3 px-4 text-right font-bold text-emerald-600">${{ number_format($row->profit, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="7" class="py-8 text-center text-gray-500">No sale transactions found for date range.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                @elseif ($type === 'inventory' || $type === 'low_stock')
                                    <table class="w-full text-left border-collapse text-sm">
                                        <thead>
                                            <tr class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase border-b">
                                                <th class="py-3 px-4">Product Name</th>
                                                <th class="py-3 px-4">Branch Location</th>
                                                <th class="py-3 px-4 text-right">Current Stock Qty</th>
                                                <th class="py-3 px-4 text-right">Unit Price</th>
                                                <th class="py-3 px-4 text-right">Stock Valuation</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y text-gray-800">
                                            @forelse($data['records'] as $row)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-3 px-4 font-semibold">{{ $row->product_name }}</td>
                                                    <td class="py-3 px-4">{{ $row->branch_name ?? 'Main Warehouse' }}</td>
                                                    <td class="py-3 px-4 text-right font-bold {{ $row->quantity < 10 ? 'text-red-600' : '' }}">{{ $row->quantity }} units</td>
                                                    <td class="py-3 px-4 text-right">${{ number_format($row->price, 2) }}</td>
                                                    <td class="py-3 px-4 text-right font-bold text-gray-900">${{ number_format($row->asset_value, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="5" class="py-8 text-center text-gray-500">No stock levels found.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                @elseif ($type === 'customers')
                                    <table class="w-full text-left border-collapse text-sm">
                                        <thead>
                                            <tr class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase border-b">
                                                <th class="py-3 px-4">Customer Name</th>
                                                <th class="py-3 px-4">Email Address</th>
                                                <th class="py-3 px-4 text-center">Transactions count</th>
                                                <th class="py-3 px-4 text-right">Total Spent</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y text-gray-800">
                                            @forelse($data['records'] as $row)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-3 px-4 font-semibold">{{ $row->name }}</td>
                                                    <td class="py-3 px-4">{{ $row->email }}</td>
                                                    <td class="py-3 px-4 text-center">{{ $row->sales_count }} sales</td>
                                                    <td class="py-3 px-4 text-right font-bold text-indigo-600">${{ number_format($row->total_spent, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="4" class="py-8 text-center text-gray-500">No active customer spending logs.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                @elseif ($type === 'employee')
                                    <table class="w-full text-left border-collapse text-sm">
                                        <thead>
                                            <tr class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase border-b">
                                                <th class="py-3 px-4">Employee Name</th>
                                                <th class="py-3 px-4">Email Address</th>
                                                <th class="py-3 px-4">Role Title</th>
                                                <th class="py-3 px-4">Hire Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y text-gray-800">
                                            @forelse($data['records'] as $row)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-3 px-4 font-semibold">{{ $row->name }}</td>
                                                    <td class="py-3 px-4">{{ $row->email }}</td>
                                                    <td class="py-3 px-4"><span class="bg-indigo-100 text-indigo-800 font-bold px-2 py-0.5 rounded text-xs">{{ $row->role_title ?? 'Employee' }}</span></td>
                                                    <td class="py-3 px-4 text-gray-600">{{ $row->hire_date }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="4" class="py-8 text-center text-gray-500">No employees registered.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                @elseif ($type === 'branch')
                                    <table class="w-full text-left border-collapse text-sm">
                                        <thead>
                                            <tr class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase border-b">
                                                <th class="py-3 px-4">Branch Name</th>
                                                <th class="py-3 px-4">Physical Location</th>
                                                <th class="py-3 px-4 text-right">Branch Sales Volume</th>
                                                <th class="py-3 px-4 text-right">Warehouse Assets Value</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y text-gray-800">
                                            @forelse($data['records'] as $row)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-3 px-4 font-semibold">{{ $row->name }}</td>
                                                    <td class="py-3 px-4 text-gray-600">{{ $row->location }}</td>
                                                    <td class="py-3 px-4 text-right font-bold text-emerald-600">${{ number_format($row->sales_volume ?? 0, 2) }}</td>
                                                    <td class="py-3 px-4 text-right font-bold text-indigo-600">${{ number_format($row->asset_value ?? 0, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="4" class="py-8 text-center text-gray-500">No branches registered.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Print Screen styles to hide dashboard layout and only print report cards & table -->
    <style>
        @media print {
            body {
                background: white;
                color: black;
            }
            header, nav, .no-print, form, #sidebar {
                display: none !important;
            }
            main {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .py-6 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .shadow-sm, .shadow-md, .shadow-xl {
                box-shadow: none !important;
            }
            .border {
                border: 0 !important;
            }
        }
    </style>
</x-app-layout>
