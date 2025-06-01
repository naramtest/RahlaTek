<header
    {{ $attributes->class(["main-padding relative sticky top-0 z-50 border-b border-[#D9E2E4]/30 backdrop-blur-xl"]) }}
>
    <div class="flex items-center justify-between py-4">
        <!-- Logo Section -->
        <div class="group flex items-center gap-x-3">
            <div class="relative">
                <!-- Car Icon -->
                <svg
                    class="h-8 w-8 text-[#32BA9A] transition-transform duration-300 group-hover:scale-110"
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
                    class="absolute inset-0 rounded-full bg-[#32BA9A] opacity-20 blur-xl transition-opacity duration-300 group-hover:opacity-40"
                ></div>
            </div>
            <span
                class="bg-gradient-to-r from-[#32BA9A] to-[#233446] bg-clip-text text-2xl font-bold text-transparent"
            >
                Carviex
            </span>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden items-center gap-x-8 lg:flex">
            @foreach (\App\Helpers\Nav::get() as $navItem)
                <x-admin.layout.header-desktop-item
                    href="{{$navItem['route']}}"
                >
                    {{ $navItem["title"] }}
                </x-admin.layout.header-desktop-item>
            @endforeach

            <!-- Language Toggle Button -->
            <a
                href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale() === "en" ? "ar" : "en", null, [], true) }}"
                class="flex items-center rounded-md border border-[#32BA9A] px-3 py-2 text-[#32BA9A] transition-all duration-300 hover:scale-105 hover:bg-[#32BA9A]/10 hover:text-black/80"
            >
                <!-- Languages Icon -->
                <svg
                    class="me-2 h-4 w-4"
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
                <span>
                    {{ app()->getLocale() === "en" ? "English" : "العربية" }}
                </span>
            </a>

            <!-- Login Button -->
            <button
                class="rounded-md border border-[#32BA9A] px-4 py-2 text-[#32BA9A] transition-all duration-300 hover:scale-105 hover:bg-[#32BA9A]/10 hover:text-black/80"
            >
                <span>{{ __("general.Login") }}</span>
            </button>

            <!-- Demo Button -->
            <button
                class="flex items-center rounded-md bg-gradient-to-r from-[#32BA9A] to-[#233446] px-4 py-2 text-white shadow-lg transition-all duration-300 hover:scale-105 hover:from-[#32BA9A]/90 hover:to-[#233446]/90 hover:shadow-xl"
            >
                <!-- Sparkles Icon -->
                <svg
                    class="me-2 h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"
                    ></path>
                </svg>
                <span>{{ __("admin.Try Demo") }}</span>
            </button>
        </nav>

        <!-- Mobile Menu Button -->
        <div class="lg:hidden" x-data="{ mobileMenuOpen: false }">
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="rounded-md p-2 text-[#233446] transition-colors duration-300 hover:text-[#32BA9A]"
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

            <!-- Mobile Menu -->
            <div
                x-show="mobileMenuOpen"
                @click.away="mobileMenuOpen = false"
                x-transition:enter="transition duration-200 ease-out"
                x-transition:enter-start="scale-95 opacity-0"
                x-transition:enter-end="scale-100 opacity-100"
                x-transition:leave="transition duration-150 ease-in"
                x-transition:leave-start="scale-100 opacity-100"
                x-transition:leave-end="scale-95 opacity-0"
                class="absolute left-0 right-0 top-full border-t border-[#D9E2E4]/50 bg-white/95 shadow-lg backdrop-blur-lg"
                x-cloak
            >
                <div class="space-y-4 px-4 py-6">
                    @foreach (\App\Helpers\Nav::get() as $navItem)
                        <x-admin.layout.header-mobile-item
                            herf="{{$navItem['route']}}"
                        >
                            {{ $navItem["title"] }}
                        </x-admin.layout.header-mobile-item>
                    @endforeach

                    <div class="space-y-3 border-t border-[#D9E2E4] pt-4">
                        <button
                            @click="toggleLanguage()"
                            class="w-full text-left font-medium text-[#233446] transition-colors duration-300 hover:text-[#32BA9A]"
                        >
                            <span>
                                {{ app()->getLocale() === "en" ? "English" : "العربية" }}
                            </span>
                        </button>

                        <button
                            class="w-full text-left font-medium text-[#233446] transition-colors duration-300 hover:text-[#32BA9A]"
                        >
                            <span>{{ __("general.Login") }}</span>
                        </button>

                        <button
                            class="w-full rounded-md bg-gradient-to-r from-[#32BA9A] to-[#233446] px-4 py-2 text-white transition-all duration-300 hover:scale-105"
                        >
                            <span>{{ __("admin.Try Demo") }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
