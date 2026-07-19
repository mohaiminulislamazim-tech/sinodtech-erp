<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SinodTech ERP | Developed by Mohaiminul Islam</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .dark .glass-card {
            background: rgba(15, 23, 42, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="font-sans antialiased h-full text-slate-900 dark:text-slate-100 bg-slate-50 dark:bg-slate-950 transition-colors duration-200">
    <div class="min-h-screen flex flex-col md:flex-row relative overflow-hidden">
        
        <!-- Animated / Glowing background blobs (ambient design) -->
        <div class="absolute top-0 -left-4 w-96 h-96 bg-blue-500 rounded-full filter blur-3xl opacity-20 dark:opacity-30 animate-pulse"></div>
        <div class="absolute bottom-0 -right-4 w-96 h-96 bg-sky-500 rounded-full filter blur-3xl opacity-20 dark:opacity-30 animate-pulse duration-5000"></div>

        <!-- Left Side: Enterprise Illustration & Branding (Visible on desktop) -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-[#1E40AF] via-[#2563EB] to-[#0EA5E9] p-12 flex-col justify-between relative overflow-hidden shadow-2xl z-10">
            <!-- Background pattern/grid -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff0a_1px,transparent_1px),linear-gradient(to_bottom,#ffffff0a_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none"></div>
            
            <div class="flex items-center gap-3 relative z-20">
                <div class="bg-white/10 p-2.5 rounded-xl border border-white/20 shadow-md">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold tracking-tight text-white font-sans">SinodTech <span class="font-extrabold text-sky-200">ERP</span></h2>
                </div>
            </div>

            <!-- Dynamic SVG Tech Illustration -->
            <div class="my-auto flex flex-col items-center justify-center relative z-20">
                <svg class="w-3/4 max-w-sm drop-shadow-2xl text-white/90 animate-bounce-slow" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Dashboard Outline -->
                    <rect x="50" y="80" width="400" height="280" rx="20" fill="currentColor" fill-opacity="0.05" stroke="currentColor" stroke-width="6" />
                    <!-- Top Bar of Dashboard -->
                    <rect x="50" y="80" width="400" height="50" rx="20" fill="currentColor" fill-opacity="0.1" />
                    <circle cx="90" cy="105" r="8" fill="currentColor" fill-opacity="0.4" />
                    <circle cx="115" cy="105" r="8" fill="currentColor" fill-opacity="0.4" />
                    <circle cx="140" cy="105" r="8" fill="currentColor" fill-opacity="0.4" />
                    
                    <!-- Analytics Bars & Cards inside SVG -->
                    <rect x="80" y="160" width="140" height="110" rx="12" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="3" />
                    <path d="M100 230 L130 200 L160 215 L200 175" stroke="#38BDF8" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="200" cy="175" r="5" fill="#38BDF8" />
                    
                    <rect x="240" y="160" width="180" height="110" rx="12" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="3" />
                    <!-- Mini charts -->
                    <rect x="270" y="220" width="20" height="30" rx="4" fill="currentColor" fill-opacity="0.5" />
                    <rect x="300" y="190" width="20" height="60" rx="4" fill="#38BDF8" />
                    <rect x="330" y="210" width="20" height="40" rx="4" fill="currentColor" fill-opacity="0.5" />
                    <rect x="360" y="180" width="20" height="70" rx="4" fill="currentColor" />
                    
                    <!-- Lower Status Line -->
                    <rect x="80" y="295" width="340" height="35" rx="8" fill="currentColor" fill-opacity="0.1" stroke="currentColor" stroke-width="2" />
                    <circle cx="105" cy="312.5" r="6" fill="#4ADE80" />
                    <line x1="125" y1="312.5" x2="390" y2="312.5" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-opacity="0.3" />
                </svg>

                <div class="mt-8 text-center max-w-md">
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">Enterprise Operations, Perfected.</h1>
                    <p class="mt-3 text-lg text-blue-100">Unlock complete inventory visibility, deep relationship management, and streamlined transaction analytics in one seamless experience.</p>
                </div>
            </div>

            <!-- Footer information in Left side -->
            <div class="text-blue-100/70 text-sm relative z-20">
                &copy; 2026 SinodTech ERP. All rights reserved.<br>
                Developed by Mohaiminul Islam
            </div>
        </div>

        <!-- Right Side: Login Card with Glassmorphism -->
        <div class="flex-1 flex flex-col justify-center items-center p-6 sm:p-12 relative z-20 bg-gradient-to-tr from-slate-50 to-blue-50 dark:from-slate-950 dark:to-indigo-950 md:bg-none">
            
            <!-- Dark Mode Toggle Button in the Corner -->
            <button onclick="toggleDarkMode()" class="absolute top-6 right-6 p-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-md text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                <svg id="theme-sun" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-moon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
            </button>

            <!-- Brand header (Visible on mobile/tablet) -->
            <div class="md:hidden flex flex-col items-center text-center mb-8">
                <div class="bg-gradient-to-br from-[#2563EB] to-[#0EA5E9] p-3 rounded-2xl border border-white/20 shadow-lg mb-3">
                    <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">SinodTech ERP</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm font-medium">Enterprise Resource Planning System</p>
            </div>

            <!-- Login Glassmorphic Container -->
            <div class="w-full max-w-md glass-card bg-white/70 dark:bg-slate-900/60 p-8 sm:p-10 rounded-2xl shadow-2xl border border-white/20 dark:border-slate-800/80 transition-all duration-300">
                <div class="hidden md:block text-center mb-8">
                    <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white">Access Your Workspace</h2>
                    <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm">Enterprise Resource Planning System</p>
                </div>

                <!-- Session Status / Alert Notification -->
                @if (session('status'))
                    <div class="mb-5 p-4 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/20 border border-emerald-500/20 dark:border-emerald-500/30 text-emerald-600 dark:text-emerald-400 text-sm font-medium flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Email Address</label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                class="block w-full pl-11 pr-4 py-3 bg-white/50 dark:bg-slate-950/40 border border-slate-300 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-600 transition-all duration-200 text-base"
                                placeholder="name@company.com">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-rose-500 font-semibold flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 dark:text-slate-500">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="block w-full pl-11 pr-11 py-3 bg-white/50 dark:bg-slate-950/40 border border-slate-300 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 dark:focus:border-blue-600 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-600 transition-all duration-200 text-base"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                                <svg id="eye-icon-show" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c3.55 0 7.303 2.505 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye-icon-hide" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.003 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-rose-500 font-semibold flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me Option -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-slate-300 dark:border-slate-800 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 bg-white/50 dark:bg-slate-950/40 w-4 h-4 cursor-pointer">
                        <label for="remember_me" class="ml-2 text-sm font-semibold text-slate-600 dark:text-slate-400 cursor-pointer select-none">
                            Keep me signed in
                        </label>
                    </div>

                    <!-- Submit Button with loading state -->
                    <div>
                        <button type="submit" id="submitBtn"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-[#2563EB] hover:bg-[#1E40AF] active:bg-[#1d4ed8] text-white font-semibold text-base rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-slate-950 transition-all duration-150 shadow-lg shadow-blue-500/25">
                            
                            <!-- Spinner (hidden by default) -->
                            <svg id="loadingSpinner" class="animate-spin -ml-1 mr-1 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            
                            <span id="btnText">Sign In</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bottom login page footer -->
            <div class="mt-8 text-center text-xs text-slate-400 dark:text-slate-500 font-medium">
                Developed by Mohaiminul Islam
            </div>
        </div>
    </div>

    <!-- JavaScript logic -->
    <script>
        // Check local storage or prefers-color-scheme for Dark Mode
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.getElementById('theme-sun').classList.remove('hidden');
            document.getElementById('theme-moon').classList.add('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            document.getElementById('theme-sun').classList.add('hidden');
            document.getElementById('theme-moon').classList.remove('hidden');
        }

        function toggleDarkMode() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                document.getElementById('theme-sun').classList.add('hidden');
                document.getElementById('theme-moon').classList.remove('hidden');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                document.getElementById('theme-sun').classList.remove('hidden');
                document.getElementById('theme-moon').classList.add('hidden');
            }
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const showIcon = document.getElementById('eye-icon-show');
            const hideIcon = document.getElementById('eye-icon-hide');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showIcon.classList.add('hidden');
                hideIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                showIcon.classList.remove('hidden');
                hideIcon.classList.add('hidden');
            }
        }

        // Handle loading state on submit
        document.getElementById('loginForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const btnText = document.getElementById('btnText');

            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-85', 'cursor-not-allowed');
            loadingSpinner.classList.remove('hidden');
            btnText.textContent = 'Verifying credentials...';
        });
    </script>
</body>
</html>
