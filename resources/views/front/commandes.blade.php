<x-app-layout>
    <div class="p-5 md:p-10">
        @if(session("success"))
            <p class="bg-green-200 rounded-md p-2 text-green-700 mb-2" id="success">{{ session("success") }}</p>
        @elseif(session("error"))
            <p class="bg-red-200 rounded-md p-2 text-red-700 mb-2" id="success">{{ session("error") }}</p>
        @endif

        <h1 class="text-4xl my-5 text-center font-bold">Mes Commandes</h1>

        <div class="overflow-x-auto">
            <table class="table-auto w-full mb-5">
                <thead class="border-y border-y-gray-200">
                    <th class="p-3">Adresse de Livraison</th>
                    <th class="p-3">Prix Total</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3">Date de la commande</th>
                    <th class="p-3">Actions</th>
                </thead>
                <tbody>
                    @foreach ($commandes as $commande)
                        <tr class="border-b border-b-gray-200 hover:bg-gray-300 duration-300">
                            <td class="p-2 text-center">{{ $commande->adresse }}</td>
                            <td class="p-2 text-center">{{ $commande->prix_total }}</td>
                            <td class="p-2 text-center">
                                @if($commande->status == "pending")
                                    <span class="bg-my-yellow px-2 py-1 rounded-sm">en attente</span>
                                @elseif ($commande->status == "validated")
                                    <span class="bg-green-400 px-2 py-1 rounded-sm">validée</span>
                                @elseif ($commande->status == "cancelled")
                                    <span class="bg-my-red px-2 py-1 rounded-sm">anulée</span>
                                @endif
                            </td>
                            <td class="p-2 text-center">{{ $commande->created_at }}</td>
                            <td class="p-2 text-center flex justify-center items-center gap-3">
                                <a href="{{ route("dashboard.commandes.show", $commande->id) }}"><span class="fa-solid fa-eye text-my-yellow text-xl"></span></a>
                                @if($commande->status == "validated")
                                    <a href="{{ route("avis.create", $commande->id) }}" class="bg-black text-white rounded-md p-3 text-center text-xs md:text-lg my-5 cursor-pointer mx-auto">Ajouter un avis</a>
                                @elseif($commande->status == "pending")
                                    <form action="{{ route("dashboard.commandes.cancel", $commande->id) }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="cursor-pointer">
                                            <span class="fa-solid fa-trash text-my-red text-xl"></span>
                                        </button>
                                    </form>
                                @else
                                    <p></p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $commandes->links() }}
    </div>
</x-app-layout>