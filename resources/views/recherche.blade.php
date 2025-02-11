@extends('layouts.app')

@section('title', 'Accueil')

@section('header')

    @endsection
    @section('contenu')
    
    <div class="bg-c2 flex w-full h-full flex-col items-center">
    <!-- Titre de la section de recherche -->
    <h2 class="w-full text-center text-c1 font-bold text-2xl font-barlow">Recherche</h2>

    <div class="flex w-5/6 bg-c3 rounded-full justify-between items-center my-4 md:hidden h-10">
        <!-- <div class="flex bg-c1 rounded-full m-2 flex flex-row w-12 h-8 items-center px-5 hidden">
            <select class="flex bg-c1 justify-center items-center h-4 w-3/4 rounded-full font-barlow text-c3 text-center hover:bg-c2 hover:text-c1 text-xs" id="selectVille">
                <option value="default" disabled selected>Choisir la ville</option>
                <option value="TR">Trois-Rivières</option>
                <option value="QC">Québec</option>
            </select>
            <span class="rounded-full my-2 flex items-center justify-center h-full w-1/6 font-barlow text-c3">|</span>
            <select class="flex bg-c1 justify-center items-center h-8 w-80 rounded-full font-barlow text-c3 text-center hover:bg-c2 hover:text-c1" id="selectQuartier">
            </select>
        </div> -->
        <!-- <div class="m-2 flex w-full">
            <input type="text" class="w-3/4 h-8 bg-transparent text-c1 font-barlow text-xl p-2 text-center rounded-full focus:border focus:border-1 focus:border-c1 hover:bg-c2" placeholder="Rechercher un lieu" id="barreRecherche">
            <span class="iconify size-6 text-c3 w-1/4 p-2 h-8 cursor-pointer hover:text-c1 hover:bg-c2 rounded-full bg-c1 hover:border hover:border-1 hover:border-c1" data-icon="mdi:search" data-inline="false"></span>
        </div> -->
    </div>

    <!-- Barre de recherche -->
    <div class="hidden w-5/6 bg-c3 rounded-full justify-between items-center my-4 md:flex">
        <div class="flex bg-c1 rounded-full m-2 flex flex-row w-96 h-12 items-center px-5">
            <select class="flex bg-c1 justify-center items-center h-8 w-3/4 rounded-full font-barlow text-c3 text-center hover:bg-c2 hover:text-c1" id="selectVille">
                <option value="default" disabled selected>Choisir la ville</option>
                <option value="TR">Trois-Rivières</option>
                <option value="QC">Québec</option>
            </select>
            <span class="rounded-full my-2 flex items-center justify-center h-full w-1/6 font-barlow text-c3">|</span>
            <select class="flex bg-c1 justify-center items-center h-8 w-80 rounded-full font-barlow text-c3 text-center hover:bg-c2 hover:text-c1" id="selectQuartier">
            </select>
        </div>
        <input type="text" class="w-3/5 h-12 bg-transparent text-c1 font-barlow text-xl p-5 text-center rounded-full focus:border focus:border-1 focus:border-c1 hover:bg-c2" placeholder="Rechercher un lieu" id="barreRecherche">
        <span class="iconify size-6 text-c3 w-32 p-3 h-12 cursor-pointer hover:text-c1 hover:bg-c2 rounded-full bg-c1 m-2 hover:border hover:border-1 hover:border-c1" data-icon="mdi:search" data-inline="false"></span>
    </div>

    <!-- Séparateur -->
    <div class="w-full flex justify-center items-center h-8">
        <hr class="w-3/4 bg-c1 h-1">
    </div>

    <!-- Boutons de filtres -->
    <div class="w-5/6 h-12 justify-center items-center space-x-5 my-4 flex-row md:hidden lg:flex">
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

    <div class="w-5/6 h-12 justify-center items-center space-x-5 my-4 md:flex-row hidden md:hidden">
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
    <div class="flex w-5/6 h-3/4 overflow-y flex-col space-y-10 overflow-x-hidden">
        <div class="md:grid-cols-5 sm:grid-col-1 grid gap-y-3 md:gap-y-5 content-center sm:content-start">
            <!-- Carte 1 -->
            <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Boréalis</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <!-- Carte 2 -->
            <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Amphithéâtre Cogéco</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
    
            <!-- Carte 3 -->
            <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/thompson3.jpg') }}" alt="Image de la Salle J.-Anthonio-Thompson" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Salle J.-A.-Thompson</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <!-- Carte 4 -->
            <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/bgl.jpg') }}" alt="Image de la maison de la culture" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Centre Raymond Lasnier</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>
            <!-- Carte 5 -->
            <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/ssj.jpg') }}" alt="Image du séminaire Saint-Joseph" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Musée Pierre-Boucher</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div>

            <!-- Carte 6 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Boréalis</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
            <!-- Carte 7 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Amphithéâtre Cogéco</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
    
            <!-- Carte 8 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/thompson3.jpg') }}" alt="Image de la Salle J.-Anthonio-Thompson" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Salle J.-A.-Thompson</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
            <!-- Carte 9 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/bgl.jpg') }}" alt="Image de la maison de la culture" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Centre Raymond Lasnier</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
            <!-- Carte 10 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/ssj.jpg') }}" alt="Image du séminaire Saint-Joseph" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Musée Pierre-Boucher</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->

            <!-- Carte 11 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Boréalis</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
            <!-- Carte 12 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Amphithéâtre Cogéco</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
    
            <!-- Carte 13 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/thompson3.jpg') }}" alt="Image de la Salle J.-Anthonio-Thompson" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Salle J.-A.-Thompson</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
            <!-- Carte 14 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/bgl.jpg') }}" alt="Image de la maison de la culture" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Centre Raymond Lasnier</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
            <!-- Carte 15 -->
            <!-- <div class="w-48 bg-c3 h-64 rounded-lg flex flex-col items-center p-3 hover:border-2 hover:border-c1 hover:border cursor-pointer carteLieu">
                <img src="{{ asset('images/Lieux/ssj.jpg') }}" alt="Image du séminaire Saint-Joseph" class="rounded-md h-40">
                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Musée Pierre-Boucher</h3>
                <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
            </div> -->
        </div>
    </div>
</div>

    <script src="{{asset('js/filtreRecherche.js')}}"></script>
    <script src="{{asset('js/JSrechercheTexte.js')}}"></script>

@endsection