<x-public-layout>
    @section('meta')
        <meta property="og:title" content="{{ $vendor->name }} - Mercado Palosanteño" />
        <meta property="og:description" content="Visita la tienda de {{ $vendor->name }} y descubre sus productos." />
        <meta property="og:image" content="{{ $vendor->logo ? asset('storage/' . $vendor->logo) : 'https://ui-avatars.com/api/?name=' . urlencode($vendor->name) . '&color=7F9CF5&background=EBF4FF' }}" />
    @endsection

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-orange-100 to-pink-100 rounded-3xl p-8 mb-12 text-center shadow-neu-out overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-30 pointer-events-none">
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 flex flex-col items-center">
            <!-- Vendor Logo -->
            <div class="w-32 h-32 rounded-full bg-white shadow-neu-out p-1 mb-6 flex items-center justify-center overflow-hidden">
                @if($vendor->logo)
                    <img src="{{ asset('storage/' . $vendor->logo) }}" alt="{{ $vendor->name }}" class="w-full h-full object-cover rounded-full">
                @else
                    <span class="text-4xl font-bold text-orange-500">{{ substr($vendor->name, 0, 1) }}</span>
                @endif
            </div>

            <!-- Vendor Name -->
            <h1 class="text-3xl md:text-5xl font-bold text-neu-text-dark mb-2">{{ $vendor->name }}</h1>

            <!-- Location -->
            <div class="flex items-center text-neu-text mb-6">
                <svg class="w-5 h-5 mr-1 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span>{{ $vendor->location ?? 'Ubicación no disponible' }}</span>
            </div>

            <!-- WhatsApp Button -->
            @if($vendor->whatsapp_number)
                @php
                    $message = urlencode("Hola, quiero consultar por sus productos");
                    $whatsappUrl = "https://wa.me/{$vendor->whatsapp_number}?text={$message}";
                @endphp
                <a href="{{ $whatsappUrl }}" target="_blank" class="inline-flex items-center bg-green-500 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    Contactar por WhatsApp
                </a>
            @endif
        </div>
    </div>

    <!-- Products Grid -->
    <h2 class="text-2xl font-bold text-neu-text-dark mb-6">Productos Disponibles</h2>

    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 mb-12">
            @foreach($products as $product)
                <div class="bg-neu-base rounded-2xl shadow-neu-out p-3 md:p-4 flex flex-col h-full transform transition-transform duration-300 hover:-translate-y-1">
                    <!-- Image -->
                    <div class="relative aspect-square mb-3 md:mb-4 rounded-xl overflow-hidden shadow-neu-in">
                        <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/600x400?text=Sin+Foto' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Content -->
                    <div class="flex-grow flex flex-col">
                        <p class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wide mb-1">{{ $product->category->name ?? 'Varios' }}</p>
                        <h3 class="text-sm md:text-lg font-bold text-neu-text-dark leading-tight line-clamp-2 mb-2">
                            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-orange-500 transition-colors">
                                {{ $product->name }}
                            </a>
                        </h3>
                        
                        <div class="mt-auto pt-2 flex items-center justify-between">
                            <span class="text-base md:text-xl font-bold text-neu-text-dark">${{ number_format($product->price, 2) }}</span>
                            <a href="{{ route('products.show', $product->slug) }}" class="w-8 h-8 md:w-10 md:h-10 bg-neu-base rounded-full shadow-neu-out flex items-center justify-center text-orange-500 hover:text-orange-600 active:shadow-neu-pressed transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mb-12">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-neu-base rounded-3xl shadow-neu-in">
            <div class="inline-block p-6 rounded-full bg-neu-base shadow-neu-out mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
            </div>
            <p class="text-neu-text text-lg font-medium">Este vendedor aún no ha publicado productos.</p>
        </div>
    @endif
</x-public-layout>
