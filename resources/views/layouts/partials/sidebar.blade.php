@php
    $sidebarGroups = [
        'Inventory & Catalog' => [
            [
                'name' => 'Products',
                'route' => 'products.index',
                'pattern' => 'products*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>',
            ],
            [
                'name' => 'Categories',
                'route' => 'categories.index',
                'pattern' => 'categories*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" /></svg>',
            ],
            [
                'name' => 'Inventory',
                'route' => 'inventories.index',
                'pattern' => 'inventories*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" /></svg>',
            ]
        ],
        'Business Transactions' => [
            [
                'name' => 'Sales',
                'route' => 'sales.index',
                'pattern' => 'sales*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" /></svg>',
            ],
            [
                'name' => 'Transactions',
                'route' => 'transactions.index',
                'pattern' => 'transactions*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" /></svg>',
            ],
            [
                'name' => 'Branches',
                'route' => 'branches.index',
                'pattern' => 'branches*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-2.25a2.25 2.25 0 0 1 2.25-2.25h1.5a2.25 2.25 0 0 1 2.25 2.25V21" /></svg>',
            ]
        ],
        'Human Resources & CRM' => [
            [
                'name' => 'Customers',
                'route' => 'customers.index',
                'pattern' => 'customers*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>',
            ],
            [
                'name' => 'Employees',
                'route' => 'employees.index',
                'pattern' => 'employees*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" /></svg>',
            ]
        ],
        'Analytics' => [
            [
                'name' => 'Reports',
                'route' => 'reports.index',
                'pattern' => 'reports*',
                'icon' => '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>',
            ]
        ]
    ];
@endphp

