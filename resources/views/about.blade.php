@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-12 py-10">
    <!-- Hero Section -->
    <div class="text-center space-y-4">
        <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-400 text-xs font-bold tracking-widest uppercase ring-1 ring-inset ring-indigo-700/10">
            Enterprise Grade Solutions
        </div>
        <h1 class="text-5xl font-black tracking-tight text-slate-900 dark:text-white">
            SinodTech <span class="text-indigo-600">ERP</span>
        </h1>
        <p class="text-lg text-slate-500 dark:text-slate-400 max-w-2xl mx-auto">
            A comprehensive, high-performance resource planning system designed for modern enterprises. Scalable, secure, and built with the latest Laravel technologies.
        </p>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="card-premium p-8 group">
            <div class="h-12 w-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-indigo-500/30 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Real-time Analytics</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                Advanced dashboard with live tracking of sales, profit margins, and key performance indicators using Chart.js.
            </p>
        </div>

        <div class="card-premium p-8 group">
            <div class="h-12 w-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Inventory Control</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                Multi-branch stock management with automated low-stock alerts, transfers, and adjustment auditing.
            </p>
        </div>

        <div class="card-premium p-8 group">
            <div class="h-12 w-12 bg-rose-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-rose-500/30 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">CRM & Marketing</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                Integrated customer relationship management with automated mailing and intelligent lost-customer detection.
            </p>
        </div>

        <div class="card-premium p-8 group">
            <div class="h-12 w-12 bg-amber-600 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Secure API</h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                Full RESTful API support with Laravel Sanctum authentication for high-security third-party integrations.
            </p>
        </div>
    </div>

    <!-- Tech Stack -->
    <div class="border-t border-slate-200 dark:border-slate-800 pt-12">
        <h3 class="text-center text-sm font-bold text-slate-400 uppercase tracking-[0.3em] mb-12">Built with Industry Standards</h3>
        <div class="flex flex-wrap justify-center gap-x-16 gap-y-8 opacity-60 grayscale hover:grayscale-0 transition-all duration-500">
            <div class="flex flex-col items-center">
                <span class="text-2xl font-black text-slate-900 dark:text-white">Laravel 11</span>
                <span class="text-[10px] font-bold text-indigo-600 tracking-tighter">BACKEND</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-2xl font-black text-slate-900 dark:text-white">Tailwind 3.4</span>
                <span class="text-[10px] font-bold text-indigo-600 tracking-tighter">UI/UX</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-2xl font-black text-slate-900 dark:text-white">Alpine.js</span>
                <span class="text-[10px] font-bold text-indigo-600 tracking-tighter">INTERACTIVITY</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="text-2xl font-black text-slate-900 dark:text-white">Chart.js</span>
                <span class="text-[10px] font-bold text-indigo-600 tracking-tighter">VISUALIZATION</span>
            </div>
        </div>
    </div>

    <div class="text-center pt-12 pb-20">
        <p class="text-slate-400 text-xs font-bold tracking-widest uppercase">Lead Architect & Developer</p>
        <p class="text-slate-900 dark:text-white text-lg font-black mt-2">Mohaiminul Islam</p>
        <div class="flex justify-center space-x-4 mt-4">
            <a href="https://github.com/mohaiminulislamazim-tech" class="text-indigo-600 hover:text-indigo-700 font-bold text-sm">GitHub</a>
            <span class="text-slate-300">•</span>
            <a href="#" class="text-indigo-600 hover:text-indigo-700 font-bold text-sm">LinkedIn</a>
        </div>
        <p class="text-slate-400 text-[10px] font-bold mt-8 italic">© 2026 SinodTech ERP. All rights reserved.</p>
    </div>
</div>
@endsection
