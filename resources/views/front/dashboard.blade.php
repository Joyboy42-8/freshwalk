<x-app-layout>
    {{--Carousel Hero --}}
    <div id="default-carousel" class="relative w-full" data-carousel="slide">
        {{-- CTA --}}
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 p-5 md:p-1 text-center bg-white/50 rounded">
            <h1 class="sm:text-5xl text-7xl font-extrabold font-roboto">Welcome To Fresh Walk</h1>
            <a href="{{ route("dashboard.produits") }}" class="block md:w-xs my-3 mx-auto bg-my-red text-white p-3 rounded-md">Buy</a>
        </div>
        <!-- Carousel wrapper -->
        <div class="relative h-screen overflow-hidden md:h-screen">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset("images/brad-starkey-Bowrbqz1kgw-unsplash.jpg") }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset("images/branislav-belko-lJ7iAZxplpc-unsplash.jpg") }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset("images/danilo-capece-NoVnXXmDNi0-unsplash.jpg") }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset("images/jeff-tumale-SD9Jyl1xNQ4-unsplash.jpg") }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="{{ asset("images/nike-4687824_1280.jpg") }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <h1 class="text-7xl text-center my-36 font-roboto titre">Step Into Freshness !</h1>

    {{-- Galeries --}}
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-3 mt-10 shoes-section">
        <div class="shoe-left">
            <video src="{{ asset("videos/4380323-hd_1080_1920_30fps.mp4") }}" class=" max-w-full rounded-lg" autoplay loop></video>
        </div>
        <div class="flex flex-col gap-10 justify-center">
            <h1 class="text-7xl font-roboto shoe-top">Dare To Walk Different</h1>
            <video src="{{ asset("videos/5359136-uhd_3840_2160_24fps.mp4") }}" class=" max-w-full rounded-lg" autoplay loop></video>
            <div class="flex flex-col justify-right text-right items-end gap-5 shoe-bottom">
                <p class="text-7xl font-roboto">
                    Put Them to Test
                </p>
                <a href="{{ route("dashboard.produits") }}" class="block w-xs my-3 text-center bg-my-red text-white p-3 rounded-md">Buy</a>
            </div>
        </div>
        <div class="shoe-right">
            <video src="{{ asset("videos/5319999-uhd_2160_3840_25fps.mp4") }}" class=" max-w-full rounded-lg" autoplay loop></video>
        </div>
    </section>

    <h1 class="text-center text-9xl my-10 font-roboto up">Best Sellers !</h1>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-3 p-3 my-5">
        @foreach ($produits as $produit)
            <div class="w-full md:max-w-sm h-96 bg-white border border-gray-200 rounded-lg shadow-sm up">
                <a href="{{ route("dashboard.one-produit", $produit->id) }}">
                    <img class="rounded-t-lg h-auto w-full max-h-52 object-cover" src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->nom }}" />
                </a>
                <div class="p-5">
                    <a href="{{ route("dashboard.one-produit", $produit->id) }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            {{$produit->nom }}
                        </h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ $produit->prix }} Fcfa
                    </p>
                    <a href="{{ route("dashboard.one-produit", $produit->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        See details
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </section>

</x-app-layout>
