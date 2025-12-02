<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-md overflow-hidden shadow-neu-out sm:rounded-3xl border border-white/20">
                <div class="p-8 text-neu-text">
                    @if(!$hasVendor)
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-neu-text-dark mb-4">¡Bienvenido!</h3>
                            <p class="mb-8 text-lg">Para comenzar a vender tus productos, necesitas crear tu perfil de vendedor.</p>
                            
                            <form action="{{ route('vendor.store') }}" method="POST" class="max-w-md mx-auto bg-white/50 backdrop-blur-sm p-8 rounded-3xl shadow-neu-out border border-white/20">
                                @csrf
                                <div class="mb-6">
                                    <label for="name" class="block font-medium text-sm text-neu-text-dark mb-2">Nombre de tu Negocio</label>
                                    <input type="text" name="name" id="name" class="w-full bg-white/50 border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3" required>
                                </div>
                                <div class="mb-6">
                                    <label for="whatsapp_number" class="block font-medium text-sm text-neu-text-dark mb-2">Número de WhatsApp</label>
                                    <input type="text" name="whatsapp_number" id="whatsapp_number" class="w-full bg-white/50 border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3" required>
                                </div>
                                <div class="mb-8">
                                    <label for="location" class="block font-medium text-sm text-neu-text-dark mb-2">Ubicación</label>
                                    <input type="text" name="location" id="location" class="w-full bg-white/50 border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3" required>
                                </div>
                                <button type="submit" class="w-full bg-gradient-to-r from-orange-400 to-red-500 text-white font-bold py-3 px-6 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                    Crear Vendedor
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                            <div>
                                <h2 class="text-2xl md:text-3xl font-bold text-neu-text-dark">Panel de Vendedor</h2>
                                <p class="text-sm md:text-base text-neu-text mt-1">Gestiona tus productos y ventas</p>
                            </div>
                            <div class="flex gap-4">
                                <!-- Desktop New Product Button -->
                                <a href="{{ route('vendor.products.create') }}" class="hidden md:flex bg-gradient-to-r from-orange-400 to-red-500 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Nuevo Producto
                                </a>

                                <!-- Mobile FAB New Product Button -->
                                <a href="{{ route('vendor.products.create') }}" class="md:hidden fixed bottom-20 right-4 z-50 w-14 h-14 bg-orange-500 rounded-full shadow-lg flex items-center justify-center text-white hover:bg-orange-600 transition-colors shadow-neu-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        @if($products->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6 pb-20">
                                @foreach($products as $product)
                                    <div class="bg-neu-base rounded-2xl shadow-neu-out p-3 group relative">
                                        <!-- Product Image -->
                                        <div class="aspect-square w-full overflow-hidden rounded-xl bg-gray-200 shadow-neu-in mb-2 relative">
                                            <img src="{{ $product->image_path ? asset('storage/' . $product->image_path) : 'https://placehold.co/600x400?text=Sin+Foto' }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity">
                                            
                                            <!-- Overlay Actions (Desktop) -->
                                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2 hidden md:flex">
                                                <a href="{{ route('vendor.products.edit', $product) }}" class="p-2 bg-white rounded-full text-gray-900 hover:text-orange-500 transition-colors" title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('vendor.products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-white rounded-full text-red-600 hover:text-red-700 transition-colors" title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Mobile Actions -->
                                        <div class="flex md:hidden justify-end gap-2 mb-1 absolute top-2 right-2 z-10">
                                            <a href="{{ route('vendor.products.edit', $product) }}" class="p-1.5 bg-white/90 backdrop-blur-sm rounded-full text-gray-900 shadow-sm">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                        </div>

                                        <h3 class="text-xs md:text-lg font-bold text-neu-text-dark line-clamp-1">{{ $product->name }}</h3>
                                        <p class="mt-0.5 text-sm md:text-xl font-bold text-neu-text">${{ number_format($product->price, 2) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-20 bg-white/50 backdrop-blur-sm rounded-3xl shadow-neu-in border border-white/20">
                                <div class="inline-block p-6 rounded-full bg-white shadow-neu-out mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                </div>
                                <p class="text-neu-text text-lg font-medium">Aún no has publicado productos.</p>
                                <p class="text-gray-400 text-sm mt-2">¡Es hora de llenar tu tienda!</p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```
