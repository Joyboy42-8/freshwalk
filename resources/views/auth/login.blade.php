<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="w-full flex flex-col md:flex-row md:h-screen text-xl">
        <img src="{{ asset("images/sneakers-5979353_1280.jpg") }}" class="block md:w-5/12" alt="Shoes">

        <form method="POST" action="{{ route('login') }}" class="p-10 flex flex-col justify-center grow">
            @csrf
            <h1 class="text-center text-6xl mb-3">CONNEXION</h1>
    
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="bg-red-200 text-red-500 rounded-md p-3 mb-2" id="error">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full rounded-lg p-3 border border-gray-300 focus:border-[#FFD60A] focus:ring-[#FFD60A]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block w-full rounded-lg p-3 border border-gray-300 focus:border-[#FFD60A] focus:ring-[#FFD60A]"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-[#FFD60A] text-[#FFD60A] shadow-sm focus:ring-[#FFD60A]" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route("register") }}" class="hover:underline text-sm text-gray-600 hover:text-[#FFD60A] rounded-md focus:outline-none mr-5">S'inscrire</a>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-[#FFD60A] rounded-md focus:outline-none" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié?') }}
                    </a>
                @endif
    
                <x-primary-button class="ms-3 bg-[#FFD60A] text-black">
                    {{ __('Se Connecter') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
