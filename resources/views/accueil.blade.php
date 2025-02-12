@extends('layouts.app')

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

                <navbar class="w-full flex justify-between p-8">
                    <div class="flex gap-x-8">
                        <a
                            class="text-c3 hidden lg:flex lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                            ACCUEIL
                        </a>
                        <a
                            class="text-c3 text-xl lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                            À PROPOS
                        </a>
                    </div>
                    <div>
                        <a
                            class="text-xl lg:text-2xl rounded-full p-1.5 px-4 hover:bg-c3 hover:text-c1 cursor-pointer text-c3 font-barlow">
                            CONNEXION
                        </a>
                    </div>
                </navbar>
                <div class="text-c3 border mx-4"></div>

                <div class="w-full h-full flex justify-evenly items-center flex-col">
                    <div class="flex flex-col w-full items-center">
                        <span class="text-c3 font-barlow text-5xl lg:text-9xl">TROUBADOUR</span>
                        <span class="text-c3 text-xl lg:text-5xl uppercase">Explorez sans limites</span>
                    </div>
                    <div>
                        <button id="activerSection"
                            class="group items-center flex-col text-4xl flex p-1.5 text-c1 font-barlow hover:scale-110 transition-transform duration-500 ease-out">
                            <span class="bg-c2 shadow-lg px-6 rounded-full">VILLES</span>
                            <span
                                class="iconify text-c3 size-12 transform transition-all duration-1000 ease-out group-hover:translate-y-3"
                                data-icon="fluent:arrow-down-24-regular" data-inline="false"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="sectionCacher"
        class="flex flex-col w-full h-screen  gap-y-16 bg-c2 text-c2 font-barlow text-5xl opacity-0 transition-opacity hidden duration-1000 ease-out">

        <div class="pt-4 flex justify-center">
            <span id="villeSpan" class="font-bold animate-pulse uppercase text-c1">Chargement...</span>
        </div>
        <div class=" border-c1 border rounded mx-16"></div>

        <div id="conteneurCarte"
            class="grid gap-y-4  grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 shadow-lg place-items-center w-full h-full overflow-y-auto py-8 lg:py-0 ">
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <div class="transition-all duration-700 w-48 bg-c3 h-64 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu  opacity-0 ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40 m-2">
                <span class="text-c1 font-barlow text-2xl m-2 carteTitre ">Boréalis poulet du pont</span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
      <!--       <div
                class="w-36 h-48 sm:w-52 sm:h-80 bg-c3 text-sm sm:text-xl hover:scale-105  hover:border-red-500 border-4 cursor-pointer rounded-md shadow-lg 
    transform scale-90 opacity-0 transition-all duration-700 ease-out  lg:mb-2 xl:mb-0
    lg:col-start-2 xl:col-auto">
                <div class="h-2/3 w-full flex items-center justify-center border-2 shadow-sm">
                    VOIR PLUS ....
                </div>
                <div class="h-1/3 w-full flex items-center  text-sm sm:text-xl justify-center font-bold  ">
                    <span class="truncate px-2">VOIR PLUS .....</span>
                </div> 
            </div> -->
            <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-c1 hover:border  cursor-pointer rounded-md shadow-lg 
     opacity-0  hover:scale-110 transition-all duration-700  lg:mb-2 xl:mb-0
    lg:col-start-2 xl:col-auto ">
                <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Image du musée boréalis" class="rounded-md h-40">
                <span class="text-c1 font-barlow text-2xl my-2 carteTitre ">VOIR PLUS ... </span>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
   
            </div>
        </div>
    </div>
    </div>

    <script src="{{ asset('js/Accueil.js') }}"></script>

@endsection
