@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Business Intelligence Reports</h1>
        <a href="{{ route('reports.export.pdf') }}" class="inline-flex items-center px-4 py-2 bg-rose-600 text-white rounded-lg font-semibold text-xs uppercase tracking-widest hover:bg-rose-700 transition shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export PDF
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Sales Summary -->
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700">
            <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Gross Revenue</h3>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">${{ number_format($stats['daily_sales'] ?? 0, 2) }}</p>
            <div class="mt-4 flex items-center text-xs text-emerald-600">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                <span>Today's Performance</span>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700">
            <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Monthly Target</h3>
            <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">${{ number_format($stats['monthly_sales'] ?? 0, 2) }}</p>
            <div class="mt-4 w-full bg-slate-100 dark:bg-slate-700 rounded-full h-1.5">
                <div class="bg-indigo-600 h-1.5 rounded-full" style="width: 65%"></div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700">
            <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Inventory Health</h3>
            <p class="mt-2 text-3xl font-bold text-rose-600">{{ $stats['low_stock_items'] ?? 0 }}</p>
            <p class="mt-1 text-xs text-slate-400">Items below threshold</p>
        </div>
    </div>

    <!-- Charts -->
    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700">
        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">Revenue Trend (30 Days)</h3>
        <div class="h-96">
            <canvas id="reportChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('reportChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($stats['sales_chart_data']['labels'] ?? []) !!},
            datasets: [{
                label: 'Daily Revenue',
                data: {!! json_encode($stats['sales_chart_data']['values'] ?? []) !!},
                backgroundColor: '#6366f1',
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { grid: { borderDash: [2, 4], color: '#e2e8f0' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
