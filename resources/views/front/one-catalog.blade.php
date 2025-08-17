<x-app-layout>

    <h1 class="my-5 text-4xl font-bold text-center">Catégorie <span>{{ $categorie->nom }}</span></h1>

    <div class="p-5">
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 my-5 p-5">
            @foreach ($produits as $produit)
            <div class="max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow-sm">
                <a href="{{ route("dashboard.one-produit", $produit->id) }}">
                    <img class="rounded-t-lg h-auto w-full max-h-52 object-cover" src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" />
                </a>
                <div class="p-5">
                    <a href="{{ route("dashboard.one-produit", $produit->id) }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            {{$produit->nom }}
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ $produit->prix }} Fcfa
                    </p>
                    <a href="{{ route("dashboard.one-produit", $produit->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Add to cart
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </section>
    
        {{ $produits->links() }}
    </div>

</x-app-layout>