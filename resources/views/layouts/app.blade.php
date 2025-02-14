<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@400;600;700&display=swap"
        rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="" />
</head>

<body>
    <header class="bg-c2 sticky top-0 shadow-lg z-50 lg:z-0 lg:shadow-none lg:relative">

        @yield('header')

        <div class="w-full p-8 items-center hidden lg:flex ">
            {{-- Menu Desktop --}}
            <div class="flex w-full items-center gap-x-4">
                <img src="{{ asset('/Images/Logos/logoC1.svg') }}" class=" w-20 xl:w-24" alt="Logo Troubadour">
                <span class="text-c1 uppercase text-4xl 2xl:text-5xl font-barlow font-semibold">troubadour</span>
            </div>
            <div class="flex w-full justify-end items-center gap-x-2">
                {{-- TODO remplacer par les liens quand les pages seronts faites --}}
                <a
                    class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1 rounded-full transition  ">Attraits</a>
                <div class="border-r h-12 border-c1 rounded "></div>
                <a
                    class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1 rounded-full transition   ">À
                    propos</a>
                <div class="border-r h-12 border-c1 rounded "></div>
                <a
                    class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1  rounded-full transition   ">compte</a>
                <div class="border-r h-12 border-c1 rounded "></div>
                {{--  TODO remplacer par un bouton ou un form en fonction de ce qui a faire mais garder même CSS
                TODO Ajouter en fonction de si la personne est connecté ou non l'affichage du bouton connexion deconnexion --}}
                <a
                    class="text-c1 uppercase text-lg 2xl:text-3xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1  rounded-full transition  ">déconnexion</a>
                <div class="border-r h-12 border-c1 rounded "></div>
                <span class="iconify size-9 2xl:size-10 cursor-pointer hover:bg-c3 px-2 py-1   rounded-full transition "
                    data-icon="mdi:search" data-inline="false"></span>
            </div>
        </div>
        {{-- Menu Mobile --}}

        <div class="lg:hidden  flex justify-end w-full p-8  items-center text-c1 gap-2">
            <div class="flex w-full items-center gap-x-4">
                <img src="{{ asset('/Images/Logos/logoC1.svg') }}" class=" w-20 xl:w-24" alt="Logo Troubadour">
            </div>
            <div class="flex w-full items-center justify-end">
                <button id="boutonOuvrirMenu">
                    <span class="iconify size-10" data-icon="mdi:menu" data-inline="false"></span>
                </button>
            </div>

        </div>

        <div id="menuMobile"
            class="fixed inset-0 z-50 bg-c3 transform -translate-x-full transition-transform duration-300 lg:hidden ">
            <div class="p-4 flex w-full h-full flex-col">

                <div class="flex items-center w-full">
                    <!-- Bouton pour fermer le menu mobile -->
                    <div class="flex justify-end w-full">
                        <button id="boutonFermerMenu" class="text-c1 justify-end transition  ">
                            <span class="iconify size-10 hover:bg-c1 hover:text-c3" data-icon="mdi:close"
                                data-inline="false"></span>
                        </button>
                    </div>
                </div>
                <!-- Liens de navigation pour mobile -->
                <nav class="space-y-8 mt-4 text-c1 font-bold font-barlow text-4xl flex flex-col h-full">
                    <a href="/"
                        class=" hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"><span
                            class="iconify size-10 " data-icon="mdi-camera" data-inline="false"></span>ATTRAITS</a>
                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                            class="iconify size-10 " data-icon="mdi:about" data-inline="false"></span>À PROPOS</a>
                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                            class="iconify size-10 " data-icon="mdi:user" data-inline="false"></span>COMPTE</a>
                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                            class="iconify size-10 " data-icon="mdi:login" data-inline="false"></span>CONNEXION</a>
                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                            class="iconify size-10 " data-icon="mdi:search" data-inline="false"></span>RECHERCHE</a>

                    {{-- <!-- TODO Bouton deconnexion pour mobile -->
                <form action="" method="POST">
                    @csrf
                    <button class="  hover:bg-c4 p-2 transition duration-300 flex items-center w-full">
                        <span class="iconify size-10" data-icon="mdi:logout" data-inline="false"></span> DÉCONNEXION
                    </button>
                </form> --}}
                </nav>

            </div>
        </div>

    </header>

    <main class=" w-full h-screen">
        @yield('contenu')

    </main>
    @yield('footer')
    <footer>

        <div class="flex w-full max-h-40 p-4 bg-c1 gap-x-4">
            <div class="flex items-center"> <img src="{{ asset('/Images/Logos/logoC5.svg') }}" class="w-28"
                    alt="Logo Troubadour"></div>
            <div class="flex flex-col justify-center items-start w-80 h-full font-barlow text-c3 text-xl"> <span>3500 RUE DE
                    COURVAL</span> <span>Trois-Rivières, QC G8Z 1T2</span>
                <span>contact@troubadour.com</span><span>(819)-555-5555</span></div>
               <div class="flex w-full flex-col font-barlow text-c3"> <div  class="flex pt-10  gap-x-4 w-full h-full justify-end items-end"><span
                class="iconify size-9 " data-icon="iconoir:facebook" data-inline="false"></span> <span
                class="iconify size-9 " data-icon="mdi-instagram" data-inline="false"></span> <span
                class="iconify size-9 " data-icon="mingcute:social-x-line" data-inline="false"></span></div> <div class="flex w-full h-full justify-end text-lg items-end"><span>©2025 Troubadour.Tous droits réservés.</span></div></div> 
        </div>
        
    </footer>
</body>
<script>
    document.getElementById('boutonOuvrirMenu').addEventListener('click', function() {
        const menuMobile = document.getElementById('menuMobile');
        menuMobile.classList.remove('-translate-x-full');
        document.body.classList.add('overflow-hidden');
    });

    document.getElementById('boutonFermerMenu').addEventListener('click', function() {
        const menuMobile = document.getElementById('menuMobile');
        menuMobile.classList.add('-translate-x-full');
        document.body.classList.remove('overflow-hidden');
    });
</script>

</html>
