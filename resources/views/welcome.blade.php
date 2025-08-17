<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{ asset("logo.jpg") }}" type="image/jpg">
    <title>FRESH WALK</title>
    @vite(['resources/css/app.css', 'resources/js/landing.js'])
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Combo&display=swap");
    </style>
    <script src="https://kit.fontawesome.com/7880d5522c.js" crossorigin="anonymous"></script>
  </head>
  <body
    class="overflow-x-hidden text-center text-xl"
    style="font-family: 'Combo'"
  >
    <header
      class="px-10 py-3 flex justify-between items-center shadow header"
    >
      <img
        src="{{ asset("logo.jpg") }}"
        alt="Logo Fresh Walk"
        class="size-20 rounded-full"
      />
      <nav class="flex gap-5 items-center">
        <a
          href="{{ route("contact") }}"
          class="block font-bold hover:text-[#E63946]"
          >Contact</a
        >
        <a
          href="{{ route("login") }}"
          class="block font-bold hover:bg-[#E63947] bg-[#E63946] text-white p-2 rounded-lg cta-btn"
          >Get Started</a
        >
      </nav>
    </header>

    <main class="">
        <section class="md:relative p-3 md:h-[600px] mb-5 md:mb-50">
            <h1 class="text-7xl md:text-9xl text-center md:absolute top-[2%] left-[43%] z-10">MAKE IT FRESH</h1>
            <!-- Image 1 -->
            <img class="md:absolute top-[3%] left-[5%] w-1/3 h-[300px] object-cover shadow-lg rounded-lg hidden md:block hero-subtitle"
                 src="{{ asset("images/pexels-amanjakhar-2048548.jpg") }}" alt="Image 1" />
          
            <!-- Image 2 -->
            <img class="md:absolute top-[44%] left-[15%] w-1/3 h-[300px] object-cover shadow-lg rounded-lg hidden md:block hero-subtitle"
                 src="{{ asset("images/nike-5099507_1280.jpg") }}" alt="Image 2" />
          
            <!-- Image 3 -->
            <img class="md:absolute top-[35%] left-[45%] w-full h-[400px] block md:w-1/3 md:h-[300px] object-cover shadow-lg rounded-lg hero-subtitle"
                 src="{{ asset("images/nike-5578104_1280.jpg") }}" alt="Image 3" />
        </section>
        
        <h1 class="text-7xl md:text-9xl text-center my-5 md:mb-5 fade-up">Our COLLECTIONS</h1>
        <p>Live like it were this is your last day in this world !</p>
        
        <section class="py-5 my-15 flex flex-col md:flex-row justify-center items-center gap-5 collections">
            <article><img src="{{ asset("images/pexels-desertedinurban-4462781.jpg") }}" alt="Shoes" class="h-96 sneaker-item"></article>
            <article><img src="{{ asset("images/pexels-avneet-kaur-669191817-19294576.jpg") }}" alt="Shoes" class="h-96 sneaker-item"></article>
            <article><img src="{{ asset("images/ryan-plomp-76w_eDO1u1E-unsplash.jpg") }}" alt="Shoes" class="h-96 sneaker-item"></article>
        </section>

        <h1 class="text-7xl md:text-9xl text-center mb-5 fade-up">Find Your Shoes</h1>

        <section class="py-5 my-15 flex flex-col md:flex-row justify-center items-center gap-5 collections-two">
            <article><img src="{{ asset("images/ryan-plomp-jvoZ-Aux9aw-unsplash.jpg") }}" alt="Shoes" class="h-[400px] grid-left"></article>
            <article><img src="{{ asset("images/tennis-7968714_1280.png") }}" alt="Shoes" class="h-[400px] grid-right"></article>
        </section>
    </main>

    <footer class="bg-black flex justify-center md:justify-between items-center p-10 text-white">
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

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  </body>
</html>
