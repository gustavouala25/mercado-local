<footer class="bg-neu-base text-neu-text py-8 mt-12 shadow-neu-out rounded-t-3xl">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p class="font-semibold">&copy; {{ date('Y') }} Mercado Palosanteño.</p>
        </div>
        <div class="flex space-x-6 text-sm font-medium">
            <a href="{{ route('pages.terms') }}" class="hover:text-orange-500 transition-colors">Términos</a>
            <a href="{{ route('pages.privacy') }}" class="hover:text-orange-500 transition-colors">Privacidad</a>
        </div>
    </div>
</footer>
