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
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="" />
</head>

<body class="flex flex-col min-h-screen" data-locale="{{ session('locale', config('app.locale')) }}">
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
                <a class="text-c1 uppercase text-lg xl:text-2xl font-barlow text-semibold cursor-pointer hover:bg-c3 px-2 py-1 rounded-full transition  "
                    href="{{ route('lieux.recherche') }}">{{ __('lieux') }}</a>
                <div class="border-r-2 h-10 border-c1 rounded "></div>
                <a
                    class="text-c1 uppercase text-lg xl:text-2xl font-barlow cursor-pointer text-semibold hover:bg-c3 px-2 py-1 rounded-full transition   ">{{ __('aPropos') }}</a>
                <div class="border-r-2 h-10 border-c1 rounded "></div>
                @auth
                    <a class="text-c1 uppercase text-lg xl:text-2xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1 rounded-full transition"
                        href="{{ route('usagerLieux.afficher') }}">{{ __('compte') }}</a>
                    <div class="border-r-2 h-10 border-c1 rounded "></div>
                @endauth

                @auth
                    <form action="{{ route('usagers.Deconnexion') }}" method="POST" class="m-0">
                        @csrf
                        <button
                            class=" text-c1 uppercase text-lg xl:text-2xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1  rounded-full transition">
                            {{ __('deconnexion') }}
                        </button>
                    </form>
                @else
                    <a onclick="AfficherModalConnexion()"
                        class="text-c1 uppercase text-lg xl:text-2xl font-barlow cursor-pointer hover:bg-c3 px-2 py-1  rounded-full transition   ">{{ __('connexion') }}</a>
                    <div class="border-r-2 h-10 border-c1 rounded "></div>
                @endauth

                <div x-data="{ open: false }" class="relative font-barlow">
                    <div @click="open = !open"
                        class="cursor-pointer hover:bg-c3 px-2 py-1 text-c1 rounded-full transition">
                        <span class="iconify size-5 2xl:size-6" data-icon="iconoir:language" data-inline="false"></span>
                    </div>
                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 mt-2 w-60 bg-white shadow-lg rounded-lg overflow-hidden border border-c1">
                        @foreach (config('langue.locales') as $locale => $nom)
                            <a href="{{ route('langue', ['locale' => $locale]) }}"
                                class=" px-4 py-2 text-c1 hover:bg-c3 transition flex flex-row items-center ">
                                @if ($locale == 'en')
                                    <span class="iconify mr-2 size-6"
                                        data-icon="emojione-v1:flag-for-united-states"></span>
                                @elseif($locale == 'fr-ca')
                                    <span class="iconify mr-2 size-6" data-icon="emojione-v1:flag-for-canada"></span>
                                @endif
                                {{ $nom }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <span
                    class="iconify size-9 2xl:size-10 cursor-pointer hover:bg-c3 px-2 py-1 text-c1 rounded-full transition "
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
                <nav class="space-y-8 mt-4 text-c1 font-bold font-barlow text-4xl flex flex-col h-full uppercase">
                    <a href="{{ route('lieux.recherche') }}"
                        class=" hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"><span
                            class="iconify size-10 " data-icon="mdi-camera"
                            data-inline="false"></span>{{ __('lieux') }}</a>
                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                            class="iconify size-10 " data-icon="mdi:about"
                            data-inline="false"></span>{{ __('aPropos') }}</a>

                    @auth
                        <a href="{{ route('usagerLieux.afficher') }}"
                            class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full">
                            <span class="iconify size-10 " data-icon="mdi:user"
                                data-inline="false"></span>{{ __('compte') }}</a>
                    @endauth

                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full">
                        <span class="iconify size-10 " data-icon="mdi:search"
                            data-inline="false"></span>{{ __('Recherche') }}</a>
                    <div x-data="{ open: false }" class="relative font-barlow">
                        <a @click="open = !open"
                            class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full cursor-pointer">
                            <span class="iconify size-10" data-icon="iconoir:language" data-inline="false"></span>
                            {{ __('langues') }}
                        </a>
                        <div x-show="open" @click.outside="open = false"
                            class="absolute left-0 mt-2 w-60 bg-white shadow-lg rounded-lg overflow-hidden border border-c1">
                            @foreach (config('langue.locales') as $locale => $nom)
                                <a href="{{ route('langue', ['locale' => $locale]) }}"
                                    class="flex flex-row items-center px-4 py-2 text-c1 hover:bg-c3 transition text-xl">
                                    @if ($locale == 'en')
                                        <span class="iconify mr-2"
                                            data-icon="emojione-v1:flag-for-united-states"></span>
                                    @elseif($locale == 'fr-ca')
                                        <span class="iconify mr-2" data-icon="emojione-v1:flag-for-canada"></span>
                                    @endif
                                    {{ $nom }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @auth
                        <form action="{{ route('usagers.Deconnexion') }}" method="POST">
                            @csrf
                            <button class="  hover:bg-c4 p-2 transition duration-300 flex items-center w-full uppercase">
                                <span class="iconify size-10" data-icon="mdi:logout" data-inline="false"></span>
                                {{ __('deconnexion') }}
                            </button>
                        </form>
                    @else
                        <a href="#" onclick="AfficherModalConnexion()"
                            class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full">
                            <span class="iconify size-10 " data-icon="mdi:login" data-inline="false"></span>
                            {{ __('connexion') }}
                        </a>
                    @endauth
                    @if (session()->has('deconnexionSucces'))
                        <script src="{{ asset('js/usagers/usagers/Deconnexion.js') }}" defer></script>
                        @php session()->forget('deconnexionSucces'); @endphp
                    @endif

                </nav>

            </div>
        </div>
    </header>

    <main class=" flex flex-col w-full flex-grow bg-c2 font-barlow lg:px-16 px-10"
        data-locale="{{ session('locale', config('app.locale')) }}">
        @yield('contenu')

    </main>
    <footer class="position bottom-0 left-0 w-full">
        @yield('footer')
        {{-- Footer desktop --}}
        <div class=" w-full hidden lg:flex max-h-40 p-4 bg-c1 gap-x-4">
            <div class="flex items-center"> <img src="{{ asset('/Images/Logos/logoC5.svg') }}" class="w-28"
                    alt="Logo Troubadour"></div>
            <div class="flex flex-col justify-center items-start w-80 h-full font-barlow text-c3 text-xl">
                <span>3500
                    RUE DE
                    COURVAL</span> <span>Trois-Rivières, QC G8Z 1T2</span>
                <span>contact@troubadour.com</span><span>(819)-555-5555</span>
            </div>
            <div class="flex w-full flex-col font-barlow text-c3">
                <div class="flex pt-10  gap-x-4 w-full h-full justify-end items-end"><span class="iconify size-9 "
                        data-icon="iconoir:facebook" data-inline="false"></span> <span class="iconify size-9 "
                        data-icon="mdi-instagram" data-inline="false"></span> <span class="iconify size-9 "
                        data-icon="mingcute:social-x-line" data-inline="false"></span></div>
                <div class="flex w-full h-full justify-end text-lg items-end"><span>©2025
                        Troubadour.{{ __('droitsReserves') }}</span></div>
            </div>
        </div>

        {{-- Footer mobile et tablette --}}
        <div class=" w-full flex flex-col h-full lg:hidden  p-2  bg-c1 gap-y-2 font-barlow">
            <div class="flex pt-5 justify-center text-c2  gap-x-4 w-full h-full"><span class="iconify size-9 "
                    data-icon="iconoir:facebook" data-inline="false"></span> <span class="iconify size-9 "
                    data-icon="mdi-instagram" data-inline="false"></span> <span class="iconify size-9 "
                    data-icon="mingcute:social-x-line" data-inline="false"></span></div>
            <div class="flex w-full justify-center"> <span class="text-c2 font-bold text-3xl"> TROUBADOUR</span>
            </div>
            <div class="flex w-full flex-col  gap-y-4 ">
                <div class="flex flex-row justify-center gap-x-4">
                    <div
                        class="flex flex-row justify-center gap-x-4 items-center sm:w-80 w-96  h-20 rounded-md font-barlow text-xs min-[500px]:text-lg   px-2 sm:px-4 bg-c2 text-c1">
                        <div class="flex  w-fit"><span class="iconify size-6 sm:size-8 " data-icon="ic:outline-place"
                                data-inline="false"></span> </div>
                        <div class="w-full  flex flex-col  "> <span>3500
                                RUE DE
                                COURVAL</span> <span>Trois-Rivières, QC G8Z 1T2</span></div>

                    </div>
                    <div
                        class="flex flex-row justify-center gap-x-4 items-center min-[500px]:text-lg text-sm sm:w-80 w-96 rounded-md  font-barlow  h-20   px-2 sm:px-4  bg-c2 text-c1">
                        <div class="flex  w-fit"><span class="iconify size-6 sm:size-8 "
                                data-icon="solar:phone-outline" data-inline="false"></span> </div>
                        <div class="w-full  flex flex-col justify-center items-center ">
                            <span>(819)-555-5555</span>
                        </div>

                    </div>
                </div>
                <div class="flex w-full justify-center md:px-1.5 ">
                    <div class="bg-c2 w-11/12 md:w-3/4 flex justify-center items-center    p-2 "> <span
                            class="text-c1  flex text-base min-[500px]:text-xl"> <span class="iconify size-8 text-c1 "
                                data-icon="mdi-at" data-inline="false"></span>contact@troubadour.com</span></div>
                </div>
            </div>

            <div class="flex w-full flex-col font-barlow text-c3">
                <div class="flex w-full h-full justify-center text-lg items-end"><span>©2025
                        Troubadour.{{ __('droitsReserves') }}</span></div>
            </div>
        </div>
    </footer>
</body>
<script defer src="{{ asset('js/translations.js') }}"></script>
<script src="{{ asset('js/usagers/usagers/Connexion.js') }}"></script>
<script src="{{ asset('js/usagers/usagers/Inscription.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="//unpkg.com/alpinejs" defer></script>

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

