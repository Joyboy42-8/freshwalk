@extends("admin.base")

@section("main")

<main class="p-10">
    <div class="flex flex-row-reverse justify-between p-3 items-center">
        @if(session("success"))
            <p class="bg-green-300 p-3" id="success">{{ session("success") }}</p>
        @endif
    </div>

    <table class="table-auto w-full mb-5">
        <thead>
            <th class="border p-2">Nom</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Adresse</th>
            <th class="border p-2">Prix Total</th>
            <th class="border p-2">Statut</th>
            <th class="border p-2">Actions</th>
        </thead>
        <tbody>
            @if (!@empty($commandes))
                @foreach ($commandes as $commande)
                    <tr class="text-center hover:bg-gray-100 border-b border-b-gray-200">
                        <td class="p-3">{{ $commande->user->name }}</td>
                        <td class="p-3">{{ $commande->user->email }}</td>
                        <td class="p-3">{{ $commande->adresse }}</td>
                        <td class="p-3">{{ $commande->prix_total }}</td>
                        <td class="p-3">
                            @if($commande->status == "pending")
                                <span class="bg-my-yellow px-2 py-1 rounded-sm">en attente</span>
                            @elseif ($commande->status == "validated")
                                <span class="bg-green-400 px-2 py-1 text-white rounded-sm">validée</span>
                            @elseif ($commande->status == "cancelled")
                                <span class="bg-my-red px-2 py-1 text-white rounded-sm">annulée</span>
                            @endif
                        </td>
                        <td class="p-3 flex gap-3 items-center justify-center">
                            <a href="{{ route('commandes.show', $commande->id) }}"  class="bg-blue-400 rounded-md p-2 text-center">
                                <span class="fa-solid fa-eye text-xl text-white"></span>
                            </a>
                                @if($commande->status == "pending")
                                    <form action="{{ route('commandes.validate', $commande->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="bg-green-400 text-white rounded-md px-3 py-2 text-center cursor-pointer">
                                            <span class="fa-solid fa-check text-xl text-white"></span>
                                        </button>
                                    </form>
                                    <form action="{{ route('commandes.cancel', $commande->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="bg-red-400 text-white rounded-md px-3 py-2 text-center cursor-pointer">
                                            <span class="fa-solid fa-ban text-xl text-white"></span>
                                        </button>
                                    </form>
                                @endif
                        </td>
                    </tr>
                @endforeach
            @else
                    <tr>
                        Aucune Commande
                    </tr>
            @endif
        </tbody>
    </table>

    {{ $commandes->links() }}
</main>

@endsection