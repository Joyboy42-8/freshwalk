@extends("admin.base")

@section("main")

<main class="p-5 overflow-y-auto">
    <div class="flex flex-row-reverse justify-between p-3 items-center">
        @if(session("success"))
            <p class="bg-green-300 p-3" id="success">{{ session("success") }}</p>
        @endif
    </div>

    <table class="table-auto w-full">
        <thead>
            <th class="border p-2">Nom</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Etat</th>
            <th class="border p-2">Actions</th>
        </thead>
        <tbody>
            @if (!@empty($clients))
                @foreach ($clients as $client)
                    <tr class="text-center hover:bg-gray-100 border-b border-b-gray-200">
                        <td class="p-3">{{ $client->name }}</td>
                        <td class="p-3">{{ $client->email }}</td>
                        <td class="p-3">
                            @if($client->is_active) 
                                <span class="bg-green-500 p-2 rounded-full text-white text-xs font-bold">Actif</span>
                            @else 
                                <span class="bg-red-500 p-2 rounded-full text-white text-xs font-bold">Inactif</span> 
                            @endif
                        </td>
                        <td class="flex justify-center items-center gap-5 p-3">
                            <a href="{{ route('clients.show', $client->id) }}"><span
                                    class="fa-solid fa-eye text-xl text-amber-600"></span></a>
                            <form action="{{ route('clients.toggle', $client->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">
                                    @if($client->is_active) 
                                        <span class="fa-solid fa-toggle-on text-green-400 text-xl"></span>
                                    @else
                                        <span class="fa-solid fa-toggle-off text-red-400 text-xl"></span>
                                    @endif
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                    <tr>
                        Aucun Client
                    </tr>
            @endif
        </tbody>
    </table>
</main>

@endsection