<!DOCTYPE html>
<html
    lang="{{ str_replace("_", "-", app()->getLocale()) }}"
    dir="{{ app()->getLocale() == "en" ? "ltr" : "rtl" }}"
    x-data="{
        language: '{{ app()->getLocale() }}',
    }"
>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @if (isset($title))
            {{ $title }}
        @else
            <title>{{ config("app.name") }}</title>
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
        @vite(["resources/css/app.css", "resources/js/app.js", "resources/css/admin.css", "resources/js/admin/admin.js"])
        @stack("header-scripts")

        <!-- Livewire -->
        @livewireStyles
    </head>

    <body
        class="font-cairo min-h-screen overflow-x-hidden bg-gradient-to-br from-[#D9E2E4] via-white to-[#D9E2E4]/50"
    >
        <!-- Animated Background Elements -->
        <div class="pointer-events-none fixed inset-0 overflow-hidden">
            <div
                class="absolute -right-40 -top-40 h-80 w-80 animate-pulse rounded-full bg-gradient-to-r from-[#32BA9A]/20 to-[#233446]/20 blur-3xl"
            ></div>
            <div
                class="absolute -bottom-40 -left-40 h-80 w-80 animate-pulse rounded-full bg-gradient-to-r from-[#32BA9A]/20 to-[#151D26]/20 blur-3xl"
                style="animation-delay: 1000ms"
            ></div>
            <div
                class="absolute left-1/2 top-1/2 h-96 w-96 -translate-x-1/2 -translate-y-1/2 transform animate-pulse rounded-full bg-gradient-to-r from-[#233446]/10 to-[#32BA9A]/10 blur-3xl"
                style="animation-delay: 500ms"
            ></div>
        </div>

        <!-- Header Component -->
        <x-admin.layout.header />

        <!-- Main Content -->
        <main class="main-padding relative z-10">
            {{ $slot }}
        </main>

        <!-- CTA Section -->
        <x-admin.layout.cta-section />
        <!-- Footer Component -->
        <x-admin.layout.footer />

        @stack("scripts")
        @livewireScriptConfig
    </body>
</html>
