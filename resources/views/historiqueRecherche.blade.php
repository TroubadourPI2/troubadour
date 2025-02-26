@extends('layouts.app')

@section('title', 'Historique des recherches')

@section('contenu')

    <div class="bg-c2 flex w-full h-full flex-col items-center z-0">
        <!-- Titre de la section de recherche -->
        <h2 class="w-full text-center text-c1 font-bold text-2xl font-barlow">Historique des {!! __('Recherche') !!}s</h2>

        <!-- Séparateur -->
        <div class="w-full flex justify-center items-center h-8">
            <hr class="w-3/4 bg-c1 h-1">
        </div>

        <div class="flex flex-col xl:flex-row w-96 xl:w-5/6 h-3/4 2xl:m-3 max-xl:justify-center max-xl:items-center">
            <h3 class="font-barlow text-c1 xl:w-60 text-right p-2 xl:px-3 xl:py-0">Termes les plus recherchés</h3>
            <div class="grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-5 gap-3 w-5/6 h-3/4 ">
                @if(count($recherches) == 0)
                    <div class="flex w-full h-full justify-between items-center bg-c3 rounded-md p-1 px-3">
                        <h3 class="text-c1 font-barlow text-lg">Aucune recherche effectuée</h3>
                    </div>
                @else
                    @foreach ($recherches as $recherche)
                        <div class="flex w-full h-full justify-between items-center bg-c3 rounded-md p-1 px-3">
                            <h3 class="text-c1 font-barlow text-lg">{{$recherche->terme_recherche}}</h3>
                            <div class="flex bg-c1 rounded-full justify-center items-center w-20">
                                <h3 class="text-c3 font-barlow text-md p-1 text-center">{{$recherche->nbOccurences}}</h3>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="flex flex-col xl:flex-row w-96 xl:w-5/6 h-3/4 m-3 max-xl:justify-center max-xl:items-center">
            <h3 class="font-barlow text-c1 xl:w-60 text-right px-3">Villes les plus recherchés</h3>
            <div class="grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-5 gap-x-3 gap-y-1 w-5/6 h-3/4">
                @if(count($resultatsVilles) == 0)
                    <div class="flex w-full h-full justify-between items-center bg-c3 rounded-md p-1 px-3">
                        <h3 class="text-c1 font-barlow text-lg">Aucune recherche effectuée</h3>
                    </div>
                @else
                    @foreach($resultatsVilles as $resultat)
                        <div class="flex w-full justify-between items-center bg-c3 rounded-md p-1 px-3">
                            <h3 class="text-c1 font-barlow text-lg">{{$resultat->nom_ville}}</h3>
                            <div class="flex bg-c1 rounded-full justify-center items-center w-20">
                                <h3 class="text-c3 font-barlow text-md p-1 text-center">{{$resultat->total}}</h3>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="flex flex-col xl:flex-row w-96 xl:w-5/6 h-3/4 m-3 max-xl:justify-center max-xl:items-center">
            <h3 class="font-barlow text-c1 xl:w-60 text-right px-3">Quartiers les plus recherchés</h3>
            <div class="grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-5 gap-x-2 w-5/6">
                @if(count($resultatsQuartiers) == 0)
                    <div class="flex w-full h-full justify-between items-center bg-c3 rounded-md p-1 px-3">
                        <h3 class="text-c1 font-barlow text-lg">Aucune recherche effectuée</h3>
                    </div>
                @else
                    @foreach ($resultatsQuartiers as $quartiers)
                        <div class="flex w-full justify-between items-center bg-c3 rounded-md p-1 px-3">
                            <div class="flex flex-col"> 
                                <h3 class="text-c1 font-barlow text-lg">{{$quartiers->nom_quartiers}}</h3>
                                <!-- <h3 class="text-c1 font-barlow text-xs p-1 text-left">Ville</h3> -->
                            </div>
                            <div class="flex bg-c1 rounded-full justify-center items-center w-20">
                                <h3 class="text-c3 font-barlow text-md p-1 text-center">{{ $quartiers->total }}</h3>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
