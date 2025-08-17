<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset("logo.jpg") }}" type="image/jpg">

        <title>FRESH WALK</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/7880d5522c.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    </head>
    <body class="font-source text-xl overflow-x-hidden antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="font-roboto">
                {{ $slot }}
            </main>

            <footer class="bg-black flex justify-center md:justify-between items-center p-10 w-full">
                <nav class="grow grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Liens Réseaux -->
                    <div class="flex justify-center items-center gap-5">
                      <a href="https://facebook.com" target="_blank" class="hover:text-my-yellow duration-300"><i class="fab fa-facebook"></i></a>
                      <a href="https://twitter.com" target="_blank" class="hover:text-my-yellow duration-300"><i class="fab fa-twitter"></i></a>
                      <a href="https://instagram.com" target="_blank" class="hover:text-my-yellow duration-300"><i class="fab fa-instagram"></i></a>
                      <a href="https://youtube.com" target="_blank" class="hover:text-my-yellow duration-300"><i class="fab fa-youtube"></i></a>
                      <a href="https://github.com/Joyboy42-8" target="_blank" class="hover:text-my-yellow duration-300"><i class="fab fa-github"></i></a>
                    </div>
                
                    <!-- Liens Contact -->
                    <div class="flex justify-center items-center flex-col gap-5 p-3">
                      <a href="{{ route("contact") }}" class="hover:text-my-yellow duration-300">Contact</a>
                      <a href="tel:+221770000000" class="hover:text-my-yellow duration-300">+221 77 000 00 00</a>
                      <a href="mailto:contact@tonsite.com" class="hover:text-my-yellow duration-300">contact@tonsite.com</a>
                    </div>
                
                    <!-- Copyright -->
                    <p class="col-span-2 text-slate-500 p-3">&copy; 2025 TonSite. Tous droits réservés.</p>
                </nav>
                <img src="{{ asset("logo.jpg") }}" alt="Logo Fresh Walk" class="hidden md:block rounded-lg size-60">
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
