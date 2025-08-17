<x-guest-layout>
    <div class="mb-4 text-sm">
        {{ __('Merci pour votre inscription! Avant de commencer, pouvez-vous vérifier votre adresse email en cliquant sur le lien qu\'on vous a envoyé par mail? Si vous n\'avez pas reçu le mail, nous vous enverrons un autre.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse mail que vous avez fourni lors de l\'inscription.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Renvoyer le mail') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Se Déconnecter') }}
            </button>
        </form>
    </div>
</x-guest-layout>
