@extends('layouts.Accueil')

@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-screen flex-col">

        <div class="relative flex flex-col justify-start w-full h-full font-barlow overflow-hidden">

            <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
                <source src="{{ asset('videos/activites.mp4') }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo.
            </video>

            <div class="absolute top-0 left-0 w-full h-full bg-black opacity-70 z-5"></div>

            <div class="relative z-10 w-full h-full flex flex-col">

                <navbar class="w-full flex justify-between p-8 uppercase">
                    {{-- Bouton ouverture Menu Mobile --}}
                    <div class="md:hidden flex justify-end w-full items-center text-c3 gap-2">

                        <div>
                            <button id="boutonOuvrirMenu">
                                <span class="iconify size-10" data-icon="mdi:menu" data-inline="false"></span>
                            </button>
                        </div>

                    </div>
                    <div class="hidden md:flex gap-x-8 items-center">
                        <a href="{{ route('lieux.recherche') }}"
                            class="p-1.5 px-4 text-c3 text-xl lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                            {{ __('lieux') }}
                        </a>
                        <a
                            class="p-1.5 px-4 text-c3 text-xl lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                            {{ __('aPropos') }}
                        </a>
                        @role(['Admin'])
                            <a href="{{ route('admin') }}"
                                class="p-1.5 px-4 text-c3 text-xl lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                                {{ __('administration') }}
                            </a>
                        @endrole
                    </div>
                    <div class="hidden md:flex md:items-center">
                        @auth
                            <button id="btnDeconnexion"
                                class=" text-xl lg:text-2xl rounded-full p-1.5 px-4 hover:bg-c3 hover:text-c1 cursor-pointer text-c3 font-barlow uppercase">
                                {{ __('deconnexion') }}
                            </button>
                            <form action="{{ route('usagers.Deconnexion') }}" method="POST" id="formDeconnexion">
                                @csrf

                            </form>
                        @else
                            <button onclick="AfficherModalConnexion()"
                                class="text-xl lg:text-2xl rounded-full p-1.5 px-4 hover:bg-c3 hover:text-c1 cursor-pointer text-c3 font-barlow uppercase">
                                {{ __('connexion') }}
                            </button>
                        @endauth
                        <div x-data="{ open: false }" class="relative font-barlow">
                            <div @click="open = !open"
                                class="cursor-pointer hover:bg-c3 hover:text-c1 text-c3 px-2 py-1 text-c1 rounded-full transition">
                                <span class="iconify size-5 2xl:size-6" data-icon="iconoir:language"
                                    data-inline="false"></span>
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
                                            <span class="iconify mr-2 size-6"
                                                data-icon="emojione-v1:flag-for-canada"></span>
                                        @endif
                                        {{ $nom }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </navbar>
                <div class="text-c3 border mx-4"></div>

                <div class="w-full h-full flex justify-evenly items-center flex-col">
                    <div class="flex flex-col w-full items-center">
                        <span class="text-c3 font-barlow text-5xl lg:text-9xl">TROUBADOUR</span>
                        <span class="text-c3 text-xl lg:text-5xl uppercase">{{ __('slogan') }}</span>
                    </div>
                    <div>
                        <button id="activerSection"
                            class="group items-center flex-col text-2xl lg:text-5xl flex p-1.5 text-c3 font-barlow hover:scale-110 transition-transform duration-500 ease-out">
                            <span class="shadow-lg px-6 rounded-full uppercase">{{ __('decouvrir') }}</span>
                            <span
                                class="iconify text-c3 size-12 transform transition-all duration-1000 ease-out group-hover:translate-y-3"
                                data-icon="ep:arrow-down" data-inline="false"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="menuMobile"
            class="fixed inset-0 z-50 bg-c3 transform -translate-x-full transition-transform duration-300 md:hidden ">
            <div class="p-4 flex w-full h-full flex-col">

                <div class="flex items-center w-full">
                    <!-- Bouton pour fermer le menu mobile -->
                    <div class="flex justify-end w-full">
                        <button id="boutonFermerMenu" class="text-c1 justify-end  ">
                            <span class="iconify size-10 hover:bg-c1 hover:text-c3" data-icon="mdi:close"
                                data-inline="false"></span>
                        </button>
                    </div>
                </div>
                <!-- Liens de navigation pour mobile -->

                <nav class="space-y-8 mt-4 text-c1 font-bold font-barlow text-4xl flex flex-col h-full uppercase">
                    <a href="{{ route('lieux.recherche') }}"
                        class=" hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"><span
                            class="iconify size-10 " data-icon="mdi:home"
                            data-inline="false"></span>{{ __('lieux') }}</a>
                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full "> <span
                            class="iconify size-10 " data-icon="mdi:about"
                            data-inline="false"></span>{{ __('aPropos') }}</a>
                    @role(['Admin', 'Utilisateur', 'Gestionnaire'])
                        <a href="{{ route('usagerLieux.afficher') }}"
                            class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                                class="iconify size-10 " data-icon="mdi:user"
                                data-inline="false"></span>{{ __('compte') }}</a>
                    @endrole
                    @role(['Admin'])
                        <a href="{{ route('admin') }}"
                            class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                                class="iconify size-10 " data-icon="mdi:user"
                                data-inline="false"></span>{{ __('administration') }}</a>
                    @endrole
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
                                        <span class="iconify mr-2" data-icon="emojione-v1:flag-for-united-states"></span>
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
                            <button class="hover:bg-c4 p-2 transition duration-300 flex items-center w-full uppercase">
                                <span class="iconify size-10" data-icon="mdi:logout" data-inline="false"></span>
                                {{ __('deconnexion') }}
                            </button>
                        </form>
                    @else
                        <a href="#" onclick="AfficherModalConnexion()"
                            class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                                class="iconify size-10 " data-icon="mdi:user"
                                data-inline="false"></span>{{ __('connexion') }}</a>

                    @endauth

                </nav>

            </div>
        </div>
    </div>

    <div id="sectionCacher"
        class=" flex-col 
     gap-y-8 sm:gap-y-16 bg-c2  font-barlow text-5xl opacity-0 transition-opacity hidden duration-1000 ease-out px-4">

        <div class="pt-4 flex justify-center">
            <span id="villeSpan"
                class="font-bold animate-pulse uppercase text-xl md:text-2xl lg:text-4xl xl:text-7xl text-c1">{{ __('chargement') }}</span>
        </div>
        <div class=" border-c1 border rounded mx-16"></div>

        <div id="conteneurCarte"
            class="grid gap-y-4 gap-x-4  overflow-x-hidden grid-cols-1  md:grid-cols-2    xl:grid-cols-5 shadow-lg place-items-center w-full h-full overflow-y-auto xl:overflow-hidden py-8 lg:py-0  ">

        </div>
    </div>
    </div>

    <script src="{{ asset('js/Accueil.js') }}"></script>
@endsection

<script src="{{ asset('js/usagers/Connexion.js') }}"></script>
<script src="{{ asset('js/usagers/Inscription.js') }}"></script>
<script>
    @auth
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("btnDeconnexion").addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById("formDeconnexion").submit();
        });
    });
    @endauth
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
