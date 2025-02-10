@extends('layouts.app')

@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-full bg-c2 max-w-1/2 font-barlow  ">
        <div class="flex flex-col justify-center items-center w-full h-full">
 <img src="{{ asset('images/logo/nom_image.jpg') }}"alt="">

            <span class="text-c1 text-7xl font-barlow font-bold ">TROUBADOUR</span>
            <span class="text-c1 text-3xl font-barlow  ">Explorez sans limites</span>
        </div>
    </div>
    <div class="flex w-full h-full bg-c1 max-w-1/2 font-barlow   "></div>

@endsection
