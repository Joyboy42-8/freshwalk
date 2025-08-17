@extends("admin.base")

@section("main")

<main class="p-10">
    <a href="{{ route("commandes.index") }}"><span class="fa-solid fa-arrow-left text-4xl mb-3"></span></a>
    <section class="border-gray-100 rounded-md">
        <div class="flex justify-around items-center">
            <p>Statut : 
                @if($commande->status == "pending")
                    <span class="bg-my-yellow px-2 py-1 rounded-sm">en attente</span>
                @elseif ($commande->status == "validated")
                    <span class="bg-green-400 px-2 py-1 text-white rounded-sm">validée</span>
                @elseif ($commande->status == "cancelled")
                    <span class="bg-my-red px-2 py-1 text-white rounded-sm">annulée</span>
                @endif
            </p>
            <p>Prix Total : <strong>{{ number_format($commande->prix_total, 0, ",", "") }} Fcfa</strong></p>
            <p>Adresse : <strong>{{ $commande->adresse }}</strong></p>
        </div>

        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 my-10">
            @foreach ($commande->produits as $produit)
                <article>
                    <div class="max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <a href="{{ route("produits.show", $produit->id) }}">
                            <img class="rounded-t-lg h-auto w-full max-h-52 object-cover" src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" />
                        </a>
                        <div class="p-5">
                            <a href="{{ route("produits.show", $produit->id) }}">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                    {{$produit->nom }}
                                </h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $produit->prix }} Fcfa
                            </p>
                            <a href="{{ route("produits.show", $produit->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                See Details
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        <div class="flex justify-end gap-5 my-5">
            @if($commande->status == "pending")
                <form action="{{ route("commandes.validate", $commande) }}" method="post">
                    @csrf
                    @method("PATCH")
                    <button type="submit" class="bg-green-400 text-white rounded-md px-3 py-2 block text-center cursor-pointer">
                        Validate
                    </button>
                </form>
                <form action="{{ route("commandes.cancel", $commande) }}" method="post">
                    @csrf
                    @method("PATCH")
                    <button type="submit" class="bg-red-400 text-white rounded-md px-3 py-2 block text-center cursor-pointer">
                        Cancel
                    </button>
                </form>
            @endif
        </div>
    </section> 
</main>

@endsection