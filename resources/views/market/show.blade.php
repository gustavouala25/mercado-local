<x-public-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb / Back Link -->
            <div class="mb-6">
                <a href="{{ route('market.index') }}" class="inline-flex items-center text-neu-text hover:text-orange-500 transition-colors font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Volver al Mercado
                </a>
            </div>

            <div class="bg-neu-base rounded-3xl shadow-neu-out p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Image Section -->
                    <div class="relative">
                        <div class="aspect-w-4 aspect-h-3 rounded-2xl overflow-hidden shadow-neu-in bg-neu-base">
                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/600x400?text=Sin+Foto' }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Details Section -->
                    <div class="flex flex-col justify-center">
                        <div class="mb-6">
                            <span class="inline-block px-4 py-1 rounded-full bg-neu-base shadow-neu-out text-orange-500 text-sm font-bold uppercase tracking-wider mb-4">
                                {{ $product->category->name ?? 'Producto' }}
                            </span>
                            <h1 class="text-3xl md:text-4xl font-bold text-neu-text-dark mb-4 leading-tight">{{ $product->name }}</h1>
                            <div class="text-3xl font-bold text-neu-text-dark mb-6">
                                ${{ number_format($product->price, 2) }}
                            </div>
                            <p class="text-neu-text text-lg leading-relaxed mb-8">
                                {{ $product->description }}
                            </p>
                        </div>

                        <div class="mt-auto">
                            <a href="{{ $product->whatsapp_link }}" target="_blank" class="w-full bg-neu-base text-neu-text-dark font-bold py-4 px-8 rounded-2xl shadow-neu-out hover:shadow-neu-in active:shadow-neu-pressed transition-all duration-300 flex items-center justify-center gap-3 group">
                                <svg class="w-6 h-6 text-green-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                Contactar Vendedor
                            </a>
                            <p class="text-center text-xs text-gray-400 mt-3">Se abrirá WhatsApp para contactar directamente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
