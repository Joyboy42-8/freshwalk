@extends("admin.base")

@section("main")

    <main class="p-5 grow w-full">
        <section class="flex justify-around items-center gap-5">
            <article class="flex justify-between items-center shadow bg-my-white p-5 w-full">
                <p>Clients</p>
                <p class="self-end text-3xl font-bold">{{ $nbClients }}</p>
            </article>
            <article class="flex justify-between items-center shadow bg-my-white p-5 w-full">
                <p>Produits</p>
                <p class="self-end text-3xl font-bold">{{ $nbProduits }}</p>
            </article>
            <article class="flex justify-between items-center shadow bg-my-white p-5 w-full">
                <p>Catégories</p>
                <p class="self-end text-3xl font-bold">{{ $nbCategories }}</p>
            </article>
        </section>

        <h2 class="my-5 text-3xl text-center font-bold">Historiques</h2>

        <section class="overflow-x-auto">
            {{-- <livewire:historique-table" /> --}}
            @livewire("historique-table")
        </section>
    </main>

@endsection