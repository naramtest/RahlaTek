<!DOCTYPE html>
<html
    lang="{{ str_replace("_", "-", app()->getLocale()) }}"
    dir="{{ app()->getLocale() == "en" ? "ltr" : "rtl" }}"
    x-data="{
        language: '{{ app()->getLocale() }}',
        darkMode: false,
        mobileMenuOpen: false,
        toggleLanguage() {
            this.language = this.language === 'ar' ? 'en' : 'ar'
            // Here you would make an AJAX call to change the language
        },
        toggleDarkMode() {
            this.darkMode = ! this.darkMode
            localStorage.setItem('darkMode', this.darkMode)
        },
        init() {
            this.darkMode = localStorage.getItem('darkMode') === 'true'
        },
    }"
    x-init="init()"
    :class="{ 'dark': darkMode }"
>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @if (isset($title))
            {{ $title }}
        @else
            <title>{{ config("app.name") }} - Dashboard</title>
        @endif

        {{ $seo ?? null }}
        {{ $graph ?? null }}
        {{ $keywords ?? null }}

        <!-- Cairo Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet"
        />

        <!-- Styles -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
        @stack("header-scripts")

        <!-- Livewire -->
        @livewireStyles

        <style>
            [x-cloak] {
                display: none !important;
            }

            .font-cairo {
                font-family: 'Cairo', sans-serif;
            }
        </style>
    </head>

    <body
        class="font-cairo min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50 antialiased transition-colors duration-300 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900"
    >
        <!-- Navigation Header -->
        <header
            class="relative sticky top-0 z-50 border-b border-slate-200/30 bg-white/80 backdrop-blur-xl transition-all duration-300 dark:border-slate-700/30 dark:bg-slate-900/80"
        >
            <div
                class="container mx-auto flex items-center justify-between px-4 py-4"
            >
                <!-- Logo Section -->
                <div
                    class="group flex items-center space-x-3"
                    :class="language === 'ar' ? 'space-x-reverse' : ''"
                >
                    <div class="relative">
                        <!-- Car Icon using SVG -->
                        <svg
                            class="h-8 w-8 text-emerald-500 transition-transform duration-300 group-hover:scale-110"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"
                            ></path>
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 6h3l4 4v5H4V9l4-4h3V4a1 1 0 011-1h1a1 1 0 011 1v2z"
                            ></path>
                        </svg>
                        <div
                            class="absolute inset-0 rounded-full bg-emerald-500 opacity-20 blur-xl transition-opacity duration-300 group-hover:opacity-40"
                        ></div>
                    </div>
                    <span
                        class="bg-gradient-to-r from-emerald-500 to-slate-700 bg-clip-text text-2xl font-bold text-transparent dark:to-slate-300"
                    >
                        Rahlatek
                    </span>
                </div>

                <!-- Desktop Navigation -->
                <nav
                    class="hidden items-center space-x-8 md:flex"
                    :class="language === 'ar' ? 'space-x-reverse' : ''"
                >
                    <!-- Navigation Links -->
                    <a
                        href="#dashboard"
                        class="group relative font-medium text-slate-700 transition-all duration-300 hover:scale-105 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Dashboard
                        <span
                            class="absolute bottom-0 left-0 h-0.5 w-0 bg-emerald-500 transition-all duration-300 group-hover:w-full"
                        ></span>
                    </a>

                    <a
                        href="#bookings"
                        class="group relative font-medium text-slate-700 transition-all duration-300 hover:scale-105 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Bookings
                        <span
                            class="absolute bottom-0 left-0 h-0.5 w-0 bg-emerald-500 transition-all duration-300 group-hover:w-full"
                        ></span>
                    </a>

                    <a
                        href="#fleet"
                        class="group relative font-medium text-slate-700 transition-all duration-300 hover:scale-105 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Fleet
                        <span
                            class="absolute bottom-0 left-0 h-0.5 w-0 bg-emerald-500 transition-all duration-300 group-hover:w-full"
                        ></span>
                    </a>

                    <a
                        href="#customers"
                        class="group relative font-medium text-slate-700 transition-all duration-300 hover:scale-105 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Customers
                        <span
                            class="absolute bottom-0 left-0 h-0.5 w-0 bg-emerald-500 transition-all duration-300 group-hover:w-full"
                        ></span>
                    </a>

                    <a
                        href="#reports"
                        class="group relative font-medium text-slate-700 transition-all duration-300 hover:scale-105 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Reports
                        <span
                            class="absolute bottom-0 left-0 h-0.5 w-0 bg-emerald-500 transition-all duration-300 group-hover:w-full"
                        ></span>
                    </a>

                    <!-- Action Buttons -->
                    <div
                        class="flex items-center space-x-4"
                        :class="language === 'ar' ? 'space-x-reverse' : ''"
                    >
                        <!-- Dark Mode Toggle -->
                        <button
                            @click="toggleDarkMode()"
                            class="rounded-lg bg-slate-100 p-2 text-slate-600 transition-all duration-300 hover:scale-105 hover:bg-slate-200 dark:bg-slate-700 dark:text-slate-300 dark:hover:bg-slate-600"
                            :title="darkMode ? '{{ __("Light Mode") }}' : '{{ __("Dark Mode") }}'"
                        >
                            <!-- Sun Icon (Light Mode) -->
                            <svg
                                x-show="darkMode"
                                class="h-5 w-5 transition-transform duration-300"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
                                ></path>
                            </svg>
                            <!-- Moon Icon (Dark Mode) -->
                            <svg
                                x-show="!darkMode"
                                class="h-5 w-5 transition-transform duration-300"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
                                ></path>
                            </svg>
                        </button>

                        <!-- Language Toggle -->
                        <button
                            @click="toggleLanguage()"
                            class="flex items-center space-x-2 rounded-lg border border-emerald-500 px-3 py-2 text-emerald-500 transition-all duration-300 hover:scale-105 hover:bg-emerald-50 dark:hover:bg-emerald-500/10"
                            :class="language === 'ar' ? 'space-x-reverse' : ''"
                        >
                            <!-- Globe Icon -->
                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"
                                ></path>
                            </svg>
                            <span
                                class="text-sm font-medium"
                                x-text="language === 'ar' ? 'EN' : 'العربية'"
                            ></span>
                        </button>

                        <!-- User Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button
                                @click="open = !open"
                                class="flex items-center space-x-2 rounded-lg bg-gradient-to-r from-emerald-500 to-slate-700 px-4 py-2 text-white shadow-lg transition-all duration-300 hover:scale-105 hover:from-emerald-600 hover:to-slate-800"
                                :class="language === 'ar' ? 'space-x-reverse' : ''"
                            >
                                <!-- User Icon -->
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    ></path>
                                </svg>
                                <span class="text-sm font-medium">
                                    {{ Auth::user()->name ?? "Admin" }}
                                </span>
                                <!-- Chevron Down -->
                                <svg
                                    class="h-4 w-4 transition-transform duration-300"
                                    :class="open ? 'rotate-180' : ''"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 9l-7 7-7-7"
                                    ></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                x-show="open"
                                @click.away="open = false"
                                x-transition:enter="transition duration-200 ease-out"
                                x-transition:enter-start="scale-95 opacity-0"
                                x-transition:enter-end="scale-100 opacity-100"
                                x-transition:leave="transition duration-150 ease-in"
                                x-transition:leave-start="scale-100 opacity-100"
                                x-transition:leave-end="scale-95 opacity-0"
                                class="absolute right-0 z-50 mt-2 w-48 rounded-lg border border-slate-200 bg-white py-2 shadow-xl dark:border-slate-700 dark:bg-slate-800"
                                :class="language === 'ar' ? 'left-0 right-auto' : ''"
                                x-cloak
                            >
                                <a
                                    href="#profile"
                                    class="block px-4 py-2 text-sm text-slate-700 transition-colors duration-200 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700"
                                >
                                    {{ __("Profile") }}
                                </a>

                                <a
                                    href="#settings"
                                    class="block px-4 py-2 text-sm text-slate-700 transition-colors duration-200 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-700"
                                >
                                    {{ __("Settings") }}
                                </a>

                                <div
                                    class="my-1 border-t border-slate-200 dark:border-slate-600"
                                ></div>

                                <form method="POST" action="">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="block w-full px-4 py-2 text-left text-sm text-red-600 transition-colors duration-200 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20"
                                    >
                                        {{ __("Logout") }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Mobile Menu Button -->
                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="rounded-lg p-2 text-slate-600 transition-all duration-300 hover:bg-slate-100 md:hidden dark:text-slate-300 dark:hover:bg-slate-700"
                >
                    <!-- Hamburger Icon -->
                    <svg
                        x-show="!mobileMenuOpen"
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        ></path>
                    </svg>
                    <!-- Close Icon -->
                    <svg
                        x-show="mobileMenuOpen"
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div
                x-show="mobileMenuOpen"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="scale-95 opacity-0"
                x-transition:enter-end="scale-100 opacity-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="scale-100 opacity-100"
                x-transition:leave-end="scale-95 opacity-0"
                class="border-t border-slate-200 bg-white md:hidden dark:border-slate-700 dark:bg-slate-800"
                x-cloak
            >
                <div class="space-y-4 px-4 py-4">
                    <!-- Mobile Navigation Links -->
                    <a
                        href="#dashboard"
                        class="block py-2 font-medium text-slate-700 transition-colors duration-300 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Dashboard
                    </a>

                    <a
                        href="#bookings"
                        class="block py-2 font-medium text-slate-700 transition-colors duration-300 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Bookings
                    </a>

                    <a
                        href="#fleet"
                        class="block py-2 font-medium text-slate-700 transition-colors duration-300 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Fleet
                    </a>

                    <a
                        href="#customers"
                        class="block py-2 font-medium text-slate-700 transition-colors duration-300 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Customers
                    </a>

                    <a
                        href="#reports"
                        class="block py-2 font-medium text-slate-700 transition-colors duration-300 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                    >
                        Reports
                    </a>

                    <!-- Mobile Action Buttons -->
                    <div
                        class="space-y-3 border-t border-slate-200 pt-4 dark:border-slate-700"
                    >
                        <button
                            @click="toggleDarkMode()"
                            class="flex w-full items-center space-x-3 text-left text-slate-700 transition-colors duration-300 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                            :class="language === 'ar' ? 'space-x-reverse' : ''"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    :d="darkMode ? 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z' : 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z'"
                                ></path>
                            </svg>
                            <span
                                x-text="darkMode ? '{{ __("Light Mode") }}' : '{{ __("Dark Mode") }}'"
                            ></span>
                        </button>

                        <button
                            @click="toggleLanguage()"
                            class="flex w-full items-center space-x-3 text-left text-slate-700 transition-colors duration-300 hover:text-emerald-500 dark:text-slate-300 dark:hover:text-emerald-400"
                            :class="language === 'ar' ? 'space-x-reverse' : ''"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"
                                ></path>
                            </svg>
                            <span
                                x-text="language === 'ar' ? 'Switch to English' : 'التبديل للعربية'"
                            ></span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="relative z-10">
            {{ $slot }}
        </main>

        <!-- Background Animation Elements -->
        <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
            <div
                class="absolute -right-40 -top-40 h-80 w-80 animate-pulse rounded-full bg-gradient-to-r from-emerald-500/10 to-slate-500/10 blur-3xl"
            ></div>
            <div
                class="absolute -bottom-40 -left-40 h-80 w-80 animate-pulse rounded-full bg-gradient-to-r from-emerald-500/10 to-slate-800/10 blur-3xl"
                style="animation-delay: 1s"
            ></div>
            <div
                class="absolute left-1/2 top-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 transform animate-pulse rounded-full bg-gradient-to-r from-slate-500/5 to-emerald-500/5 blur-3xl"
                style="animation-delay: 0.5s"
            ></div>
        </div>

        @stack("scripts")

        <!-- Livewire Scripts -->
        @livewireScriptConfig

        <!-- GSAP Animation Script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script>
            // GSAP Animations
            document.addEventListener('DOMContentLoaded', function () {
                // Animate header on load
                gsap.from('header', {
                    duration: 1,
                    y: -100,
                    opacity: 0,
                    ease: 'power3.out',
                });

                // Animate logo
                gsap.from('header .group', {
                    duration: 1.2,
                    scale: 0,
                    rotation: -180,
                    ease: 'back.out(1.7)',
                    delay: 0.3,
                });

                // Animate navigation links
                gsap.from('nav a', {
                    duration: 0.8,
                    y: 30,
                    opacity: 0,
                    stagger: 0.1,
                    ease: 'power2.out',
                    delay: 0.6,
                });

                // Animate action buttons
                gsap.from('nav button, nav .relative', {
                    duration: 0.8,
                    scale: 0,
                    opacity: 0,
                    stagger: 0.1,
                    ease: 'back.out(1.7)',
                    delay: 0.9,
                });
            });
        </script>
    </body>
</html>
