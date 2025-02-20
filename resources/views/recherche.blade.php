@extends('layouts.app')

@section('title', 'Recherche')

@section('contenu')

<div class="bg-c2 flex w-full h-full flex-col items-center z-0">
    <!-- Titre de la section de recherche -->
    <h2 class="w-full text-center text-c1 font-bold text-2xl font-barlow">{!! __('Recherche') !!}</h2>

    <div class="lg:flex w-5/6 bg-c3 rounded-full justify-evenly items-center mt-4 h-10 hidden lg:h-12">
        <form class="lg:ml-1 lg:mr-0 mx-1 p-1 lg:pr-0 flex rounded-full justify-evenly flex-row w-full h-8 items-center" action="{{ route('lieux.recherche2') }}" method="post">
            @csrf
            <select
                class="border border-c3 hidden lg:flex bg-c1 hover:bg-c2 justify-center items-center h-full lg:h-8 w-1/2 lg:w-1/5 me-px rounded-l-full font-barlow text-c3 text-center hover:text-c1 text-xs md:text-md lg:text-lg hover:border hover:border-c1"
                id="selectVille" name="ville" required onchange="setQuartiersPC()">
                <option value="default" disabled hidden <?php if ($ville == -1) { echo "selected"; } ?>>{!! __('Choisir une ville') !!}</option>
                @if(isset($villes))
                    @if (count($villes))
                        @foreach($villes as $villee)
                            @if(isset($ville) && $ville == $villee->id)
                                <option value="{{ $villee->id }}" selected>{{ $villee->nom }}</option>
                            @else
                                <option value="{{ $villee->id }}">{{ $villee->nom }}</option>
                            @endif
                        @endforeach
                    @else
                        <option value="aucunResultat" disabled selected>{!! __('Aucune ville trouvé') !!}</option>
                    @endif
                @else
                    <option value="aucunResultat" disabled selected hidden>{!! __('Aucune ville trouvé') !!}</option>
                @endif
            </select>

            <select
                class="border enabled:border-c3 hidden lg:flex enabled:bg-c1 justify-center items-center h-full lg:h-8 w-1/2 lg:w-1/5 rounded-r-full font-barlow text-c3 text-center enabled:hover:bg-c2 enabled:hover:text-c1 text-xs md:text-md lg:text-lg enabled:hover:border hover:border-c1 disabled:bg-c2 disabled:text-c1 disabled:border-c1"
                id="selectQuartier" name="quartier" required onchange="checkQuartier()">
                @if(isset($quartiers))
                    @foreach($quartiers as $quartier2)
                        @if(isset($quartier) && $quartier == $quartier2->id)
                            <option value="{{ $quartier2->id }}" selected>{{ $quartier2->nom }}</option>
                        @else
                            <option value="{{ $quartier2->id }}">{{ $quartier2->nom }}</option>
                        @endif
                    @endforeach
                @else
                    <option value="aucunResultat" disabled selected hidden>{!! __('Aucun quartier trouvé') !!}</option>
                @endif
            </select>

            <input type="text"
                class="lg:flex hidden w-4/5 h-8 bg-transparent text-c1 font-barlow text-md p-2 mx-1 text-center rounded-full focus:border focus:border-0.5 focus:border-c1 hover:bg-c2 hover:border hover:border-c1"
                placeholder="{!! __('Que recherchez-vous ?') !!}" id="barreRecherche" name="txtRecherche" value="<?php if (isset($recherche)) { echo $recherche; } ?>">

            <button type="submit" class="lg:flex lg:mr-2 hidden w-1/4 lg:w-1/6 h-8 justify-center items-center enabled:hover:text-c1 enabled:hover:bg-c2 rounded-full bg-c1 hover:border enabled:hover:border-c1 disabled:hover:cursor-not-allowed enabled:cursor-pointer disabled:bg-c2  disabled:border disabled:border-c1" id="btnRechercher">
                <span
                    class="lg:flex iconify size-6 text-c3"
                    data-icon="mdi:search" data-inline="false"></span>
            </button>
        </form>
    </div>
    <form action="{{ route('lieux.recherche2') }}" class="flex lg:hidden flex-col w-full justify-start" method="POST">
        @csrf
        <div class="flex flex-row items-center bg-c3 rounded-full justify-evenly mt-4 h-10 p-1.5">
            <select
              class="flex lg:hidden me-px w-1/2 cursor-pointer hover:bg-c2 bg-c1 rounded-l-full font-barlow text-c3 hover:text-c1 text-center border items-center justify-center border-c3 h-full"
              id="selectVilleMobile" name="ville" onchange="setQuartiersMobile()">
                <option value="default" disabled hidden <?php if ($ville == -1) { echo "selected"; } ?>>{!! __('Choisir une ville') !!}</option>
                @if(isset($villes))
                    @if (count($villes))
                        @foreach($villes as $villee)
                            @if(isset($ville) && $ville == $villee->id)
                                <option value="{{ $villee->id }}" selected>{{ $villee->nom }}</option>
                            @else
                                <option value="{{ $villee->id }}">{{ $villee->nom }}</option>
                            @endif
                        @endforeach
                    @else
                        <option value="aucunResultat" disabled selected>{!! __('Aucune ville trouvé') !!}</option>
                    @endif
                @endif
            </select>
    
            <select
                class="flex lg:hidden w-1/2 cursor-pointer hover:bg-c2 bg-c1 rounded-r-full font-barlow text-c3 hover:text-c1 text-center border items-center justify-center border-c3 h-full"
                id="selectQuartierMobile" name="quartier">
                @if(isset($quartiers))
                    @foreach($quartiers as $quartier2)
                        @if(isset($quartier) && $quartier == $quartier2->id)
                            <option value="{{ $quartier2->id }}" selected>{{ $quartier2->nom }}</option>
                        @else
                            <option value="{{ $quartier2->id }}">{{ $quartier2->nom }}</option>
                        @endif
                    @endforeach
                @else
                    <option value="aucunResultat" disabled selected hidden id="optionDefaut">{!! __('Choisir un quartier') !!}</option>
                @endif
            </select>
        </div>
        <div class="flex flex-row items-center bg-c3 rounded-full justify-evenly flex-column mt-4 h-10 p-1.5">
            <input type="text"
                class="w-4/5 h-full bg-transparent text-c1 font-barlow text-md p-2 mx-1 text-center rounded-full focus:border focus:border-0.5 focus:border-c1 hover:bg-c2 hover:border hover:border-c1"
                placeholder="{!! __('Que recherchez-vous ?') !!}" id="barreRecherche2" name="txtRecherche" value="<?php if (isset($recherche)) { echo $recherche; } ?>">
            
            <button type="submit" class="flex w-1/4 h-full justify-center items-center enabled:hover:text-c1 enabled:hover:bg-c2 rounded-full bg-c1 hover:border enabled:hover:border-c1 disabled:hover:cursor-not-allowed enabled:cursor-pointer disabled:bg-c3  disabled:border disabled:border-c1" id="btnRechercher">
                <span
                    class="iconify size-6 text-c3"
                    data-icon="mdi:search" data-inline="false"></span>
            </button>
        </div>

    </form>

    <div class="flex lg:hidden w-full bg-c3 rounded-full justify-evenly items-center mt-2 p-2 h-10 lg:h-12">
        <div class="flex rounded-full justify-center gap-x-3 flex-row w-full h-full items-center bg-c1 cursor-pointer hover:text-c1 hover:bg-c2 hover:border hover:border-c1" id="mbBtnFiltres">
            <span
                class="iconify size-6 p-1 text-c3"
                data-icon="mdi:filter" data-inline="false"></span>
            <span class="text-c3 text-sm">{!! __('Filtrer les résultats') !!}</span>
        </div>
    </div>

    <!-- Séparateur -->
    <div class="w-full flex justify-center items-center h-8">
        <hr class="w-3/4 bg-c1 h-1">
    </div>

    <!-- Boutons de filtres -->
    <div class="w-5/6 h-12 justify-center items-center space-x-5 my-4 flex-row hidden lg:flex">
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Prix') !!}</h3>
        </div>
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Type') !!}</h3>
        </div>
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Distance') !!}</h3>
        </div>
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Organisme') !!}</h3>
        </div>
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Avis') !!}</h3>
        </div>
    </div>

    <!-- ?  Section des cartes (avec scroll seulement ici) [RESPONSIVE]-->
    <div class="flex w-5/6 h-3/4 overflow-y-auto flex-col space-y-10 overflow-x-hidden m-3 snap-y">
        @if(isset($lieux))
            @if (count($lieux))
            <div class="2xl:grid-cols-5 xl:grid-cols-4  lg:grid-cols-4  md:grid-cols-2 grid-cols-1 grid gap-y-5 place-items-center snap-center">
                @foreach($lieux as $lieu)
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu ">
                    <img src="{{ asset($lieu->photoLieu) }}" alt="{!! __('Image de l\'établissement') !!}"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">{{$lieu->nomEtablissement}}</h3>
                    <span class="text-blackfont-barlow text-sm text-center">{{$lieu->description}}</span>
                </div>
                @endforeach
            </div>
            <div class="w-full flex-justify-center items-center">
                {{ $lieux->links() }}
            </div>
            @else
            <div class="w-full h-full place-content-center">
                <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>
            </div>
            @endif
        @else
            <div class="w-full h-full place-content-center">
                <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>  
            </div>
        @endif
    </div>
</div>

<script src="{{ asset('js/filtreRecherche.js') }}"></script>
<!-- <script src="{{ asset('js/JSrechercheTexte.js') }}"></script> -->
<script src="{{ asset('js/modalFiltresMobile.js') }}"></script>

@endsection