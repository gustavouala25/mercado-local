<x-public-layout>

    <!-- HERO SECTION -->
    <div class="py-16 md:py-24 pb-24 relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-neu-base rounded-full shadow-neu-out opacity-50 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-neu-base rounded-full shadow-neu-out opacity-50 translate-x-1/3 translate-y-1/3"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="inline-block p-4 rounded-full shadow-neu-out mb-6 bg-neu-base">
                <span class="text-3xl">🛍️</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold text-neu-text-dark mb-6 leading-tight">
                @if(isset($currentCategory))
                    Explorando: <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-pink-600">{{ $currentCategory->name }}</span>
                @else
                    Descubre lo Mejor de <br/><span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-pink-600">Tu Comunidad</span>
                @endif
            </h1>
            <p class="text-lg md:text-xl text-neu-text max-w-2xl mx-auto mb-10">
                Conectando a Palo Santo en un solo lugar.
            </p>

            <!-- Search Form -->
            <div class="max-w-3xl mx-auto" x-data="{ searchOpen: false }" @click.outside="searchOpen = false">
                <form action="{{ route('market.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-center justify-center">
                    
                    <!-- Category Select (Desktop) -->
                    <div class="relative w-full md:w-1/4 hidden md:block">
                        <select name="category" class="w-full h-14 bg-neu-base border-none rounded-2xl shadow-neu-out text-neu-text px-4 focus:ring-0 focus:shadow-neu-in transition-shadow appearance-none cursor-pointer">
                            <option value="">Todas las Categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-neu-text">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <!-- Search Input (Unified Bar) -->
                    <div class="relative w-full md:w-2/4 flex items-center gap-2">
                        <div class="relative w-full flex items-center bg-neu-base rounded-full shadow-neu-in px-4 h-14">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="¿Qué estás buscando hoy?" 
                                   class="w-full bg-transparent border-none text-neu-text placeholder-gray-400 focus:ring-0 p-0"
                                   @focus="searchOpen = true">
                            <button type="submit" class="ml-2 p-2 text-orange-500 hover:text-orange-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </button>
                        </div>

                        <!-- Clear Button -->
                        @if(request()->filled('search') || request()->filled('category') || request()->filled('sort'))
                            <a href="{{ route('market.index') }}" class="w-14 h-14 bg-neu-base rounded-full shadow-neu-out flex items-center justify-center text-red-500 hover:text-red-600 active:shadow-neu-pressed transition-all flex-shrink-0" title="Limpiar filtros">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </a>
                        @endif
                    </div>

                    <!-- Sort Select -->
                    <div class="relative w-full md:w-1/4 hidden md:block">
                        <select name="sort" class="w-full h-14 bg-neu-base border-none rounded-2xl shadow-neu-out text-neu-text px-4 focus:ring-0 focus:shadow-neu-in transition-shadow appearance-none cursor-pointer" onchange="this.form.submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Más Recientes</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Menor Precio</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Mayor Precio</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-neu-text">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                        </div>
                    </div>
                </form>

                <!-- Mobile Category Chips -->
                <div x-show="searchOpen" 
                     x-transition 
                     class="flex md:hidden overflow-x-auto gap-3 py-4 px-1 no-scrollbar [&::-webkit-scrollbar]:hidden [-ms-overflow-style:'none'] [scrollbar-width:'none']">
                    <a href="{{ route('market.index', array_merge(request()->except('category', 'page'), ['category' => null])) }}" 
                       class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-bold transition-all {{ !request('category') ? 'bg-neu-base shadow-neu-in text-orange-500' : 'bg-neu-base shadow-neu-out text-neu-text' }}">
                        Todas
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('market.index', array_merge(request()->except('category', 'page'), ['category' => $category->slug])) }}" 
                           class="whitespace-nowrap px-4 py-2 rounded-full text-sm font-bold transition-all {{ request('category') == $category->slug ? 'bg-neu-base shadow-neu-in text-orange-500' : 'bg-neu-base shadow-neu-out text-neu-text' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- CATEGORIES GRID (Optional, visual only if needed, or integrated into search) -->
    <!-- Keeping it simple as per request, focusing on products -->

    <!-- FEATURED PRODUCTS -->
    <!-- FEATURED PRODUCTS -->
    @if($featuredProducts->count() > 0)
    <section class="mb-12">
        <div class="flex items-center gap-3 mb-6 px-4">
            <div class="h-8 w-1 bg-orange-500 rounded-full"></div>
            <h2 class="text-xl md:text-2xl font-bold text-neu-text-dark">Destacados</h2>
            <div class="h-1 w-12 bg-orange-400 rounded-full"></div>
        </div>

        <!-- Carousel Container -->
        <div class="flex overflow-x-auto snap-x snap-proximity scroll-smooth no-scrollbar gap-4 px-4 pb-4">
            @foreach($featuredProducts as $product)
            <!-- Product Card -->
            <div class="flex-shrink-0 w-[85%] sm:w-80 snap-center bg-neu-base rounded-3xl shadow-neu-out flex flex-col h-full transform transition-transform duration-300 overflow-hidden">
                <!-- Vendor Header -->
                @if($product->vendor)
                <a href="{{ route('vendor.show', $product->vendor) }}" class="bg-gray-50 px-4 py-2 flex items-center gap-2 hover:bg-orange-50 transition-colors border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="text-xs md:text-sm font-bold text-gray-700 truncate">{{ $product->vendor->name }}</span>
                </a>
                @endif

                <div class="p-3 md:p-4 flex flex-col h-full">
                    <!-- Image Container -->
                    <div class="relative aspect-square mb-3 md:mb-4 rounded-2xl overflow-hidden shadow-neu-in">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/600x400?text=Sin+Foto' }}" 
                             alt="{{ $product->name }}" 
                             loading="eager"
                             decoding="async"
                             class="w-full h-full object-cover aspect-square">
                        <div class="absolute top-2 left-2 bg-neu-base text-orange-500 text-[10px] md:text-xs font-bold px-2 md:px-3 py-1 rounded-full shadow-neu-out">
                            TOP
                        </div>
                        <button x-data @click.prevent="
                            if (navigator.share) {
                                navigator.share({
                                    title: '{{ $product->name }}',
                                    text: 'Mira este producto en Mercado Palosanteño',
                                    url: '{{ route('products.show', $product->slug) }}'
                                });
                            } else {
                                navigator.clipboard.writeText('{{ route('products.show', $product->slug) }}');
                                alert('Enlace copiado al portapapeles');
                            }
                        " class="absolute top-2 right-2 bg-white/70 backdrop-blur rounded-full p-2 shadow-sm hover:bg-white transition-colors z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="flex-grow flex flex-col">
                        <div class="mb-2">
                            <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">
                                {{ $product->category->name ?? 'Varios' }}
                            </p>
                            <h3 class="text-xs md:text-lg font-bold text-neu-text-dark leading-tight line-clamp-2">{{ $product->name }}</h3>
                        </div>
                        
                        <div class="mt-auto pt-2 md:pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm md:text-xl font-bold text-neu-text-dark">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('products.show', $product->slug) }}" class="w-8 h-8 md:w-10 md:h-10 bg-neu-base rounded-full shadow-neu-out flex items-center justify-center text-orange-500 hover:text-orange-600 active:shadow-neu-pressed transition-all">
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                            @if($product->vendor)
                                <a href="{{ route('vendor.show', $product->vendor) }}" class="text-xs text-indigo-600 hover:underline font-semibold mt-3 block text-center">
                                    Ver más de este negocio &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- CATEGORY BLOCKS -->
    @foreach($categories as $category)
    <section class="mb-12">
        <div class="flex items-center justify-between mb-6 px-4">
            <div class="flex items-center gap-3">
                <div class="h-8 w-1 bg-orange-500 rounded-full"></div>
                <h2 class="text-xl md:text-2xl font-bold text-neu-text-dark">{{ $category->name }}</h2>
            </div>
            <a href="{{ route('market.index', ['category' => $category->slug]) }}" class="text-sm font-bold text-orange-500 hover:text-orange-600 transition-colors flex items-center gap-1">
                Ver todo
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <!-- Carousel Container -->
        <div class="flex overflow-x-auto snap-x snap-mandatory scroll-smooth no-scrollbar gap-4 px-4 pb-4">
            @foreach($category->products as $product)
            <!-- Product Card -->
            <div class="flex-shrink-0 w-[85%] md:w-64 snap-center bg-neu-base rounded-3xl shadow-neu-out flex flex-col h-full transform transition-transform duration-300 overflow-hidden">
                <!-- Vendor Header -->
                @if($product->vendor)
                <a href="{{ route('vendor.show', $product->vendor) }}" class="bg-gray-50 px-4 py-2 flex items-center gap-2 hover:bg-orange-50 transition-colors border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="text-xs md:text-sm font-bold text-gray-700 truncate">{{ $product->vendor->name }}</span>
                </a>
                @endif

                <div class="p-3 md:p-4 flex flex-col h-full">
                    <!-- Image Container -->
                    <div class="relative aspect-square mb-3 md:mb-4 rounded-2xl overflow-hidden shadow-neu-in">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/600x400?text=Sin+Foto' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                        <button x-data @click.prevent="
                            if (navigator.share) {
                                navigator.share({
                                    title: '{{ $product->name }}',
                                    text: 'Mira este producto en Mercado Palosanteño',
                                    url: '{{ route('products.show', $product->slug) }}'
                                });
                            } else {
                                navigator.clipboard.writeText('{{ route('products.show', $product->slug) }}');
                                alert('Enlace copiado al portapapeles');
                            }
                        " class="absolute top-2 right-2 bg-white/70 backdrop-blur rounded-full p-2 shadow-sm hover:bg-white transition-colors z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 text-gray-700" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="flex-grow flex flex-col">
                        <div class="mb-2">
                            <h3 class="text-xs md:text-lg font-bold text-neu-text-dark leading-tight line-clamp-2">{{ $product->name }}</h3>
                        </div>
                        
                        <div class="mt-auto pt-2 md:pt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm md:text-xl font-bold text-neu-text-dark">${{ number_format($product->price, 2) }}</span>
                                <a href="{{ route('products.show', $product->slug) }}" class="w-8 h-8 md:w-10 md:h-10 bg-neu-base rounded-full shadow-neu-out flex items-center justify-center text-orange-500 hover:text-orange-600 active:shadow-neu-pressed transition-all">
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                            @if($product->vendor)
                                <a href="{{ route('vendor.show', $product->vendor) }}" class="text-xs text-indigo-600 hover:underline font-semibold mt-3 block text-center">
                                    Ver más de este negocio &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endforeach

    <!-- NO CATEGORIES STATE -->
    @if($categories->isEmpty() && $featuredProducts->isEmpty())
    <div class="flex flex-col items-center justify-center py-20">
        <div class="bg-neu-base rounded-full p-8 shadow-neu-out mb-6">
            <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-neu-text-dark mb-2">No encontramos productos</h3>
        <p class="text-neu-text mb-8">Parece que aún no hay productos activos en ninguna categoría.</p>
    </div>
    @endif

    <x-bottom-nav />
</x-public-layout>
