<x-app-layout>
    <div class="flex bg-[#F8FAFC] dark:bg-[#0F172A]">
        <!-- Collapsible Sidebar Navigation -->
        @include("layouts.partials.sidebar")

        <!-- Main Workspace Area -->
        <main class="flex-1 min-w-0 overflow-auto">
            
            <!-- Page Title Header -->
            <div class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 pt-5 pb-4 px-8 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-[30px] font-bold text-slate-900 dark:text-white tracking-tight leading-tight">Dashboard</h1>
                        <p class="text-[14px] text-slate-500 dark:text-slate-400 font-medium">Welcome back, {{ Auth::user()->name }}.</p>
                    </div>
                </div>
            </div>

            <!-- Page Inner Content -->
            <div class="p-6 space-y-6">
                
                @if($lowStockProducts->count() > 0)
                <!-- ERP Alerts -->
                <div class="flex items-center gap-4 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/50 rounded-[15px] shadow-sm animate-pulse-subtle">
                    <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-800 text-amber-600 dark:text-amber-400 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[14px] font-semibold text-amber-800 dark:text-amber-300">System Alert: Low Stock Detected</p>
                        <p class="text-[12px] text-amber-700 dark:text-amber-400 font-medium">There are {{ $lowStockProducts->count() }} items currently below critical stock levels. Immediate action required.</p>
                    </div>
                </div>
                @endif

                <!-- KPI Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @php
                        $kpis = [
                            ['title' => 'Total Revenue', 'value' => '$' . number_format($allTimeRevenue, 2), 'subtitle' => 'Today: $' . number_format($todaysSales, 2), 'icon' => 'heroicon-o-currency-dollar', 'color' => 'blue'],
                            ['title' => 'Gross Profit', 'value' => '$' . number_format($allTimeProfit, 2), 'subtitle' => 'Month: $' . number_format($monthlySales, 2), 'icon' => 'heroicon-o-trending-up', 'color' => 'green'],
                            ['title' => 'Total Sales', 'value' => $totalSales, 'subtitle' => 'Orders', 'icon' => 'heroicon-o-shopping-cart', 'color' => 'sky'],
                            ['title' => 'Stock Items', 'value' => number_format($totalInventory), 'subtitle' => 'Units in Stock', 'icon' => 'heroicon-o-archive', 'color' => 'slate'],
                        ];
                    @endphp

                    @foreach ($kpis as $kpi)
                        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md rounded-[20px] shadow-[0_8px_30px_-4px_rgba(0,0,0,0.05)] border border-white/20 dark:border-slate-800/50 transform hover:-translate-y-1 hover:shadow-[0_12px_40px_-4px_rgba(0,0,0,0.1)] transition-all duration-300">
                            <div class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 flex-shrink-0 bg-slate-50 dark:bg-slate-800 text-[#2563EB] dark:text-[#3B82F6] rounded-[14px] flex items-center justify-center shadow-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><use xlink:href="#{{ $kpi['icon'] }}"></use></svg>
                                    </div>
                                    <div>
                                        <p class="text-[13px] font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">{{ $kpi['title'] }}</p>
                                        <p class="text-[22px] font-semibold text-slate-900 dark:text-white mt-0.5">{{ $kpi['value'] }}</p>
                                        <p class="text-[12px] text-slate-500 dark:text-slate-500 mt-1">{{ $kpi['subtitle'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('sales.create') }}" class="group p-4 bg-white dark:bg-slate-900 rounded-[15px] border border-slate-100 dark:border-slate-800 shadow-sm hover:border-[#2563EB] dark:hover:border-[#3B82F6] transition-all flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-[#2563EB] dark:text-[#3B82F6] flex items-center justify-center group-hover:bg-[#2563EB] group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <span class="text-[14px] font-semibold text-slate-700 dark:text-slate-200">New Sale</span>
                    </a>
                    <a href="{{ route('products.create') }}" class="group p-4 bg-white dark:bg-slate-900 rounded-[15px] border border-slate-100 dark:border-slate-800 shadow-sm hover:border-[#2563EB] dark:hover:border-[#3B82F6] transition-all flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                        <span class="text-[14px] font-semibold text-slate-700 dark:text-slate-200">New Product</span>
                    </a>
                    <a href="{{ route('inventories.create') }}" class="group p-4 bg-white dark:bg-slate-900 rounded-[15px] border border-slate-100 dark:border-slate-800 shadow-sm hover:border-[#2563EB] dark:hover:border-[#3B82F6] transition-all flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <span class="text-[14px] font-semibold text-slate-700 dark:text-slate-200">Add Stock</span>
                    </a>
                    <a href="{{ route('reports.index') }}" class="group p-4 bg-white dark:bg-slate-900 rounded-[15px] border border-slate-100 dark:border-slate-800 shadow-sm hover:border-[#2563EB] dark:hover:border-[#3B82F6] transition-all flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-[14px] font-semibold text-slate-700 dark:text-slate-200">Analytics</span>
                    </a>
                </div>

                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                    <div class="lg:col-span-3 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md rounded-[20px] shadow-[0_8px_30px_-4px_rgba(0,0,0,0.05)] border border-white/20 dark:border-slate-800/50 flex flex-col h-[420px]">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex-shrink-0">
                            <h3 class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">Sales Over Time</h3>
                        </div>
                        <div class="p-6 flex-1 min-h-0">
                            <div class="h-full w-full relative">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-2 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md rounded-[20px] shadow-[0_8px_30px_-4px_rgba(0,0,0,0.05)] border border-white/20 dark:border-slate-800/50 flex flex-col h-[420px]">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex-shrink-0">
                            <h3 class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">Revenue by Top Products</h3>
                        </div>
                        <div class="p-6 flex-1 min-h-0">
                            <div class="h-full w-full relative">
                                <canvas id="topProductsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Sales & Low Stock -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Low Stock Items -->
                    <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md rounded-[20px] shadow-[0_8px_30px_-4px_rgba(0,0,0,0.05)] border border-white/20 dark:border-slate-800/50 flex flex-col h-full">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center flex-shrink-0">
                            <h3 class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">Low Stock Products</h3>
                            <a href="{{ route('inventories.index') }}" class="text-[13px] font-medium text-[#2563EB] hover:text-[#3B82F6] transition-colors">View All</a>
                        </div>
                        <div class="p-6 flex-1 overflow-auto">
                            <div class="space-y-4">
                                @forelse ($lowStockProducts as $inventory)
                                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-800 hover:border-slate-200 dark:hover:border-slate-700 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-500 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="text-[14px] font-medium text-slate-900 dark:text-white">{{ $inventory->product->name }}</p>
                                                <p class="text-[12px] text-slate-500">{{ $inventory->branch->name }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[15px] font-semibold text-red-600 dark:text-red-400">{{ $inventory->quantity }}</p>
                                            <p class="text-[12px] text-slate-500">In Stock</p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <p class="text-[14px] text-slate-500 dark:text-slate-400">All stock levels are healthy.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Recent Sales -->
                    <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md rounded-[20px] shadow-[0_8px_30px_-4px_rgba(0,0,0,0.05)] border border-white/20 dark:border-slate-800/50 flex flex-col h-full">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center flex-shrink-0">
                            <h3 class="text-[15px] font-semibold text-slate-800 dark:text-slate-200">Recent Sales</h3>
                            <a href="{{ route('sales.index') }}" class="text-[13px] font-medium text-[#2563EB] hover:text-[#3B82F6] transition-colors">View All</a>
                        </div>
                        <div class="flex-1 overflow-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-800">
                                        <th class="px-6 py-4 text-[12px] font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Customer</th>
                                        <th class="px-6 py-4 text-[12px] font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    @forelse ($latestSales as $sale)
                                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                            <td class="px-6 py-4">
                                                <p class="text-[14px] font-medium text-slate-900 dark:text-white">{{ $sale->customer->name ?? 'Walk-in Customer' }}</p>
                                                <p class="text-[12px] text-slate-500 mt-0.5">{{ $sale->created_at->format('M d, Y h:i A') }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <p class="text-[15px] font-semibold text-slate-900 dark:text-white">${{ number_format($sale->total_amount, 2) }}</p>
                                                <span class="inline-block mt-1 px-2 py-0.5 rounded text-[11px] font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Paid</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-6 py-8 text-center text-[14px] text-slate-500 dark:text-slate-400">No recent sales found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Heroicons SVG sprite -->
    <svg width="0" height="0" class="absolute">
        <defs>
            <svg id="heroicon-o-currency-dollar" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0-2a9 9 0 11-9 9 4.5 4.5 0 015.053-4.472A4.501 4.501 0 0112 10.5c.834 0 1.606.22 2.278.608A4.505 4.505 0 0117.947 15h.001c.626 0 1.18.252 1.583.658a2.25 2.25 0 01.658 1.583V21a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 21v-2.25a2.25 2.25 0 01.658-1.583 2.249 2.249 0 011.583-.658h.001z" />
            </svg>
            <svg id="heroicon-o-trending-up" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
            <svg id="heroicon-o-shopping-cart" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <svg id="heroicon-o-archive" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
        </defs>
    </svg>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isDarkMode = document.documentElement.classList.contains('dark');
            const gridColor = isDarkMode ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
            const textColor = isDarkMode ? '#94A3B8' : '#64748B'; // slate-400 : slate-500
            const fontStyle = { family: "'Figtree', sans-serif", size: 12 };

            // Default Chart.js config for modern look
            Chart.defaults.font.family = fontStyle.family;
            Chart.defaults.color = textColor;
            Chart.defaults.plugins.tooltip.backgroundColor = isDarkMode ? '#1E293B' : '#FFFFFF';
            Chart.defaults.plugins.tooltip.titleColor = isDarkMode ? '#F8FAFC' : '#0F172A';
            Chart.defaults.plugins.tooltip.bodyColor = isDarkMode ? '#CBD5E1' : '#475569';
            Chart.defaults.plugins.tooltip.borderColor = isDarkMode ? '#334155' : '#E2E8F0';
            Chart.defaults.plugins.tooltip.borderWidth = 1;
            Chart.defaults.plugins.tooltip.padding = 12;
            Chart.defaults.plugins.tooltip.cornerRadius = 8;

            // Sales Chart
            const salesChartCtx = document.getElementById('salesChart').getContext('2d');
            const salesGradient = salesChartCtx.createLinearGradient(0, 0, 0, 400);
            salesGradient.addColorStop(0, 'rgba(37, 99, 235, 0.2)'); // #2563EB with opacity
            salesGradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

            new Chart(salesChartCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Revenue',
                        data: {!! json_encode($chartValues) !!},
                        backgroundColor: salesGradient,
                        borderColor: '#2563EB',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#2563EB',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#2563EB',
                        pointHoverBorderColor: '#FFFFFF',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: { top: 10, right: 10, bottom: 0, left: 0 }
                    },
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: gridColor, drawBorder: false },
                            ticks: { 
                                color: textColor,
                                font: fontStyle,
                                padding: 10,
                                callback: function(value) {
                                    return '$' + (value >= 1000 ? (value/1000).toFixed(1) + 'k' : value);
                                }
                            },
                            border: { display: false }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: textColor, font: fontStyle, padding: 10 },
                            border: { display: false }
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    }
                }
            });

            // Top Products Chart
            const topProductsChartCtx = document.getElementById('topProductsChart').getContext('2d');
            new Chart(topProductsChartCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($topProducts->pluck('product.name')) !!},
                    datasets: [{
                        label: 'Top Products',
                        data: {!! json_encode($topProducts->pluck('total_quantity')) !!},
                        backgroundColor: [
                            '#2563EB', // Primary Blue
                            '#3B82F6', // Secondary Blue
                            '#60A5FA', // Light Blue
                            '#93C5FD', // Lighter Blue
                            '#BFDBFE'  // Lightest Blue
                        ],
                        borderColor: isDarkMode ? '#0F172A' : '#FFFFFF',
                        borderWidth: 3,
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    layout: {
                        padding: { top: 10, bottom: 10 }
                    },
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                color: textColor,
                                font: fontStyle,
                                usePointStyle: true,
                                padding: 20,
                                boxWidth: 8
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
