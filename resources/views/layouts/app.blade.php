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
            <div class="flex w-full justify-end gap-x-4 items-center">
                <span class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow ">Attraits</span>
                <div class="border-r h-12 border-c1 rounded "></div>
                <span class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow ">À propos</span>
                <div class="border-r h-12 border-c1 rounded "></div>
                <span class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow ">compte</span>
                <div class="border-r h-12 border-c1 rounded "></div>
                <span class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow ">déconnexion</span>
                <div class="border-r h-12 border-c1 rounded "></div>
                <span class="iconify size-6 2xl:size-8" data-icon="mdi:search" data-inline="false"></span>
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