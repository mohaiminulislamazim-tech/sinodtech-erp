@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
            {{ __('Dashboard') }}
        </h2>
        <div class="flex items-center space-x-3">
            <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 dark:bg-indigo-400/10 dark:text-indigo-400 dark:ring-indigo-400/20">
                v1.0.0
            </span>
            <div class="h-8 w-px bg-slate-200 dark:bg-slate-700"></div>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                {{ now()->format('l, jS F Y') }}
            </p>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Daily Sales Card -->
        <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:shadow-md dark:bg-slate-800 dark:ring-slate-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Today's Revenue</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">${{ number_format($todaysSales ?? 0, 2) }}</p>
                </div>
                <div class="rounded-xl bg-emerald-50 p-3 dark:bg-emerald-400/10">
                    <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.546.333 3.454.333 5 0 .141-.03.284-.055.43-.075M15.25 6H10a2 2 0 00-2 2v10a2 2 0 002 2h5.25" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="font-medium text-emerald-600 dark:text-emerald-400">+12.5%</span>
                <span class="ml-2 text-slate-400">from yesterday</span>
            </div>
        </div>

        <!-- Monthly Sales Card -->
        <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:shadow-md dark:bg-slate-800 dark:ring-slate-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Monthly Revenue</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">${{ number_format($monthlySales ?? 0, 2) }}</p>
                </div>
                <div class="rounded-xl bg-indigo-50 p-3 dark:bg-indigo-400/10">
                    <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="font-medium text-indigo-600 dark:text-indigo-400">August</span>
                <span class="ml-2 text-slate-400">current month stats</span>
            </div>
        </div>

        <!-- Total Customers Card -->
        <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:shadow-md dark:bg-slate-800 dark:ring-slate-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active Customers</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">{{ $totalCustomers ?? 0 }}</p>
                </div>
                <div class="rounded-xl bg-rose-50 p-3 dark:bg-rose-400/10">
                    <svg class="h-6 w-6 text-rose-600 dark:text-rose-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="font-medium text-rose-600 dark:text-rose-400">+4</span>
                <span class="ml-2 text-slate-400">new this week</span>
            </div>
        </div>

        <!-- Inventory Alert Card -->
        <div class="relative overflow-hidden rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition-all hover:shadow-md dark:bg-slate-800 dark:ring-slate-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Low Stock Alerts</p>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">{{ $low_stock_items ?? 0 }}</p>
                </div>
                <div class="rounded-xl bg-amber-50 p-3 dark:bg-amber-400/10">
                    <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="font-medium text-amber-600 dark:text-amber-400">Action Required</span>
                <span class="ml-2 text-slate-400">restock items soon</span>
            </div>
        </div>
    </div>

    <!-- Charts & Tables Section -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Sales Trend Chart -->
        <div class="lg:col-span-2 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Revenue Growth</h3>
                <select class="text-sm border-slate-200 rounded-lg dark:bg-slate-900 dark:border-slate-700 dark:text-slate-300">
                    <option>Last 30 Days</option>
                    <option>Last 6 Months</option>
                </select>
            </div>
            <div class="h-80 w-full">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Sales</h3>
                <a href="{{ route('sales.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">View all</a>
            </div>
            <div class="flow-root">
                <ul role="list" class="-my-5 divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($recent_sales ?? [] as $sale)
                    <li class="py-5">
                        <div class="relative flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700">
                                    <span class="text-xs font-medium leading-none text-slate-600 dark:text-slate-300">
                                        {{ strtoupper(substr($sale->customer->name ?? 'G', 0, 2)) }}
                                    </span>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-slate-900 dark:text-white">{{ $sale->customer->name ?? 'Guest' }}</p>
                                <p class="truncate text-sm text-slate-500 dark:text-slate-400">#{{ $sale->id }} • {{ $sale->created_at->diffForHumans() }}</p>
                            </div>
                            <div>
                                <span class="inline-flex items-center text-sm font-semibold text-slate-900 dark:text-white">
                                    ${{ number_format($sale->total_amount, 2) }}
                                </span>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="py-5 text-center text-sm text-slate-500">No recent sales</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($sales_chart_data['labels'] ?? []) !!},
                    datasets: [{
                        label: 'Revenue',
                        data: {!! json_encode($sales_chart_data['values'] ?? []) !!},
                        fill: true,
                        borderColor: '#4f46e5',
                        backgroundColor: 'rgba(79, 70, 229, 0.05)',
                        tension: 0.4,
                        borderWidth: 3,
                        pointRadius: 0,
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: '#4f46e5',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(226, 232, 240, 0.1)' },
                            ticks: { color: '#94a3b8' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#94a3b8' }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
