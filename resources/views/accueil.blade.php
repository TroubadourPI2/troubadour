@extends('layouts.app')

@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-full bg-c2 max-w-1/2 font-barlow">
        <div class="flex flex-col justify-center items-center w-full h-full">
            <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Logo de troubadour" class="w-96">

            <span class="text-c1 text-8xl font-barlow font-bold ">TROUBADOUR</span>
            <span class="text-c1 text-4xl font-barlow">Explorez sans limites</span>
        </div>
    </div>
    <div class="flex w-full h-full bg-c1 max-w-1/2 font-barlow">
        <div class="flex flex-col justify-start w-full h-full">
            <navbar class="w-full flex justify-between p-8 ">
                <div class="flex gap-x-8">
                    <a
                        class="text-c3 text-2xl font-barlow cursor-pointer hover:bg-c3 px-2 hover:text-c1 rounded-full transition-transform duration-500 ease-out">ACCUEIL
                    </a>
                    <a
                        class="text-c3 text-2xl font-barlow cursor-pointer hover:bg-c3 px-2 hover:text-c1 rounded-full transition-transform duration-500 ease-out">À
                        PROPOS </a>
                </div>
                <div>
                    <a class="text-2xl bg-c2 rounded-full p-1.5 px-4 cursor-pointer text-c1 font-barlow ">CONNEXION </a>
                </div>
            </navbar>
            <div class="w-full  h-full flex justify-evenly items-center flex-col">
                <div>
                    <span class="text-c3 text-4xl">BIENVENUE</span>
                </div>
                <div>
                    <button
                        class="items-center flex text-4xl shadow-lg bg-c2 rounded-full p-1.5 px-6 text-c1 font-barlow hover:scale-110  transition-transform duration-500 ease-out">VILLES
                        <span class="iconify" data-icon="fluent:arrow-right-24-regular" data-inline="false"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
