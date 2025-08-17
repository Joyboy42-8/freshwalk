@extends('admin.base')

@section('main')

    <main class="p-5 overflow-y-auto">
        <div class="flex flex-row-reverse justify-between p-3 items-center">
            <a href="{{ route('categories.create') }}"
            class="bg-black text-white p-3 rounded-md shadow block w-1/6 text-center mb-5">Ajouter</a>
            @if(session("success"))
                <p class="bg-green-300 p-3" id="success">{{ session("success") }}</p>
            @endif
        </div>

        <table class="table-auto w-full mb-3">
            <thead>
                <th class="border p-2">Nom</th>
                <th class="border p-2">Slug</th>
                <th class="border p-2">Date de création</th>
                <th class="border p-2">Actions</th>
            </thead>
            <tbody>
                @if (!@empty($categories))
                    @foreach ($categories as $categorie)
                        <tr class="text-center hover:bg-gray-100 border-b border-b-gray-200">
                            <td class="p-3">{{ $categorie->nom }}</td>
                            <td class="p-3">{{ $categorie->slug }}</td>
                            <td class="p-3">{{ $categorie->created_at }}</td>
                            <td class="flex justify-center items-center gap-5 p-3">
                                <a href="{{ route('categories.show', $categorie->id) }}"><span
                                        class="fa-solid fa-eye text-xl text-amber-600"></span></a>
                                <a href="{{ route('categories.edit', $categorie->id) }}"><span
                                        class="fa-solid fa-pen-to-square text-xl text-green-500"></span></a>
                                <form action="{{ route('categories.destroy', $categorie->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><span class="fa-solid fa-trash text-xl text-red-500"></span></button>
                                </form>
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

        {{ $categories->links() }}
    </main>

@endsection
