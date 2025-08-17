@extends('admin.base')

@section('main')

<main class="p-10">
    <a href="{{ url()->previous() }}">
        <span class="fa-solid fa-arrow-left text-4xl mb-3"></span>
    </a>

    <h1 class="text-2xl font-bold mb-3 text-center">Catégorie : {{ $categorie->nom }}</h1>
    <p class="mb-5 text-center">Slug : {{ $categorie->slug }}</p>

    @if($produits->isEmpty())
        <p>Aucun produit dans cette catégorie.</p>
    @else
        <ul>
            @foreach($produits as $produit)
            <li class="flex justify-around items-center gap-5 border-y hover:bg-gray-100 duration-300 px-5 py-2">
                <p>Nom : {{ $produit->nom }}</p>
                <p>Prix : {{ $produit->prix }}</p>
                <p>Stock : {{ $produit->stock }}</p>
                @if($produit->image)
                    <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" class="w-20 h-20 object-cover rounded-md">
                @endif
                <a href="{{ route('produits.show', $produit->id) }}">
                    <span class="fa-solid fa-eye text-xl text-amber-600"></span>
                </a>
            </li>
            @endforeach
        </ul>
    @endif

    {{ $produits->links() }}
</main>

@endsection
