<x-app-layout>
    <div class="flex bg-slate-50 dark:bg-slate-900 min-h-screen transition-colors duration-200">
        
        <!-- Collapsible Sidebar Navigation -->
        @include("layouts.partials.sidebar")

        <!-- Main Workspace Area -->
        <main class="flex-1 min-w-0 overflow-y-auto">
            
            <!-- Page Title Header -->
            <div class="bg-white dark:bg-slate-950 border-b border-slate-200 dark:border-slate-800/80 py-6 px-8 shadow-sm transition-colors duration-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">About ERP System</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 font-medium">Software identity, license ownership, and engineering credits.</p>
                    </div>
                </div>
            </div>

            <!-- Page Inner Content -->
            <div class="p-8 max-w-4xl mx-auto">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/80 rounded-2xl p-8 shadow-md relative overflow-hidden transition-all duration-200">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-bl-full pointer-events-none"></div>
                    
                    <!-- Branding Badge -->
                    <div class="flex items-center gap-4 mb-8">
                        <div class="bg-blue-600 p-3.5 rounded-2xl border border-blue-500 shadow-md">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">SinodTech <span class="text-blue-500 font-extrabold text-lg bg-blue-50 dark:bg-blue-950/40 px-2 py-0.5 rounded border border-blue-100 dark:border-blue-900">ERP</span></h2>
                            <p class="text-slate-500 dark:text-slate-400 text-xs font-semibold tracking-wide uppercase mt-1">Proprietary Software Systems</p>
                        </div>
                    </div>

                    <!-- System Specifications Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-y border-slate-100 dark:border-slate-800/60 py-6 mb-8">
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Application</h4>
                                <p class="text-lg font-extrabold text-slate-900 dark:text-white mt-1">SinodTech ERP</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Version</h4>
                                <p class="text-lg font-extrabold text-slate-900 dark:text-white mt-1">1.0.0</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Developed By</h4>
                                <p class="text-lg font-extrabold text-blue-600 dark:text-blue-400 mt-1">Mohaiminul Islam</p>
                            </div>
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Copyright Ownership</h4>
                                <p class="text-lg font-extrabold text-slate-900 dark:text-white mt-1">© 2026 Mohaiminul Islam</p>
                                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">All Rights Reserved</p>
                            </div>
                        </div>
                    </div>

                    <!-- Proprietary Protection Details -->
                    <div class="bg-slate-50 dark:bg-slate-950/50 rounded-xl border border-slate-200/60 dark:border-slate-850 p-5">
                        <h3 class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase tracking-wider mb-2 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Copyright & Branding Protection Warning
                        </h3>
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed font-semibold">
                            This enterprise resource planning (ERP) system is highly proprietary software engineered and owned by <strong>Mohaiminul Islam</strong>. 
                            Unauthorized copying, distribution, reverse-engineering, modification, or commercial exploitation of this software code or visual design, in whole or in part, without explicit, written permission from the author is strictly prohibited and subject to legal prosecution.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
