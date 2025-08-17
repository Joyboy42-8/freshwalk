<x-app-layout>

    <div class="p-10">
        <section class="w-full p-5 flex items-center">
            <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" class="w-1/2 h-auto rounded-md">
            <article class="flex flex-col gap-5 grow p-10 text-2xl">
                <h1 class="text-7xl text-center font-extrabold">{{ $produit->nom }}</h1>
                <h1 class="text-3xl text-my-red text-center font-extrabold">{{ $produit->prix }} FCFA</h1>
                <span class="underline">Description : </span>
                <p class="text-2xl italic text-slate-500"> {{ $produit->description }}</p>
                <div class="flex justify-between items-center">
                    <p class="grow self-baseline">Stock: <strong>{{ $produit->stock }}</strong></p>
                    <form action="{{ route("dashboard.panier.add", $produit->id) }}" class="max-w-xs mx-auto" method="POST">
                        @csrf
                        <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-90">Choose quantity:</label>
                        <div class="relative flex items-center max-w-[8rem]">
                            <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-my-yellow-300 rounded-s-lg p-3 h-11 focus:ring-my-yellow-100 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            <input type="text" name="quantite" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-my-yellow-500 focus:border-my-yellow-500 block w-full py-2.5 dark:focus:ring-my-yellow-500 dark:focus:border-my-yellow-500" placeholder="999" required />
                            <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                        </div>
                        <button type="submit" class="bg-my-red text-white rounded-md p-3 text-lg block w-full my-5 cursor-pointer mx-auto">Add to cart</button>
                    </form>
                </div>            
            </article>
        </section>

        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 my-8">
            @if($produit->avis->isEmpty())
                    <p class="text-center text-gray-600 text-2xl italic">Aucun avis</p>
            @else
                @foreach ($produit->avis as $avis)
                    <article class="p-5 bg-white rounded-xl shadow-md border border-gray-200 flex flex-col gap-3 hover:shadow-lg transition-shadow duration-200">
                        <div class="flex items-center gap-1 text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $i <= $avis->note ? 'fill-current' : 'fill-gray-300' }}" viewBox="0 0 24 24">
                                    <path d="M12 .587l3.668 7.431L24 9.748l-6 5.845 1.416 8.264L12 19.771l-7.416 4.086L6 15.593 0 9.748l8.332-1.73z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-lg font-semibold text-gray-800">{{ $avis->user->name }}</p>
                        <p class="text-gray-600 italic">"{{ $avis->avis }}"</p>
                    </article>
                @endforeach
            @endif
        </section>
    </div>

</x-app-layout>