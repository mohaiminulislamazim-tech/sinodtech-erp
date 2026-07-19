@php
    // Dynamically generate breadcrumbs based on active URL segments
    $segments = request()->segments();
    $breadcrumbs = [['name' => 'Console', 'url' => route('dashboard')]];
    $currentUrl = '';
    
    foreach ($segments as $segment) {
        if ($segment === 'dashboard') continue;
        $currentUrl .= '/' . $segment;
        
        $name = ucwords(str_replace(['-', '_'], ' ', $segment));
        if (is_numeric($segment)) {
            $name = 'Details';
        }
        
        $breadcrumbs[] = [
            'name' => $name,
            'url' => url($currentUrl)
        ];
    }
@endphp

<nav x-data="{ open: false, profileDropdown: false, quickActionDropdown: false, notificationDropdown: false }" class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 sticky top-0 z-40 transition-all duration-150 shadow-sm px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between h-16">
            
            <!-- Left Side: Collapsible toggle trigger + Breadcrumbs & Search -->
            <div class="flex items-center flex-1">
                <!-- Mobile Sidebar Toggle -->
                <button onclick="toggleSidebarCollapse()" class="p-2 -ml-2 rounded-lg text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors focus:outline-none md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Desktop Sidebar Collapse Toggle Trigger -->
                <button onclick="toggleSidebarCollapse()" class="hidden md:flex p-1.5 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 mr-4 transition-colors focus:outline-none" title="Toggle Sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/>
                    </svg>
                </button>

                <!-- Premium Search Box (Zoho/Odoo style search) -->
                <div class="hidden sm:flex relative max-w-xs w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search menu, files, records..." 
                        class="block w-full pl-9 pr-4 py-1.5 bg-slate-50 dark:bg-slate-950/40 border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition-all duration-150">
                </div>
                
                <!-- Desktop Breadcrumbs -->
                <nav class="hidden lg:flex items-center space-x-2 text-xs text-slate-400 dark:text-slate-500 font-medium ml-6" aria-label="Breadcrumb">
                    @foreach ($breadcrumbs as $index => $crumb)
                        @if ($index > 0)
                            <svg class="w-3.5 h-3.5 text-slate-300 dark:text-slate-700" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                        @endif
                        @if ($index === count($breadcrumbs) - 1)
                            <span class="text-slate-700 dark:text-slate-300 font-bold tracking-wide truncate max-w-[120px]">{{ $crumb['name'] }}</span>
                        @else
                            <a href="{{ $crumb['url'] }}" class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-150">{{ $crumb['name'] }}</a>
                        @endif
                    @endforeach
                </nav>
            </div>

            <!-- Right Elements: Dark/Light toggle, Notifications, Quick Actions, Profile Dropdown -->
            <div class="flex items-center gap-1.5 sm:gap-3">
                
                <!-- Dark / Light theme switcher -->
                <button onclick="toggleAppTheme()" class="p-2 text-slate-400 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-xl focus:outline-none transition-all duration-150" title="Switch Theme">
                    <!-- Sun Icon (visible in Dark Mode) -->
                    <svg id="top-theme-sun" class="w-5.5 h-5.5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                    <!-- Moon Icon (visible in Light Mode) -->
                    <svg id="top-theme-moon" class="w-5.5 h-5.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                </button>

                <!-- Quick Actions Shortcuts -->
                <div class="relative">
                    <button @click="quickActionDropdown = !quickActionDropdown" @click.away="quickActionDropdown = false" 
                            class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-blue-50 dark:bg-blue-600/10 text-blue-600 dark:text-blue-400 font-bold text-xs rounded-xl transition-colors focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="hidden sm:inline">Actions</span>
                    </button>
                    
                    <div x-show="quickActionDropdown" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-52 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1.5"
                         style="display: none;">
                        <div class="px-3.5 py-1.5 text-[10px] font-extrabold text-slate-400 dark:text-slate-500 uppercase tracking-widest border-b border-slate-100 dark:border-slate-800 pb-1.5 mb-1.5">ERP Quick Creators</div>
                        <a href="{{ route('sales.create') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            <span>New Sale Invoice</span>
                        </a>
                        <a href="{{ route('products.create') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <span>Add Product Catalog</span>
                        </a>
                        <a href="{{ route('inventories.transfer.form') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                            <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                            <span>Ship/Transfer Stock</span>
                        </a>
                    </div>
                </div>

                <!-- Notifications Dropdown -->
                <div class="relative">
                    <button @click="notificationDropdown = !notificationDropdown" @click.away="notificationDropdown = false" 
                            class="p-2 text-slate-400 dark:text-slate-500 hover:text-slate-800 dark:hover:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-xl relative focus:outline-none transition-all duration-150">
                        <svg class="w-5.5 h-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.02 6.02 0 00-4.135-5.714V5a2 2 0 10-4 0v.286A6.007 6.02 0 005 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                        </span>
                    </button>

                    <div x-show="notificationDropdown" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-[22rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-2xl z-50 p-1"
                         style="display: none;">
                        
                        <!-- Header -->
                        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider flex items-center gap-1.5">
                                <span class="flex h-2 w-2 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                                </span>
                                ERP System Alerts
                            </span>
                            <span class="bg-blue-100 dark:bg-blue-600/20 text-blue-700 dark:text-blue-400 text-[10px] font-extrabold px-2 py-0.5 rounded-full">4 Alerts</span>
                        </div>
                        
                        <!-- Alert List container -->
                        <div class="p-2 space-y-2 max-h-[30rem] overflow-y-auto">
                            
                            <!-- Danger Alert (Red) -->
                            <div class="p-3.5 rounded-xl border-l-4 border-red-500 bg-red-50/90 dark:bg-red-950/20 hover:bg-red-100/60 dark:hover:bg-red-950/35 transition-all duration-200 shadow-sm flex gap-3">
                                <div class="shrink-0 p-1 bg-white dark:bg-slate-850 rounded-lg shadow-sm">
                                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-xs font-bold text-red-800 dark:text-red-400 truncate">CRITICAL: Stock Out</h4>
                                        <span class="text-[9px] font-semibold text-red-500 dark:text-red-500/80 shrink-0">10m ago</span>
                                    </div>
                                    <p class="text-[11px] text-red-700 dark:text-red-300 mt-1 leading-relaxed font-medium">MacBook Pro M3 is completely out of stock across all active branch warehouses.</p>
                                    <div class="mt-2 flex justify-end">
                                        <a href="{{ route('inventories.create') }}" class="text-[10px] font-bold text-white bg-red-600 hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 px-2.5 py-1 rounded-lg transition-colors shadow-sm">Restock SKU</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Warning Alert (Amber) -->
                            <div class="p-3.5 rounded-xl border-l-4 border-amber-500 bg-amber-50/90 dark:bg-amber-950/20 hover:bg-amber-100/60 dark:hover:bg-amber-950/35 transition-all duration-200 shadow-sm flex gap-3">
                                <div class="shrink-0 p-1 bg-white dark:bg-slate-850 rounded-lg shadow-sm">
                                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-xs font-bold text-amber-800 dark:text-amber-400 truncate">Low Stock Warnings</h4>
                                        <span class="text-[9px] font-semibold text-amber-500 dark:text-amber-500/80 shrink-0">45m ago</span>
                                    </div>
                                    <p class="text-[11px] text-amber-700 dark:text-amber-300 mt-1 leading-relaxed font-medium">Fewer than 5 items remaining on specified branch category inventories.</p>
                                    <div class="mt-2 flex justify-end">
                                        <a href="{{ route('inventories.index') }}" class="text-[10px] font-bold text-amber-900 bg-amber-200 hover:bg-amber-300 dark:bg-amber-500/30 dark:hover:bg-amber-500/40 dark:text-amber-300 px-2.5 py-1 rounded-lg transition-colors">Manage Inventory</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Success Alert (Green) -->
                            <div class="p-3.5 rounded-xl border-l-4 border-emerald-500 bg-emerald-50/90 dark:bg-emerald-950/20 hover:bg-emerald-100/60 dark:hover:bg-emerald-950/35 transition-all duration-200 shadow-sm flex gap-3">
                                <div class="shrink-0 p-1 bg-white dark:bg-slate-850 rounded-lg shadow-sm">
                                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-xs font-bold text-emerald-800 dark:text-emerald-400 truncate">Stock Transfer Completed</h4>
                                        <span class="text-[9px] font-semibold text-emerald-500 dark:text-emerald-500/80 shrink-0">2h ago</span>
                                    </div>
                                    <p class="text-[11px] text-emerald-700 dark:text-emerald-300 mt-1 leading-relaxed font-medium">Dhaka Hub shipment transfer order was successfully authorized and updated.</p>
                                    <div class="mt-2 flex justify-end">
                                        <a href="{{ route('inventories.transfer.form') }}" class="text-[10px] font-bold text-emerald-900 bg-emerald-200 hover:bg-emerald-300 dark:bg-emerald-500/30 dark:hover:bg-emerald-500/40 dark:text-emerald-300 px-2.5 py-1 rounded-lg transition-colors">Shipments Ledger</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Information Alert (Blue) -->
                            <div class="p-3.5 rounded-xl border-l-4 border-blue-500 bg-blue-50/90 dark:bg-blue-950/20 hover:bg-blue-100/60 dark:hover:bg-blue-950/35 transition-all duration-200 shadow-sm flex gap-3">
                                <div class="shrink-0 p-1 bg-white dark:bg-slate-850 rounded-lg shadow-sm">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <h4 class="text-xs font-bold text-blue-800 dark:text-blue-400 truncate">POS Activity Sync Active</h4>
                                        <span class="text-[9px] font-semibold text-blue-500 dark:text-blue-500/80 shrink-0">4h ago</span>
                                    </div>
                                    <p class="text-[11px] text-blue-700 dark:text-blue-300 mt-1 leading-relaxed font-medium">Automatic multi-branch sales registers synchronizing with the central API ledger.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <span class="h-6 w-px bg-slate-200 dark:bg-slate-800 mx-1"></span>

                <!-- User profile dropdown & Avatar -->
                <div class="relative">
                    <button @click="profileDropdown = !profileDropdown" @click.away="profileDropdown = false" 
                            class="inline-flex items-center gap-2 p-1 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-xl focus:outline-none transition-all duration-150">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold text-xs flex items-center justify-center border border-white dark:border-slate-800 shadow-sm relative">
                            {{ substr(Auth::user()->name, 0, 1) }}
                            <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border border-white dark:border-slate-800 rounded-full"></div>
                        </div>
                        <span class="hidden sm:inline text-xs font-semibold text-slate-700 dark:text-slate-300 truncate max-w-[100px]">{{ Auth::user()->name }}</span>
                    </button>

                    <div x-show="profileDropdown" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl z-50 py-1.5"
                         style="display: none;">
                        <div class="px-4 py-2.5 border-b border-slate-100 dark:border-slate-800">
                            <p class="text-xs text-slate-400 dark:text-slate-500 font-medium">ERP Authorized Profile</p>
                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate mt-0.5">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-500 dark:text-slate-400 truncate mt-0.5">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-xs text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors mt-1">
                            <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span>My Profile Settings</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100 dark:border-slate-800 mt-1.5">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-xs text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/20 hover:text-rose-700 dark:hover:text-rose-400 transition-colors text-left font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                <span>Log Out Workspace</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>

<script>
    // Initialize correct sun/moon states based on current loaded theme
    function syncThemeIcons() {
        const isDark = document.documentElement.classList.contains('dark');
        const sun = document.getElementById('top-theme-sun');
        const moon = document.getElementById('top-theme-moon');
        if (sun && moon) {
            if (isDark) {
                sun.classList.remove('hidden');
                moon.classList.add('hidden');
            } else {
                sun.classList.add('hidden');
                moon.classList.remove('hidden');
            }
        }
    }
    
    // Run on topbar navigation load
    setTimeout(syncThemeIcons, 50);

    function toggleAppTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
        syncThemeIcons();
    }
</script>
