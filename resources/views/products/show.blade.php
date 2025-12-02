<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} - Mercado Palosanteño</title>
    
    <!-- SEO Meta Tags -->
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:description" content="{{ Str::limit($product->description, 150) }}" />
    <meta property="og:image" content="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/600x400?text=Sin+Foto' }}" />
    <meta property="og:url" content="{{ route('products.show', $product->slug) }}" />
    <meta property="og:type" content="product" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex flex-col">

    <!-- Floating Back Button -->
    <a href="{{ route('market.index') }}" class="fixed top-4 left-4 z-50 bg-white/90 backdrop-blur-sm shadow-lg border border-gray-200 text-gray-700 hover:text-indigo-600 font-semibold py-2 px-4 rounded-full transition-all duration-200 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Volver al Inicio
    </a>

    <main class="container mx-auto px-4 py-12 flex-grow flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-6xl w-full border border-gray-100">
            <div class="flex flex-col lg:flex-row">
                
                <!-- Image Section (Left) -->
                <div class="w-full lg:w-1/2 bg-gray-100 relative group">
                    <div class="aspect-w-4 aspect-h-3 lg:h-full">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/600x400?text=Sin+Foto' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover object-center">
                    </div>
                </div>

                <!-- Details Section (Right) -->
                <div class="w-full lg:w-1/2 p-8 lg:p-12 flex flex-col">
                    
                    <!-- Category & Vendor -->
                    <div class="flex items-center gap-2 mb-4 text-sm font-medium text-gray-500">
                        <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full">
                            {{ $product->category->icon }} {{ $product->category->name }}
                        </span>
                        <span>&bull;</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            {{ $product->vendor->name ?? 'Vendedor Local' }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                        {{ $product->name }}
                    </h1>

                    <!-- Price -->
                    <div class="text-4xl font-bold text-indigo-600 mb-6">
                        ${{ number_format($product->price, 2) }}
                    </div>

                    <!-- Description -->
                    <div class="prose prose-indigo text-gray-600 mb-8 flex-grow">
                        <p class="whitespace-pre-line">{{ $product->description }}</p>
                    </div>

                    <!-- Actions -->
                    <div class="mt-auto pt-6 border-t border-gray-100">
                        <a href="{{ $product->whatsapp_link }}" target="_blank" class="w-full bg-green-500 hover:bg-green-600 text-white text-lg font-bold py-4 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-3 shadow-lg hover:shadow-green-200 transform hover:-translate-y-1">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            ¡Lo quiero! Contactar por WhatsApp
                        </a>
                        <p class="text-center text-xs text-gray-400 mt-3">
                            Serás redirigido a WhatsApp para coordinar con el vendedor.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-300 py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Mercado Local. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
