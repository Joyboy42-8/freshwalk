@extends("admin.base")

@section("main")

<main class="p-10">
    <a href="{{ url()->previous() }}"><span class="fa-solid fa-arrow-left text-4xl mb-3"></span></a>
    <section class="flex items-center justify-between border p-3">
        <aside class="p-3 grow flex flex-col gap-5 justify-start items-start">
            <div class="flex flex-col gap-2">
                <h1 class="text-5xl ">{{ $produit->nom }} <span class="text-sm  text-slate-400">({{ $produit->slug }})</span></h1>
                <p class="text-md">{{ $produit->description }}</p>
                <p class="font-bold">{{ $produit->prix }} FCFA</p>
            </div>
            <div class="flex gap-2">
                @if ($produit->is_active && $produit->stock > 0)
                    <span class="text-green-400 text-xl" title="Disponible">Disponible</span>
                @else
                    <span class="text-red-400 text-xl" title="Disponible">Pas Disponible</span>
                @endif
                <p>Stock : 
                    @if($produit->stock == 0)
                        <span class="text-red-300 font-bold">{{ $produit->stock }}</span>
                    @else
                        <span class="text-green-300 font-bold">{{ $produit->stock }}</span>
                    @endif
                </p>
            </div>
            <p>Catégorie : <b>{{ $produit->categorie->nom }}</b></p>
        </aside>
        <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" class="w-96 h-auto rounded-md object-contain">
    </section>
</main>

@endsection