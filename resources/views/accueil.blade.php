@extends('layouts.app')

@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-full bg-c2 max-w-1/2 font-barlow  ">
        <div class="flex flex-col justify-center items-center w-full h-full">
            <img src="{{ asset('images/Logos/logoC1.svg') }}"alt="Logo de troubadour" class="w-96">

            <span class="text-c1 text-8xl font-barlow font-bold">TROUBADOUR</span>
            <span class="text-c1 text-4xl font-barlow">Explorez sans limites</span>
        </div>
    </div>
    <div class="flex w-full h-full bg-c1 max-w-1/2 font-barlow">
        <div class="flex flex-col justify-start w-full h-full">
            <navbar class="w-full flex justify-between p-8">
                <div>
                    <a class="text-c3 text-2xl px-8 font-barlow">ACCUEIL </a>
                    <a class="text-c3 text-2xl font-barlow">À PROPOS </a>
                </div>
                <div>
                    <a class=" text-2xl bg-c2 rounded-full p-1.5 px-4 text-c1 font-barlow">CONNEXION </a>
                </div>
            </navbar>
        </div>
    </div>

@endsection
