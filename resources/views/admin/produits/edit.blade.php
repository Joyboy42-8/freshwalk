@extends("admin.base")

@section("main")

<main class="flex justify-center items-center p-10 overflow-y-auto">
    @if ($errors->any())
        <ul class="w-full">
            @foreach ($errors->all() as $error)
                <li class="bg-red-300 text-red-600 p-3 rounded-md">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route("produits.update", $produit->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-5 w-full border border-gray-300 rounded-lg p-5">
        @csrf
        @method("PUT")

        <div>
            <label for="nom" class="font-bold mb-2">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="Ex: Sneaker Dior" class="block w-full border border-gray-200 focus:border-black focus:outline focus:outline-gray-300 p-2 rounded-md" value="{{ old("nom", $produit->nom) }}">
        </div>
        <div>
            <label for="slug" class="font-bold mb-2">Slug</label>
            <input type="text" name="slug" id="slug" placeholder="Ex: sneaker-nike-homme" class="block w-full border focus:border-black border-gray-200 focus:outline focus:outline-gray-300 p-2 rounded-md" value="{{ old("slug", $produit->slug) }}">
        </div>
        <div>
            <label for="categories" class="font-bold mb-2">Catégorie</label>
            <select type="text" name="categorie_id" id="categories" class="block w-full border focus:border-black border-gray-200 focus:outline focus:outline-gray-300 p-2 rounded-md">
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="image" class="font-bold mb-2">Image</label>
            <input type="file" name="image" id="image" class="block w-full border focus:border-black border-gray-200 focus:outline focus:outline-gray-300 p-2 rounded-md"  value="{{ old("image", $produit->image) }}">
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="prix" class="font-bold mb-2">Prix</label>
            <input type="number" name="prix" id="prix" class="block w-full border focus:border-black border-gray-200 focus:outline focus:outline-gray-300 p-2 rounded-md"  value="{{ old("prix", $produit->prix) }}">
        </div>
        <div>
            <label for="stock" class="font-bold mb-2">Stock</label>
            <input type="number" name="stock" id="stock" class="block w-full border focus:border-black border-gray-200 focus:outline focus:outline-gray-300 p-2 rounded-md"  value="{{ old("stock", $produit->stock) }}">
        </div>
        <div>
            <label for="description" class="font-bold mb-2">Description</label>
            <textarea name="description" id="description" class="block w-full border focus:border-black border-gray-200 focus:outline focus:outline-gray-300 p-2 rounded-md" value="{{ old("description", $produit->description) }}"></textarea>
        </div>
        <button type="submit" class="block bg-black text-white border border-gray-200 p-2 rounded-md w-1/3 h-12 self-end mx-auto">Modifier</button>
    </form>
</main>

@endsection