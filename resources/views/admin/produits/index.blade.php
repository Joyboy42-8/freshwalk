@extends('admin.base')

@section('main')

    <main class="p-5">
        <div class="flex flex-row-reverse justify-between p-3 items-center">
            <a href="{{ route('produits.create') }}"
            class="bg-black text-white p-3 rounded-md shadow block w-1/6 text-center mb-5">Ajouter</a>
            @if(session("success"))
                <p class="bg-green-300 p-3" id="success">{{ session("success") }}</p>
            @endif
        </div>

        <table class="table-auto w-full mb-3">
            <thead>
                <th class="border p-2">Image</th>
                <th class="border p-2">Nom</th>
                <th class="border p-2">Prix</th>
                <th class="border p-2">Quantité en stock</th>
                <th class="border p-2">Actions</th>
            </thead>
            <tbody>
                @if (!@empty($produits))
                    @foreach ($produits as $produit)
                        <tr class="text-center hover:bg-gray-100 border-b border-b-gray-200">
                            <td class="p-3"><img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" class="size-20 rounded-md block mx-auto object-cover"></td>
                            <td class="p-3">{{ $produit->nom }}</td>
                            <td class="p-3">{{ $produit->prix }}</td>
                            <td class="p-3">{{ $produit->stock }}</td>
                            <td class="p-3">
                                <div class="flex justify-center items-center gap-5">
                                    <a href="{{ route('produits.show', $produit->id) }}">
                                        <span class="fa-solid fa-eye text-xl text-amber-600"></span>
                                    </a>
                                    <a href="{{ route('produits.edit', $produit->id) }}">
                                        <span class="fa-solid fa-pen-to-square text-xl text-green-500"></span>
                                    </a>
                                    <form action="{{ route('produits.destroy', $produit->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><span class="fa-solid fa-trash text-xl text-red-500"></span></button>
                                    </form>
                                    <form action="{{ route('produits.toggle', $produit->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit">
                                            @if($produit->is_active) 
                                                <span class="fa-solid fa-toggle-on text-green-400 text-xl" title="Disponible"></span>
                                            @else
                                                <span class="fa-solid fa-toggle-off text-red-400 text-xl" title="Pas Disponible"></span>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                        <tr>
                            Aucune catégorie
                        </tr>
                @endif
            </tbody>
        </table>
        {{ $produits->links() }}
    </main>

@endsection
