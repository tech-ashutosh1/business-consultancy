<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Fade in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Slide in from left */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Slide in from right */
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Scale in animation */
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Bounce animation */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Page load animation */
        .page-content {
            animation: fadeIn 0.6s ease-out;
        }

        /* Scroll reveal animation */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stagger animation delays */
        .scroll-reveal:nth-child(1) {
            transition-delay: 0.1s;
        }

        .scroll-reveal:nth-child(2) {
            transition-delay: 0.2s;
        }

        .scroll-reveal:nth-child(3) {
            transition-delay: 0.3s;
        }

        .scroll-reveal:nth-child(4) {
            transition-delay: 0.4s;
        }

        /* Button pulse effect */
        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }
        }

        .btn-pulse:hover {
            animation: pulse 1.5s infinite;
        }

        /* Loading spinner */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .loading-spinner {
            animation: spin 1s linear infinite;
        }

        /* Shimmer effect */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .shimmer {
            background: linear-gradient(to right, #f0f0f0 0%, #f8f8f8 20%, #f0f0f0 40%, #f0f0f0 100%);
            background-size: 1000px 100%;
            animation: shimmer 2s linear infinite;
        }
    </style>
</head>

<body class="bg-gray-50">
    {{-- Header --}}
    <header class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                {{-- Logo/Brand --}}
                <a href="/dashboard" class="text-2xl font-bold hover:opacity-90 transition">
                    Business Consultancy <span class="text-sm font-normal opacity-80">Admin</span>
                </a>

                {{-- Desktop Navigation --}}
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}"
                        class="hover:text-indigo-200 transition font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-200 border-b-2 border-indigo-200 pb-1' : '' }}">
                        📊 Dashboard
                    </a>
                    <a href="{{ route('services.index') }}"
                        class="hover:text-indigo-200 transition font-medium {{ request()->is('admin/services*') ? 'text-indigo-200 border-b-2 border-indigo-200 pb-1' : '' }}">
                        🛠️ Manage Services
                    </a>
                    <a href="{{ route('analytics.index') }}"
                        class="hover:text-indigo-200 transition font-medium {{ request()->routeIs('analytics.*') ? 'text-indigo-200 border-b-2 border-indigo-200 pb-1' : '' }}">
                        📊 Analytics
                    </a>
                    <a href="{{ route('blog.index') }}"
                        class="hover:text-indigo-200 transition font-medium {{ request()->routeIs('blog.*') ? 'text-indigo-200 border-b-2 border-indigo-200 pb-1' : '' }}">
                        📝 Blog
                    </a>
                    <a href="/home" class="hover:text-indigo-200 transition font-medium" target="_blank">
                        🌐 View Website
                    </a>

                    {{-- User Dropdown --}}
                    <div class="relative group">
                        <button
                            class="flex items-center space-x-2 bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <div class="py-2">
                                <div class="px-4 py-2 text-sm text-gray-500 border-b">
                                    {{ Auth::user()->email }}
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>

                {{-- Mobile Menu Button --}}
                <button class="md:hidden focus:outline-none" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div id="mobileMenu" class="hidden md:hidden pb-4 border-t border-white border-opacity-20 mt-2 pt-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="block py-2 hover:text-indigo-200 transition {{ request()->routeIs('dashboard') ? 'text-indigo-200 font-semibold' : '' }}">
                            📊 Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services.index') }}"
                            class="block py-2 hover:text-indigo-200 transition {{ request()->is('admin/services*') ? 'text-indigo-200 font-semibold' : '' }}">
                            🛠️ Manage Services
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('analytics.index') }}"
                            class="block py-2 hover:text-indigo-200 transition {{ request()->routeIs('analytics.*') ? 'text-indigo-200 font-semibold' : '' }}">
                            📊 Analytics
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}"
                            class="block py-2 hover:text-indigo-200 transition {{ request()->routeIs('blog.*') ? 'text-indigo-200 font-semibold' : '' }}">
                            📝 Blog
                        </a>
                    </li>
                    <li>
                        <a href="/home" class="block py-2 hover:text-indigo-200 transition" target="_blank">
                            🌐 View Website
                        </a>
                    </li>
                    <li class="pt-2 border-t border-white border-opacity-20">
                        <div class="text-sm opacity-80 mb-2">{{ Auth::user()->name }}</div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-left hover:text-indigo-200 transition">
                                🚪 Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    {{-- Page Header (optional slot) --}}
    @isset($header)
        <div class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                {{ $header }}
            </div>
        </div>
    @endisset

    {{-- Main Content --}}
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-300 text-sm">
                    &copy; {{ date('Y') }} Business Consultancy. All rights reserved.
                </p>
                <p class="text-gray-400 text-xs mt-2 md:mt-0">
                    Admin Panel • Logged in as {{ Auth::user()->name }}
                </p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Scroll reveal animation
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.scroll-reveal');

            reveals.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 100;

                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
        }

        // Run on scroll
        window.addEventListener('scroll', revealOnScroll);

        // Run on page load
        window.addEventListener('load', revealOnScroll);

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading state to forms on submit
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function () {
                const button = this.querySelector('button[type="submit"], .btn-submit');
                if (button && !button.classList.contains('loading')) {
                    const originalText = button.innerHTML;
                    button.classList.add('loading');
                    button.disabled = true;
                    button.innerHTML = `
                    <svg class="loading-spinner inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                `;
                }
            });
        });
    </script>
</body>

</html>