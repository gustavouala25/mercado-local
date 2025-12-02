<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-neu-text-dark">{{ __('Nombre') }}</label>
            <input id="name" class="block mt-1 w-full bg-neu-base border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-6">
            <label for="email" class="block font-medium text-sm text-neu-text-dark">{{ __('Correo Electrónico') }}</label>
            <input id="email" class="block mt-1 w-full bg-neu-base border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <label for="password" class="block font-medium text-sm text-neu-text-dark">{{ __('Contraseña') }}</label>
            <input id="password" class="block mt-1 w-full bg-neu-base border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-6">
            <label for="password_confirmation" class="block font-medium text-sm text-neu-text-dark">{{ __('Confirmar Contraseña') }}</label>
            <input id="password_confirmation" class="block mt-1 w-full bg-neu-base border-none rounded-xl shadow-neu-in text-neu-text focus:ring-0 px-4 py-3"
                            type="password"
                            name="password_confirmation"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-8">
            <a class="underline text-sm text-neu-text hover:text-orange-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <button type="submit" class="ms-4 bg-neu-base text-neu-text-dark font-bold py-2 px-6 rounded-full shadow-neu-out hover:shadow-neu-in active:shadow-neu-pressed transition-all duration-300">
                {{ __('Registrarse') }}
            </button>
        </div>
    </form>
</x-guest-layout>
