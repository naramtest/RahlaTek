<!DOCTYPE html>
<html
    lang="{{ str_replace("_", "-", app()->getLocale()) }}"
    dir="{{ app()->getLocale() == "en" ? "ltr" : "rtl" }}"
>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @if (isset($title))
            {{ $title }}
        @else
            <title>{{ getLocalAppName() }}</title>
        @endif

        {{ $seo ?? null }}
        {{ $graph ?? null }}
        {{ $keywords ?? null }}

        <!-- Styles -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
        @stack("header-scripts")

        <!-- Livewire -->
        @livewireStyles
    </head>
    <body class="min-h-screen antialiased">
        <!-- Main Content -->
        <main>
            {{ $slot }}
        </main>
        @stack("scripts")
        @livewireScriptConfig
    </body>
</html>
