@extends('layouts.app')

@section('title', 'Accueil')

@section('header')
    <nav class="flex bg-c2 h-24 w-full justify-between items-center p-5">
        <div class="flex justify-center items-center space-x-4">
            <img src="{{ asset('images/logos/logoC1.svg') }}" alt="Logo de Troubadour" width="70px">
            <h3 class="text-c1 font-barlow text-2xl font-bold">TROUBADOUR</h3>
        </div>
        <div class="flex justify-center items-center space-x-2">
            <h3 class="text-c1 font-barlow text-xl font-bold uppercase">Attraits</h3>
            <h3 class="text-c1 font-barlow text-xl">|</h3>
            <h3 class="text-c1 font-barlow text-xl font-bold uppercase">À propos</h3>
            <h3 class="text-c1 font-barlow text-xl">|</h3>
            <h3 class="text-c1 font-barlow text-xl font-bold uppercase">Compte</h3>
            <h3 class="text-c1 font-barlow text-xl">|</h3>
            <span class="iconify size-6 text-c1 cursor-pointer" data-icon="mdi:search" data-inline="false" ></span>
        </div>
    </nav>
    @endsection
    @section('contenu')
    
    <div class="bg-c2 flex h-9/12 w-full flex-col space-y-5 flex items-center">
        <h2 class="w-full text-center text-c1 font-bold text-2xl font-barlow">Recherche</h2>
        <div class="flex w-5/6 bg-c3 rounded-full items-center">
            <div class="flex bg-c1 rounded-full m-2 flex flex-row w-96 items-center px-5">
                <select class="flex bg-c1 justify-center items-center h-12 w-3/4 rounded-full font-barlow text-c3 text-center">
                    <option value="default" disabled selected>Choisir la ville</option>
                    <option value="TR">Trois-Rivières</option>
                    <option value="QC">Québec</option>
                    <span class="font-barlow text-c2 text-lg">Ville</span>
                </select>
                <span class="rounded-full my-2 flex items-center justify-center h-full w-1/6 font-barlow text-c3">|</span>
                <select class="flex bg-c1 justify-center items-center h-12 w-3/4 rounded-full font-barlow text-c3 text-center">
                    <option value="default" disabled selected class="px-2">Choisir le quartier</option>
                    <option value="Cap">Cap-de-la-madeleine</option>
                    <option value="TRO">Trois-Rivières Ouest</option>
                    <option value="PDL">Pointe du lac</option>
                    <option value="SM">Sainte-Marthe</option>
                    <option value="SLF">Saint-Louis-De-France</option>
                </select>
            </div>
            <input type="text" class="w-3/5 h-5/6 bg-transparent text-c1 font-barlow text-xl pl-5 text-center" placeholder="Rechercher un lieu, un événement, un artiste...">
            <div class="flex bg-c1 rounded-full m-2 flex flex-row w-96 items-center px-5 h-12 justify-center items-center cursor-pointer">
                <span class="iconify size-6 text-c3" data-icon="mdi:search" data-inline="false" ></span>
            </div>
        </div>
        <div class="w-full flex justify-center items-center h-12">
            <hr class="w-3/4 bg-c1 h-1">
        </div>
        <div class="flex w-5/6 h-12 justify-center items-center space-x-5">
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1 ">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Prix</h3>
            </div>
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1 ">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Type</h3>
            </div>
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1 ">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Distance</h3>
            </div>
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1 ">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Organisme</h3>
            </div>
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1 ">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Avis</h3>
            </div>
        
        </div>
    </div>

@endsection