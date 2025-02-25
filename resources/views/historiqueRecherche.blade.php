@extends('layouts.app')

@section('title', 'Historique des recherches')

@section('contenu')

    <div class="bg-c2 flex w-full h-full flex-col items-center z-0">
        <!-- Titre de la section de recherche -->
        <h2 class="w-full text-center text-c1 font-bold text-2xl font-barlow">Historique des {!! __('Recherche') !!}s</h2>

        <!-- <div class="lg:flex w-5/6 bg-c3 rounded-full justify-evenly items-center mt-4 h-10 hidden lg:h-12">
            <div class="flex w-1/2 h-full justify-center items-center space-x-5">
                <a class="w-1/2 rounded-full bg-c2 border-c1 flex border cursor-pointer hover:bg-c1 row items-center justify-between">
                    <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3 w-20">Café</h3>
                    <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3 w-20">99+</h3>
                </a>
            </div>
        </div> -->

        <!-- Séparateur -->
        <div class="w-full flex justify-center items-center h-8">
            <hr class="w-3/4 bg-c1 h-1">
        </div>

        <!-- ?  Section des cartes (avec scroll seulement ici) [RESPONSIVE]-->
        <div class="flex flex-row w-5/6 h-3/4 m-3">
            <h3 class="font-barlow text-c1 w-60 text-right px-3">Termes les plus recherchés</h3>
            <div class="grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-5 gap-x-3 gap-y-1 w-5/6 h-3/4 ">
                @foreach ($recherches as $recherche)
                    <div class="flex w-full h-1/2 justify-between items-center bg-c3 rounded-md p-3 py-5 ">
                        <h3 class="text-c1 font-barlow text-lg">{{$recherche->terme_recherche}}</h3>
                        <div class="flex bg-c1 rounded-full justify-center items-center w-20">
                            <h3 class="text-c3 font-barlow text-md p-1 text-center">{{$recherche->nbOccurences}}</h3>
                        </div>
                    </div>
                @endforeach

                <div class="flex w-full h-1/2 justify-between items-center bg-c3 rounded-md p-3 py-5 ">
                    <h3 class="text-c1 font-barlow text-lg">Voir d'autres</h3>
                    <span class="iconify size-6 text-c1" data-icon="mdi:arrow-right" data-inline="false"></span>
                </div>
            </div>
        </div>
        <div class="flex flex-row w-5/6 h-3/4 m-3">
            <h3 class="font-barlow text-c1 w-60 text-right px-3">Villes les plus recherchés</h3>
            <div class="grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-5 gap-x-3 gap-y-1 w-5/6 h-3/4">
                @foreach($resultatsVilles as $resultat)
                    <div class="flex w-full h-1/2 justify-between items-center bg-c3 rounded-md p-3 py-5 ">
                        <h3 class="text-c1 font-barlow text-lg">{{$resultat->nom_ville}}</h3>
                        <div class="flex bg-c1 rounded-full justify-center items-center w-20">
                            <h3 class="text-c3 font-barlow text-md p-1 text-center">{{$resultat->total}}</h3>
                        </div>
                    </div>
                @endforeach

                <div class="flex w-full h-1/2 justify-between items-center bg-c3 rounded-md p-3 py-5 ">
                    <h3 class="text-c1 font-barlow text-lg">Voir d'autres</h3>
                    <span class="iconify size-6 text-c1" data-icon="mdi:arrow-right" data-inline="false"></span>
                </div>
            </div>
        </div>
        <div class="flex flex-row w-5/6 h-3/4 m-3">
            <h3 class="font-barlow text-c1 w-60 text-right px-3">Quartiers les plus recherchés</h3>
            <div class="grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-5 gap-x-2 w-5/6">
                @foreach ($resultatsQuartiers as $quartiers)
                    <div class="flex w-full h-1/2 justify-between items-center bg-c3 rounded-md p-3 py-5 ">
                        <div class="flex flex-col py-3"> 
                            <h3 class="text-c1 font-barlow text-lg">{{$quartiers->nom_quartiers}}</h3>
                        </div>
                        <div class="flex bg-c1 rounded-full justify-center items-center w-20">
                            <h3 class="text-c3 font-barlow text-md p-1 text-center">{{ $quartiers->total }}</h3>
                        </div>
                    </div>
                @endforeach
                
                <div class="flex w-full h-1/2 justify-between items-center bg-c3 rounded-md p-3 py-5 ">
                    <h3 class="text-c1 font-barlow text-lg">Voir d'autres</h3>
                    <span class="iconify size-6 text-c1" data-icon="mdi:arrow-right" data-inline="false"></span>
                </div>
            </div>
        </div>
    </div>

@endsection
