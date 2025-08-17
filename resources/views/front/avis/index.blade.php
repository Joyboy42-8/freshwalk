<x-app-layout>

    <div class="p-10">
        @if(session("success"))
            <p class="bg-green-200 rounded-md p-2 text-green-700 mb-2" id="success">{{ session("success") }}</p>
        @endif
        @if(session("error"))
            <p class="bg-green-200 rounded-md p-2 text-green-700 mb-2" id="success">{{ session("error") }}</p>
        @endif
        <h1 class="my-3 text-2xl font-bold">Mes Avis</h1>
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
            @foreach ($avis as $a)
                <article class="p-5 bg-white rounded-xl shadow-md border border-gray-200 flex flex-col gap-3 hover:shadow-lg transition-shadow duration-200">
                    <!-- Nom du produit -->
                    <h2 class="text-lg font-semibold text-gray-800">{{ $a->produit->nom }}</h2>
                
                    <!-- Avis -->
                    <p class="text-gray-600 italic">"{{ $a->avis }}"</p>
                
                    <!-- Note en étoiles -->
                    <div class="flex items-center gap-1 text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 {{ $i <= $a->note ? 'fill-current' : 'fill-gray-300' }}" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.431L24 9.748l-6 5.845 1.416 8.264L12 19.771l-7.416 4.086L6 15.593 0 9.748l8.332-1.73z"/>
                            </svg>
                        @endfor
                    </div>
                
                    <!-- Statut -->
                    <div>
                        @if($a->approuve)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">✔ Approuvé</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium">✖ Non approuvé</span>
                        @endif
                    </div>
                
                    <!-- Date -->
                    <p class="text-xs text-gray-400">Publié le {{ $a->created_at->format('d/m/Y') }}</p>
                </article>
            @endforeach
        </section>

    </div>

</x-app-layout>