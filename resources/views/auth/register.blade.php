<x-guest-layout>
    <div class="w-full flex flex-col-reverse md:flex-row md:h-screen text-xl">
        <form method="POST" action="{{ route('register') }}" class="p-10 flex flex-col justify-center grow">
            @csrf
            <h1 class="text-center text-6xl mb-3">INSCRIPTION</h1>
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Prénon & Nom')" />
                <x-text-input id="name" class="block w-full rounded-lg p-3 border border-gray-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ex: Joe Sneaker" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block w-full rounded-lg p-3 border border-gray-300" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Ex: sneaker@gmail.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
    
                <x-text-input id="password" class="block w-full rounded-lg p-3 border border-gray-300"
                                type="password"
                                name="password"
                                required autocomplete="new-password" placeholder="Ex: debzaerezarzeke@f656"/>
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
                <x-text-input id="password_confirmation" class="block w-full rounded-lg p-3 border border-gray-300"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="Ex: debzaerezarzeke@f656" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <a class="hover:underline text-sm text-gray-900 hover:text-[#E63946] rounded-md focus:outline-none" href="{{ route('login') }}">
                    {{ __('Deja inscrit?') }}
                </a>
    
                <x-primary-button class="ms-4">
                    {{ __('S\'inscrire') }}
                </x-primary-button>
            </div>
        </form>
        <img src="{{ asset("images/pexels-melvin-buezo-1253763-2529157.jpg") }}" class="block md:w-5/12" alt="Shoes">
    </div>
</x-guest-layout>
