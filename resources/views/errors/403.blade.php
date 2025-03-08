@extends('layouts.Redirection')

@section('title', __('erreur403'))

@section('contenu')
    <div class="flex items-center justify-center h-screen overflow-hidden relative font-barlow bg-c3">

        <div class="absolute inset-x-0 top-5 z-10 text-center w-fit">
            <a href="/" class="flex items-center hover:text-c2 transition text-c1">
                <span class="iconify text-5xl" data-icon="ion:arrow-undo" data-inline="false"></span>
                <span class="font-bold text-3xl"> {{ __('retour') }}</span>
            </a>
        </div>

        <div class="text-center z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold text-c1 drop-shadow-lg">
                {{ __('erreur403') }}
            </h1>
            <p class="text-lg md:text-2xl mt-4 text-c1 font-semibold drop-shadow-lg">
                {{ __('erreur403Texte') }}
            </p>

            <div class="flex justify-center items-center space-x-12 mt-8">

                <div class="oeil bg-white">
                    <img src="{{ asset('Images/403/eye.png') }}" alt="Oeil gauche" class="imageOeil">
                </div>

                <div class="oeil bg-white">
                    <img src="{{ asset('Images/403/eye.png') }}" alt="Oeil droit" class="imageOeil">
                </div>
            </div>

        </div>
    </div>

@endsection
