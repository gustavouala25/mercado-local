<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Mercado Palosanteño') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-neu-base text-neu-text antialiased min-h-screen flex flex-col">

    <!-- NAVIGATION -->
    <nav class="bg-neu-base shadow-neu-out rounded-b-3xl mb-8 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Left: Logo -->
            <a href="{{ route('market.index') }}" class="flex items-center gap-3 group">
                <div class="p-2 rounded-full shadow-neu-out group-hover:shadow-neu-in transition-shadow duration-300 bg-neu-base">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="text-2xl font-bold text-neu-text-dark tracking-tight group-hover:text-orange-500 transition-colors">Mercado Palosanteño</span>
            </a>

            <!-- Right: Auth Links -->
            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    <!-- Desktop Links -->
                    <div class="hidden md:flex items-center gap-6">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-neu-text font-semibold hover:text-orange-500 transition-colors">Mi Panel</a>
                        @else
                            <a href="{{ route('login') }}" class="text-neu-text font-semibold hover:text-orange-500 transition-colors">Entrar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-neu-base text-neu-text-dark font-bold py-2 px-6 rounded-full shadow-neu-out hover:shadow-neu-in active:shadow-neu-pressed transition-all duration-300">Registrarse</a>
                            @endif
                        @endauth
                    </div>

                    <!-- Mobile User Icon -->
                    <div class="flex md:hidden">
                         @auth
                            <a href="{{ url('/dashboard') }}" class="w-10 h-10 bg-white/50 backdrop-blur-sm rounded-full shadow-neu-out flex items-center justify-center text-orange-500 hover:text-orange-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-10 h-10 bg-white/50 backdrop-blur-sm rounded-full shadow-neu-out flex items-center justify-center text-neu-text hover:text-orange-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-grow container mx-auto px-4">
        {{ $slot }}
    </main>

    @include('layouts.footer')

</body>
</html>
