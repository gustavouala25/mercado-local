<div class="fixed bottom-0 w-full bg-white/90 backdrop-blur-md shadow-[0_-2px_10px_rgba(0,0,0,0.1)] flex md:hidden justify-around py-3 z-50 rounded-t-2xl border-t border-gray-100 pb-safe">
    <!-- Inicio -->
    <a href="{{ route('market.index') }}" class="flex flex-col items-center {{ request()->routeIs('market.index') && !request()->has('focus') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }} transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-xs mt-1">Inicio</span>
    </a>

    <!-- Buscar -->
    <a href="{{ request()->routeIs('market.index') ? '#' : route('market.index', ['focus' => 'search']) }}" 
       @if(request()->routeIs('market.index')) @click.prevent="window.scrollTo({top: 0, behavior: 'smooth'}); document.querySelector('input[name=search]')?.focus()" @endif
       class="flex flex-col items-center {{ request()->has('focus') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }} transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <span class="text-xs mt-1">Buscar</span>
    </a>

    <!-- Vender -->
    <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="flex flex-col items-center {{ request()->routeIs('dashboard') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }} transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>
        <span class="text-xs mt-1">Vender</span>
    </a>

    <!-- Perfil -->
    <a href="{{ auth()->check() ? route('profile.edit') : route('login') }}" class="flex flex-col items-center {{ request()->routeIs('profile.edit') ? 'text-orange-500' : 'text-gray-500 hover:text-orange-500' }} transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span class="text-xs mt-1">Perfil</span>
    </a>
</div>
