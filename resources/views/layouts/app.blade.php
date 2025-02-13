<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>


    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@400;600;700&display=swap"
        rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="" />
</head>

<body>
    <header class="bg-c2">

        @yield('header')
  
        <div class="w-full p-8 items-center hidden lg:flex ">
                  {{-- Menu Desktop --}}
            <div class="flex w-full items-center gap-x-4">
                <img src="{{ asset('/Images/Logos/logoC1.svg') }}" class=" w-20 xl:w-24" alt="Logo Troubadour">
                <span class="text-c1 uppercase text-4xl 2xl:text-5xl font-barlow font-bold">troubadour</span>
            </div>
            <div class="flex w-full justify-end items-center gap-x-2">
                     {{-- TODO remplacer par les liens quand les pages seronts faites--}}
                <a class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1 rounded-full transition  ">Attraits</a>
                <div class="border-r h-12 border-c1 rounded "></div>
                <a class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1 rounded-full transition   ">À propos</a>
                <div class="border-r h-12 border-c1 rounded "></div>
                <a class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1  rounded-full transition   ">compte</a>
                <div class="border-r h-12 border-c1 rounded "></div>
               {{--  TODO remplacer par un bouton ou un form en fonction de ce qui a faire mais garder même CSS
                TODO Ajouter en fonction de si la personne est connecté ou non l'affichage du bouton connexion deconnexion --}}
                <a class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1  rounded-full transition  ">déconnexion</a>
                <div class="border-r h-12 border-c1 rounded "></div>
                <span class="iconify size-9 2xl:size-10 cursor-pointer hover:bg-c3 px-2 py-1   rounded-full transition " data-icon="mdi:search" data-inline="false"></span>
            </div>
        </div>
        {{-- Menu Mobile --}}

    </header>

    <main class="flex w-full h-screen">
        @yield('contenu')

    </main>
    @yield('footer')
    <footer>

    </footer>
</body>

</html>