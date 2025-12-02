<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-medium text-sm text-neu-text-dark">{{ __('Correo Electrónico') }}</label>
            <input id="email" class="block mt-1 w-full bg-neu-base border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <label for="password" class="block font-medium text-sm text-neu-text-dark">{{ __('Contraseña') }}</label>

            <input id="password" class="block mt-1 w-full bg-neu-base border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-neu-base border-none shadow-neu-in text-orange-500 focus:ring-0" name="remember">
                <span class="ms-2 text-sm text-neu-text">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-8">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-neu-text hover:text-orange-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif

            <button type="submit" class="ms-4 bg-neu-base text-neu-text-dark font-bold py-2 px-6 rounded-full shadow-neu-out hover:shadow-neu-in active:shadow-neu-pressed transition-all duration-300">
                {{ __('Iniciar Sesión') }}
            </button>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="font-bold text-orange-600 hover:text-orange-500 hover:underline">
                    Regístrate aquí
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
