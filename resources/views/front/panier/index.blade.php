<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">🛒 Mon Panier</h1>

        @if(session("success"))
            <p class="bg-green-200 rounded-md p-2 text-green-700 mb-2" id="success">{{ session("success") }}</p>
        @endif

        @if(session("error"))
            <p class="bg-red-200 rounded-md p-2 text-red-700 mb-2" id="success">{{ session("error") }}</p>
        @endif

        @if($paniers->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6">
                @foreach($paniers as $item)
                    <div class="flex items-center justify-between border-b pb-4 mb-4">
                        <!-- Image -->
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $item->produit->image) }}" 
                                alt="{{ $item->produit->nom }}" 
                                class="w-20 h-20 object-cover rounded-md shadow">

                            <div>
                                <h2 class="text-lg font-semibold">{{ $item->produit->nom }}</h2>
                                <p class="text-gray-500">{{ number_format($item->produit->prix, 0, ',', ' ') }} F</p>
                            </div>
                        </div>

                        <!-- Quantité -->
                        <form action="{{ route('dashboard.panier.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantite" value="{{ $item->quantite }}" min="1" 
                                class="w-16 border rounded px-2 py-1 text-center">
                            <button type="submit" 
                                    class="bg-black hover:bg-black text-white px-3 py-1 rounded cursor-pointer">
                                Modifier
                            </button>
                        </form>

                        <!-- Supprimer -->
                        <form action="{{ route('dashboard.panier.remove', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="border border-black-500 hover:border-black-600 text-black px-3 py-1 rounded cursor-pointer">
                                <span class="fa-solid fa-trash text-3"></span>
                            </button>
                        </form>
                    </div>
                @endforeach

                <!-- Total -->
                <div class="flex justify-end mt-6">
                    <div class="text-right">
                        <p class="text-lg font-bold">
                            Total : {{ number_format($paniers->sum(fn($i) => $i->produit->prix * $i->quantite), 0, ',', ' ') }} F
                        </p>
                        <form action="{{ route('dashboard.commandes.store') }}" method="POST" class="mt-4">
                            @csrf
                            <label for="adresse" class="block font-semibold mb-2">Adresse de livraison :</label>
                            <textarea name="adresse" id="adresse" rows="3" required
                                class="w-full border rounded px-3 py-2">{{ old('adresse') }}</textarea>
                        
                            <button type="submit"
                            class="mt-3 cursor-pointer inline-block bg-my-red hover:bg-my-red text-white px-5 py-2 rounded">
                                Valider la commande
                            </button>
                        </form>                        
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Your cart is empty 😔</p>
                <a href="{{ route('dashboard.produits') }}" 
                   class="mt-4 inline-block bg-black hover:bg-black text-white px-4 py-2 rounded">
                    See all products
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
