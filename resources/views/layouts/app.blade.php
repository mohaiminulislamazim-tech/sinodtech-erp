<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SinodTech ERP | Developed by Mohaiminul Islam</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script>
            // Inline theme loader to avoid flash of wrong theme
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        @vite(["resources/css/app.css", "resources/js/app.js"])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <style>
            /* Custom Scrollbar for premium ERP feel */
            ::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }
            ::-webkit-scrollbar-track {
                background: transparent;
            }
            ::-webkit-scrollbar-thumb {
                background: #CBD5E1;
                border-radius: 4px;
            }
            .dark ::-webkit-scrollbar-thumb {
                background: #475569;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #94A3B8;
            }
        </style>
    </head>
    <body class="font-sans antialiased h-full text-slate-900 dark:text-slate-100 bg-[#F8FAFC] dark:bg-[#0F172A] transition-colors duration-200">
        <div class="min-h-screen flex flex-col">
            <!-- Premium Navigation Bar -->
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="flex-1 flex flex-col">
                {{ $slot }}
            </main>

            <!-- Copyright Footer -->
            <footer class="py-4 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 text-center text-xs text-slate-400 dark:text-slate-500 z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-2 font-medium">
                    <p>© 2026 SinodTech ERP &middot; Developed by Mohaiminul Islam</p>
                    <div class="flex gap-4">
                        <a href="{{ route('about') }}" class="text-blue-600 dark:text-blue-400 hover:underline">About ERP</a>
                    </div>
                </div>
            </footer>
        </div>
        @stack("scripts")
    </body>
</html>
