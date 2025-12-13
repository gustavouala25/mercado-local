<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#f97316">
        <link rel="manifest" href="/manifest.webmanifest">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            [x-cloak] { display: none !important; }
        </style>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Nunito', 'sans-serif'],
                        },
                        colors: {
                            'neu-base': '#E0E5EC',
                            'neu-text': '#4A5568',
                            'neu-text-dark': '#2D3748',
                        },
                        boxShadow: {
                            'neu-out': '9px 9px 16px rgb(163,177,198,0.6), -9px -9px 16px rgba(255,255,255, 0.5)',
                            'neu-in': 'inset 6px 6px 10px 0 rgba(163,177,198, 0.7), inset -6px -6px 10px 0 rgba(255,255,255, 0.8)',
                            'neu-pressed': 'inset 4px 4px 8px 0 rgba(163,177,198, 0.7), inset -4px -4px 8px 0 rgba(255,255,255, 0.8)',
                        },
                    }
                }
            }
        </script>
        <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
    </head>
    <body class="font-sans antialiased bg-neu-base text-neu-text">
        <div class="min-h-screen bg-neu-base">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-neu-base shadow-neu-out mb-8 rounded-b-3xl">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-24">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
