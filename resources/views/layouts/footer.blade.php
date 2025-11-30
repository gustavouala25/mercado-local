<footer class="bg-gray-900 text-white py-8 mt-auto">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
            <p>&copy; {{ date('Y') }} Mercado Local. Todos los derechos reservados.</p>
        </div>
        <div class="flex space-x-6 text-sm">
            <a href="{{ route('pages.terms') }}" class="hover:text-indigo-400 transition-colors">Términos y Condiciones</a>
            <a href="{{ route('pages.privacy') }}" class="hover:text-indigo-400 transition-colors">Política de Privacidad</a>
        </div>
    </div>
</footer>
