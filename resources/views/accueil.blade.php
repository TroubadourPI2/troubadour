@extends('layouts.app')

@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-full font-barlow lg:flex-row">
{{--         <div class=" flex-col justify-center items-center  hidden lg:flex w-full lg:w-1/2 h-full bg-c2 relative z-10">
            <img src="{{ asset('images/Logos/logoC1.svg') }}" alt="Logo de troubadour" class="w-96">
            <span class="text-c1 text-8xl font-barlow font-bold">TROUBADOUR</span>
            <span class="text-c1 text-4xl font-barlow">Explorez sans limites</span>
        </div> --}}

        <div class="relative flex flex-col justify-start w-full  h-full font-barlow overflow-hidden">

            <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
                <source src="{{ asset('videos/activites.mp4') }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo.
            </video>

            <div class="absolute top-0 left-0 w-full h-full bg-black opacity-40 z-5"></div>

            <div class="relative z-10 w-full h-full flex flex-col">
                <div class="flex w-full bg-c2 h-24 items-center justify-center gap-x-4 lg:hidden"> <img
                        src="{{ asset('images/Logos/logoC1.svg') }}" alt="Logo de troubadour" class="w-16"><span
                        class="font-bold text-c1 text-4xl">TROUBADOUR</span></div>
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
                            class="text-xl lg:text-2xl  bg-c2 rounded-full p-1.5 px-4 cursor-pointer text-c1 font-barlow">CONNEXION</a>
                    </div>
                </navbar>
                <div class="text-c3 border mx-4 lg:hidden"></div>

                <div class="w-full h-full flex justify-evenly items-center flex-col">
                    <div>
                        <span class="text-c3 text-4xl">BIENVENUE</span>
                    </div>
                    <div>
                        <button
                            class="group items-center flex text-4xl shadow-lg bg-c2 rounded-full p-1.5 px-6 text-c1 font-barlow hover:scale-110 transition-transform duration-500 ease-out">
                            VILLES
                            <span class="iconify  transform transition-all duration-500 ease-out group-hover:translate-x-3"
                                data-icon="fluent:arrow-right-24-regular" data-inline="false"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
