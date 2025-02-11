@extends('layouts.app')

@section('title', 'Accueil')

@section('header')

    </nav>
    @endsection
    @section('contenu')
    
    <div class="bg-c2 flex w-full h-full flex-col items-center">
    <!-- Titre de la section de recherche -->
    <h2 class="w-full text-center text-c1 font-bold text-2xl font-barlow">Recherche</h2>

    <!-- Barre de recherche -->
    <div class="flex w-5/6 bg-c3 rounded-full items-center my-4">
        <div class="flex bg-c1 rounded-full m-2 flex flex-row w-96 items-center px-5">
            <select class="flex bg-c1 justify-center items-center h-12 w-3/4 rounded-full font-barlow text-c3 text-center">
                <option value="default" disabled selected>Choisir la ville</option>
                <option value="TR">Trois-Rivières</option>
                <option value="QC">Québec</option>
            </select>
            <span class="rounded-full my-2 flex items-center justify-center h-full w-1/6 font-barlow text-c3">|</span>
            <select class="flex bg-c1 justify-center items-center h-12 w-3/4 rounded-full font-barlow text-c3 text-center">
                <option value="default" disabled selected>Choisir le quartier</option>
                <option value="Cap">Cap-de-la-madeleine</option>
                <option value="TRO">Trois-Rivières Ouest</option>
                <option value="PDL">Pointe du lac</option>
                <option value="SM">Sainte-Marthe</option>
                <option value="SLF">Saint-Louis-De-France</option>
            </select>
        </div>
        <input type="text" class="w-3/5 h-5/6 bg-transparent text-c1 font-barlow text-xl pl-5 text-center" placeholder="Rechercher un lieu, un événement, un artiste...">
        <div class="flex bg-c1 rounded-full m-2 flex flex-row w-96 items-center px-5 h-12 justify-center cursor-pointer">
            <span class="iconify size-6 text-c3" data-icon="mdi:search" data-inline="false"></span>
        </div>
    </div>

    <!-- Séparateur -->
    <div class="w-full flex justify-center items-center h-12">
        <hr class="w-3/4 bg-c1 h-1">
    </div>

    <!-- Boutons de filtres -->
    <div class="flex w-5/6 h-12 justify-center items-center space-x-5 my-4">
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Prix</h3>
        </div>
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Type</h3>
        </div>
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Distance</h3>
        </div>
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Organisme</h3>
        </div>
        <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Avis</h3>
        </div>
    </div>

    <!-- Section des cartes (avec scroll seulement ici) -->
    <div class="flex w-5/6 max-h-60 overflow-y   bg-red-500 flex-col space-y-10 overflow-x-hidden">
  
         
               
                <div class="flex flex-col space-x-10 justify-center items-center">
              <div class="flex flex-row">
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Boréalis</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
                <!-- Carte 2 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Amphithéâtre Cogéco</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
            
                <!-- Carte 1 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Boréalis</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
                <!-- Carte 2 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Amphithéâtre Cogéco</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
                </div>
                <div class="flex flex-row">
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Boréalis</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
                <!-- Carte 2 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Amphithéâtre Cogéco</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
            
                <!-- Carte 1 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Boréalis</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
                <!-- Carte 2 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Amphithéâtre Cogéco</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
                <div class="flex flex-row">
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Boréalis</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
                <!-- Carte 2 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Amphithéâtre Cogéco</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
            
                <!-- Carte 1 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Boréalis</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
                <!-- Carte 2 -->
                <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3">
                    <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                    <h3 class="text-c1 font-barlow text-md my-2">Amphithéâtre Cogéco</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
    </div>
</div>

    <script src="{{asset('js/filtreRecherche.js')}}"></script>

@endsection