<x-guest-layout>
    <div class="w-full h-screen flex flex-col gap-5 justify-center items-center">
        <div class="mb-4 text-lg w-96 text-justify">
            {{ __('Vous avez oublié votre mot de passe? Pas de problème. Renseignez juste votre adresse email et nous vous enverrons un mail de réinitialisation de mot de passe qui vous permettra de choisir un nouveau mot de passe.') }}
        </div>
    
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
    
        <form method="POST" action="{{ route('password.email') }}" class="w-96">
            @csrf
    
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Recevoir le lien') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
