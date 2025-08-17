@extends("admin.base")

@section("main")

<main class="p-5 overflow-y-auto">
    <a href="{{ url()->previous() }}"><span class="fa-solid fa-arrow-left text-4xl mb-3"></span></a>
    <section class="grid grid-cols-2 gap-3">
        <article class="border border-my-gray rounded-sm p-3 flex justify-between items-center">
            <p class="font-bold">Prénom & Nom</p>
            <p>{{ $client->name }}</p>
        </article>
        <article class="border border-my-gray rounded-sm p-3 flex justify-between items-center">
            <p class="font-bold">Email</p>
            <p>{{ $client->email }}</p>
        </article>
        <article class="border border-my-gray rounded-sm p-3 flex justify-between items-center">
            <p class="font-bold">Date de création de compte</p>
            <p>{{ $client->created_at }}</p>
        </article>
        <article class="border border-my-gray rounded-sm p-3 flex justify-between items-center">
            <p class="font-bold">Statut du compte</p>
            @if($client->is_active)
                <p class="text-green-500 font-bold">Actif</p>
            @else
                <p class="text-red-500 font-bold">Inactif</p>
            @endif
        </article>
    </section>
    
    <h1 class="my-5 text-3xl text-center">Commandes</h1>

    <table class="table-auto w-full">
        <thead>
            <th class="border p-2">ID</th>
            <th class="border p-2">Prix Total</th>
            <th class="border p-2">Statut</th>
            <th class="border p-2">Actions</th>
        </thead>
        <tbody>
            @if (!$commandes)
                @foreach ($commandes as $commande)
                    <tr class="text-center hover:bg-gray-100 border-b border-b-gray-200">
                        <td class="p-3">{{ $commande->id }}</td>
                        <td class="p-3">{{ $commande->prix_total }}</td>
                        <td class="p-3">
                            @if($commande->statut == "pending") 
                                <span class="bg-blue-500 p-2 rounded-full text-white text-xs font-bold">En attente</span>
                            @elseif ($commande->statut == "validated")
                                <span class="bg-green-500 p-2 rounded-full text-white text-xs font-bold">Validé</span> 
                                @elseif ($commande->statut == "cancelled")
                                <span class="bg-red-500 p-2 rounded-full text-white text-xs font-bold">Annulé</span> 
                            @endif
                        </td>
                        <td class="flex justify-center items-center gap-5 p-3">
                            <a href="{{ route('clients.show', $commande->id) }}"><span
                                    class="fa-solid fa-eye text-4xl text-amber-600"></span></a>
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