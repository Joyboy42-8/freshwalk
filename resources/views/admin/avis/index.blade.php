@extends("admin.base")

@section("main")

<main class="p-5 grow w-full">
    <div class="flex flex-row-reverse justify-between p-3 items-center">
        @if(session("success"))
            <p class="bg-green-300 p-3" id="success">{{ session("success") }}</p>
        @endif
    </div>

    <table class="table-auto w-full mb-5">
        <thead>
            <th class="border p-2">Nom du client</th>
            <th class="border p-2">Email</th>
            <th class="border p-2">Commentaire</th>
            <th class="border p-2">Note</th>
            <th class="border p-2">Date</th>
            <th class="border p-2">Actions</th>
        </thead>
        <tbody>
            @if (!@empty($avis))
                @foreach ($avis as $a)
                    <tr class="text-center hover:bg-gray-100 border-b border-b-gray-200">
                        <td class="p-3">{{ $a->user->name }}</td>
                        <td class="p-3">{{ $a->user->email }}</td>
                        <td class="p-3 italic text-gray-600">"{{ $a->avis }}"</td>
                        <td class="p-3">{{ $a->note }}</td>
                        <td class="p-3">{{ $a->created_at }}</td>
                        <td class="p-3 flex gap-3 items-center justify-center">
                            <form action="{{ route('avis.toggle', $a->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="cursor-pointer">
                                    @if($a->approuve == true) 
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
                        Aucune avis
                    </tr>
            @endif
        </tbody>
    </table>

    {{ $avis->links() }}
</main>

@endsection