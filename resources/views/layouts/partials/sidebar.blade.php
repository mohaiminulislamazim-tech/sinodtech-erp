<aside x-show="sidebarOpen" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-50 w-72 glass border-r border-slate-200/60 dark:border-slate-800/60 lg:static lg:translate-x-0"
    :class="{'hidden': !sidebarOpen, 'block': sidebarOpen}"
    @click.away="sidebarOpen = false">
    
    <div class="flex flex-col h-full">
        <!-- Logo Area -->
        <div class="flex items-center h-20 px-8 border-b border-slate-200/60 dark:border-slate-800/60">
            <div class="h-9 w-9 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                <span class="text-white font-black text-xl">S</span>
            </div>
            <span class="ml-3 text-xl font-extrabold tracking-tight text-slate-900 dark:text-white">SinodTech <span class="text-indigo-600">ERP</span></span>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-6 py-8 space-y-1 overflow-y-auto scrollbar-hide">
            @php
                $navItems = [
                    ['route' => 'dashboard', 'label' => 'Overview', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route' => 'sales.create', 'label' => 'Point of Sale', 'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
                    ['label' => 'Core Operations', 'type' => 'header'],
                    ['route' => 'products.index', 'label' => 'Products', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                    ['route' => 'categories.index', 'label' => 'Categories', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z'],
                    ['route' => 'inventories.index', 'label' => 'Inventory', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01'],
                    ['label' => 'Management', 'type' => 'header'],
                    ['route' => 'customers.index', 'label' => 'Customers', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                    ['route' => 'employees.index', 'label' => 'Team', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ['route' => 'branches.index', 'label' => 'Branches', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                    ['label' => 'Financials', 'type' => 'header'],
                    ['route' => 'sales.index', 'label' => 'Sales Ledger', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ['route' => 'transactions.index', 'label' => 'Transactions', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['route' => 'reports.index', 'label' => 'Analytics', 'icon' => 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z'],
                ];
            @endphp

            @foreach($navItems as $item)
                @if(isset($item['type']) && $item['type'] === 'header')
                    <div class="pt-6 pb-2">
                        <p class="px-3 text-[10px] font-extrabold tracking-[0.2em] text-slate-400 uppercase">{{ $item['label'] }}</p>
                    </div>
                @else
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center px-4 py-3 text-sm font-semibold rounded-2xl transition-all duration-300 group 
                       {{ request()->routeIs($item['route'].'*') 
                          ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-500/25' 
                          : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-800 hover:text-indigo-600 dark:hover:text-white hover:shadow-sm' }}">
                        <svg class="flex-shrink-0 w-5 h-5 mr-3 transition-transform duration-300 group-hover:scale-110 {{ request()->routeIs($item['route'].'*') ? 'text-white' : 'text-slate-400 group-hover:text-indigo-600 dark:group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
                        </svg>
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach
        </nav>

        <!-- Footer Info -->
        <div class="p-6 border-t border-slate-200/60 dark:border-slate-800/60">
            <div class="bg-indigo-50 dark:bg-indigo-500/5 rounded-2xl p-4 ring-1 ring-indigo-500/10">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] text-indigo-600 dark:text-indigo-400 font-bold uppercase tracking-widest">v1.0.0 Stable</p>
                    <div class="h-2 w-2 bg-emerald-500 rounded-full animate-ping"></div>
                </div>
                <p class="mt-1 text-xs font-medium text-slate-600 dark:text-slate-400">System is online</p>
            </div>
        </div>
    </div>
</aside>
