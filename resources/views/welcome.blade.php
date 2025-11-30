<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mercado Local - Productos Artesanales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- HERO SECTION -->
    <div class="bg-indigo-600 w-full shadow-lg">
        
        <!-- NAVIGATION -->
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Left: Logo -->
            <div class="flex items-center gap-2">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                <span class="text-2xl font-bold text-white tracking-tight">Mercado Local</span>
            </div>

            <!-- Right: Auth Links -->
            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-white hover:text-indigo-200 font-semibold transition-colors">Mi Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-indigo-200 font-semibold transition-colors">Soy Vendedor / Entrar</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-white text-indigo-600 hover:bg-indigo-50 font-bold py-2 px-4 rounded-full transition-colors shadow-md">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- HERO CONTENT -->
        <div class="container mx-auto px-4 text-center py-16">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Descubre lo Mejor de <br/><span class="text-indigo-200">Tu Comunidad</span>
            </h1>
            <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto mb-10">
                Apoya a los emprendedores locales y encuentra productos únicos cerca de ti.
            </p>

            <!-- Search Form -->
            <div class="max-w-4xl mx-auto bg-white p-2 rounded-2xl shadow-2xl transform -translate-y-0">
                <form action="{{ route('market.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                    <div class="w-full md:w-1/3">
                        <select name="category" class="w-full h-14 border-transparent focus:border-indigo-500 focus:ring-0 text-gray-700 rounded-xl bg-gray-50 px-4 font-medium">
                            <option value="">Todas las Categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->icon }} {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-2/3 flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="¿Qué estás buscando hoy?" class="w-full h-14 border-transparent focus:border-indigo-500 focus:ring-0 text-gray-700 rounded-xl bg-gray-50 px-4">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 rounded-xl transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-indigo-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto px-4 py-16 flex-grow">

        <!-- Featured Products Section -->
        @if($featuredProducts->count() > 0)
        <section class="mb-20">
            <div class="flex items-center gap-3 mb-8">
                <span class="text-3xl">🔥</span>
                <h2 class="text-3xl font-bold text-gray-900">Productos Destacados</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-yellow-400 relative group h-full flex flex-col overflow-hidden transform hover:-translate-y-1">
                    <div class="absolute top-4 right-0 bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-l-full z-10 shadow-sm">
                        DESTACADO
                    </div>
                    <div class="aspect-w-4 aspect-h-3 w-full bg-gray-100 relative overflow-hidden">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/600x400?text=Sin+Foto' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-64 object-cover object-center group-hover:scale-110 transition-transform duration-500">
                        <!-- Overlay on hover -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-2">
                            <p class="text-xs font-bold text-indigo-600 uppercase tracking-wide">{{ $product->category->name ?? 'Varios' }}</p>
                            <h3 class="text-xl font-bold text-gray-900 truncate leading-tight">{{ $product->name }}</h3>
                        </div>
                        <p class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            {{ $product->vendor->name ?? 'Vendedor Local' }}
                        </p>
                        
                        <div class="mt-auto pt-4 border-t border-gray-100">
                            <div class="flex items-end justify-between mb-4">
                                <span class="text-2xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('products.show', $product->slug) }}" class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-center font-semibold py-2.5 px-4 rounded-xl transition-colors">
                                    Ver Detalle
                                </a>
                                <a href="{{ $product->whatsapp_link }}" target="_blank" class="block w-full bg-green-500 hover:bg-green-600 text-white text-center font-semibold py-2.5 px-4 rounded-xl transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $regularProducts->links() }}
            </div>
            @else
            <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-lg">No se encontraron productos que coincidan con tu búsqueda.</p>
                <a href="{{ route('market.index') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold mt-4 inline-block">Ver todos los productos</a>
            </div>
            @endif
        </section>

    </main>

    @include('layouts.footer')

</body>
</html>