<aside id="app-sidebar" class="w-[260px] h-[calc(100vh-64px)] sticky top-0 self-start bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-r border-slate-200/50 dark:border-slate-800/50 flex-shrink-0 flex flex-col justify-between transition-all duration-300 z-30 shadow-[4px_0_24px_rgba(0,0,0,0.02)] dark:shadow-[4px_0_24px_rgba(0,0,0,0.2)]" aria-label="Sidebar">
    <div class="flex flex-col h-full overflow-hidden">
        
        <!-- Brand Identity Header -->
        <div class="h-[72px] px-6 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between overflow-hidden">
            <div class="flex items-center gap-3 w-full">
                <div class="bg-gradient-to-tr from-blue-600 to-blue-500 p-2 rounded-xl shadow-[0_4px_12px_rgba(37,99,235,0.3)] flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="sidebar-text transition-opacity duration-300 flex-1">
                    <h1 class="text-[18px] font-bold tracking-tight text-slate-900 dark:text-white flex items-center gap-2">
                        SinodTech
                        <span class="text-[10px] font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 px-1.5 py-0.5 rounded border border-blue-100/50 dark:border-blue-900/40 uppercase tracking-widest">ERP</span>
                    </h1>
                </div>
            </div>
        </div>

        <!-- Scrollable Navigation Menu -->
        <div class="flex-1 px-4 py-6 space-y-6 overflow-y-auto custom-scrollbar">
            
            <!-- Prominent Dashboard Link -->
            @php
                $isDashboardActive = request()->routeIs('dashboard');
            @endphp
            <div>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-[14px] transition-all duration-200 group relative overflow-hidden {{ $isDashboardActive ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-[0_4px_12px_rgba(37,99,235,0.3)] font-bold' : 'font-medium text-slate-600 dark:text-slate-300 hover:bg-blue-50/80 dark:hover:bg-blue-500/10 hover:text-blue-600 dark:hover:text-blue-400 hover:scale-[1.02] hover:shadow-[0_0_15px_rgba(59,130,246,0.15)] transform' }}"
                   title="Dashboard">
                    
                    @if (!$isDashboardActive)
                        <div class="absolute inset-0 bg-blue-50/0 dark:bg-blue-500/0 group-hover:bg-blue-50/50 dark:group-hover:bg-blue-500/10 transition-colors duration-300 rounded-xl"></div>
                    @endif

                    @if ($isDashboardActive)
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white/40 rounded-r-full shadow-[0_0_8px_rgba(255,255,255,0.6)]"></div>
                    @endif

                    <div class="relative z-10 flex items-center justify-center transition-transform duration-200 group-hover:scale-110 {{ $isDashboardActive ? 'text-white scale-110' : 'text-slate-400 dark:text-slate-500 group-hover:text-blue-500 dark:group-hover:text-blue-400' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                        </svg>
                    </div>
                    <span class="relative z-10 sidebar-text truncate tracking-wide">Dashboard</span>
                </a>
            </div>

            <!-- Grouped Sidebar Categories -->
            @foreach ($sidebarGroups as $groupName => $items)
                <div class="space-y-2">
                    <!-- Group Header Label -->
                    <div class="px-3 flex items-center gap-2">
                        <span class="text-[11px] font-bold text-slate-400/80 dark:text-slate-500/80 tracking-[0.08em] uppercase">{{ $groupName }}</span>
                        <div class="h-px flex-1 bg-slate-200/60 dark:bg-slate-800/60"></div>
                    </div>

                    <!-- Submenu -->
                    <ul class="space-y-1">
                        @foreach ($items as $item)
                            @php
                                $isActive = request()->routeIs($item['pattern']) || request()->is($item['pattern']);
                            @endphp
                            <li>
                                <a href="{{ route($item['route']) }}" 
                                   class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-[14px] transition-all duration-200 group relative overflow-hidden {{ $isActive ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white shadow-[0_4px_12px_rgba(37,99,235,0.3)] font-bold' : 'font-medium text-slate-600 dark:text-slate-300 hover:bg-blue-50/80 dark:hover:bg-blue-500/10 hover:text-blue-600 dark:hover:text-blue-400 hover:scale-[1.02] hover:shadow-[0_0_15px_rgba(59,130,246,0.15)] transform' }}"
                                   title="{{ $item['name'] }}">
                                   
                                    @if (!$isActive)
                                        <div class="absolute inset-0 bg-blue-50/0 dark:bg-blue-500/0 group-hover:bg-blue-50/50 dark:group-hover:bg-blue-500/10 transition-colors duration-300 rounded-xl"></div>
                                    @endif

                                    @if ($isActive)
                                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white/40 rounded-r-full shadow-[0_0_8px_rgba(255,255,255,0.6)]"></div>
                                    @endif

                                    <!-- Sidebar Icon -->
                                    <div class="relative z-10 flex items-center justify-center transition-transform duration-200 group-hover:scale-110 {{ $isActive ? 'text-white scale-110' : 'text-slate-400 dark:text-slate-500 group-hover:text-blue-500 dark:group-hover:text-blue-400' }}">
                                        {!! $item['icon'] !!}
                                    </div>

                                    <!-- Sidebar Label -->
                                    <span class="relative z-10 sidebar-text truncate tracking-wide">{{ $item['name'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <!-- Sticky Quick Profile View -->
        <div class="p-4 border-t border-slate-200/50 dark:border-slate-800/50 bg-white/50 dark:bg-slate-900/50 backdrop-blur-md">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors cursor-pointer group">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-500 text-white font-bold text-sm flex items-center justify-center border-2 border-white dark:border-slate-800 shadow-sm shadow-blue-500/20 flex-shrink-0 group-hover:scale-105 transition-transform duration-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="sidebar-text truncate flex-1">
                    <p class="text-[13px] font-bold text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] font-medium text-slate-500 dark:text-slate-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                </div>
                <div class="text-slate-400 group-hover:text-blue-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</aside>

<style>
    /* Premium Enterprise Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 5px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.2);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(59, 130, 246, 0.4);
    }
    
    /* Ensure dark mode scrollbar thumb looks good */
    .dark .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.1);
    }
    .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(59, 130, 246, 0.5);
    }
</style>
