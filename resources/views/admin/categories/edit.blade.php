@extends("admin.base")

@section("main")

<main class="flex justify-center items-center p-10">
    <form action="{{ route("categories.update", $categorie->id) }}" method="POST" class="flex flex-col gap-5 w-96 border border-gray-300 rounded-lg p-5">
        @csrf
        @method("PUT")

        <div>
            <label for="nom" class="font-bold mb-2">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="Ex: Sport" class="block w-full border border-gray-200 focus:border-black focus:outline focus:outline-gray-300 p-2 rounded-md" value="{{ old("slug", $categorie->nom) }}">
        </div>
        <div>
            <label for="slug" class="font-bold mb-2">Slug</label>
            <input type="text" name="slug" id="slug" placeholder="Ex: sport-foot" class="block w-full border focus:border-black border-gray-200 focus:outline focus:outline-gray-300 p-2 rounded-md" value="{{ old("slug", $categorie->slug) }}">
        </div>
        <button type="submit" class="block bg-black text-white border border-gray-200 p-2 rounded-md w-1/3 mx-auto">Modifier</button>
    </form>
</main>

@endsection