<x-app-layout>
    <section class="p-10">
        <a href="{{ route('dashboard.commandes.all') }}">
            <span class="fa-solid fa-arrow-left text-4xl mb-3"></span>
        </a>

        {{-- Produits déjà avisés --}}
        <h1 class="text-3xl mb-3">Produits déjà évalués</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
            @foreach ($produitsAvises as $produit)
                <article class="border rounded-md flex flex-col">
                    <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-72 object-cover rounded-t-md">
                    <div class="text-center p-3">
                        <h2 class="text-2xl">{{ $produit->nom }}</h2>
                        <p class="italic text-gray-600">"{{ $produit->avis->first()->avis }}"</p>
                        <p>Note : {{ $produit->avis->first()->note }}/5</p>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Produits restants --}}
        <h1 class="text-3xl mt-10 mb-3">Produits à évaluer</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
            @foreach ($produitsRestants as $produit)
                <form action="{{ route('avis.store', ["commande" => $commande->id, "produit" => $produit->id]) }}" method="POST" class="flex items-center gap-5 w-full border border-gray-300 rounded-lg p-5">
                    @csrf
                    <div class="flex flex-col">
                        <h2 class="text-center text-2xl">{{ $produit->nom }}</h2>
                        <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" class="w-72 h-auto">
                    </div>
                    <div class="flex flex-col w-full">
                        <div class="mb-3">
                            <label for="avis" class="font-bold mb-2">Avis</label>
                            <textarea name="avis" class="block w-full border border-gray-200 font-roboto focus:border-black focus:outline focus:outline-black p-2 rounded-md"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="font-bold mb-2">Note</label>
                            <input type="range" min="1" max="5" name="note" class="block w-full accent-black p-2 rounded-md">
                        </div>
                        <button type="submit" class="bg-black text-white px-3 py-2 rounded-md">Envoyer</button>
                    </div>
                </form>
            @endforeach
        </div>
    </section>
</x-app-layout>
