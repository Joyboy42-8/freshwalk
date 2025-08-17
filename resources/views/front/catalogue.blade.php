<x-app-layout>

    <div class="p-5">
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 my-5 p-5">
            @foreach ($categories as $categorie)
            <div class="max-w-sm h-72 bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="flex flex-col gap-5">
                    <a href="{{ route("dashboard.one-catalogue", $categorie->id) }}" class="bg-slate-500 block rounded-t-lg h-auto px-5 py-20 text-center w-full max-h-52 object-cover">
                        <h5 class="mb-2 text-2xl text-white font-bold tracking-tight ">
                            {{$categorie->nom }}
                        </h5>
                    </a>
                    <a href="{{ route("dashboard.one-catalogue", $categorie->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 w-1/2 mx-5">
                        See products
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </section>
    
        {{ $categories->links() }}
    </div>

</x-app-layout>