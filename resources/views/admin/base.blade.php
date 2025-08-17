<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JB Panel</title>
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: "Roboto";
        }
    </style>
    <script src="https://kit.fontawesome.com/7880d5522c.js" crossorigin="anonymous"></script>
    @livewireStyles
</head>
<body class="flex h-screen overflow-hidden font-roboto text-lg leading-relaxed">
    <nav class="border-r border-r-black bg-black text-white flex flex-col justify-between items-center pt-3 px-10">
        <h1 class="text-3xl font-bold {{ Route::currentRouteName() == "admin.panel" ? "text-slate-600" : "" }}"><a href="{{ route("admin.panel") }}">JB Panel</a></h1>
        <ul class="flex flex-col gap-5 w-full">
            <li class="{{ Route::currentRouteName() == "avis.index" ? "text-slate-600" : "" }} w-full border-b-2 border-b-gray-100 hover:-translate-y-2 hover:border-b-4 duration-300 p-3"><a class="block" href="{{ route("avis.index") }}">Avis</a></li>
            <li class="{{ Route::currentRouteName() == "categories.index" ? "text-slate-600" : "" }} w-full border-b-2 border-b-gray-100 hover:-translate-y-2 hover:border-b-4 duration-300 p-3"><a class="block" href="{{ route("categories.index") }}">Catégories</a></li>
            <li class="{{ Route::currentRouteName() == "clients.index" ? "text-slate-600" : "" }} w-full border-b-2 border-b-gray-100 hover:-translate-y-2 hover:border-b-4 duration-300 p-3"><a class="block" href="{{ route("clients.index") }}">Clients</a></li>
            <li class="{{ Route::currentRouteName() == "commandes.index" ? "text-slate-600" : "" }} w-full border-b-2 border-b-gray-100 hover:-translate-y-2 hover:border-b-4 duration-300 p-3 flex justify-between items-center">
                <a class="block" href="{{ route("commandes.index") }}">Commandes</a>
                <span class="bg-slate-400 text-slate-800 font-bold rounded-full px-1 text-xs">
                    {{ $pendingCount > 0 ? $pendingCount : "" }}
                </span>
            </li>
            <li class="{{ Route::currentRouteName() == "produits.index" ? "text-slate-600" : "" }} w-full border-b-2 border-b-gray-100 hover:-translate-y-2 hover:border-b-4 duration-300 p-3"><a class="block" href="{{ route("produits.index") }}">Produits</a></li>
        </ul>
        <form method="POST" action="{{ route('logout') }}" class="p-3">
            @csrf

            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Déconnexion') }}
            </x-dropdown-link>
        </form>
    </nav>
    
    <section class="grow overflow-y-auto">
        <header class="bg-slate-200 px-8 py-2 flex justify-between items-center sticky top-0 w-full">
            <h2 class="text-2xl">Bienvenue, JOYBOY</h2>
            <img src="{{ asset("joyboy.jpg") }}" alt="Joyboy Picture" class="size-16 rounded-full">
        </header>
        @yield("main")
    </section>

    <script>
        let success = document.getElementById("success");
        setTimeout(() => {
            success.style.display = "none";
        }, 3000);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @livewireScripts()
</body>
</html>