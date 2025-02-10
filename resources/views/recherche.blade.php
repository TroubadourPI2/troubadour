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
    
    <div class="bg-c2 flex h-64 w-full flex-col space-y-5">
        <h2 class="w-full text-center text-c1 font-bold text-2xl font-barlow">Recherche</h2>
        <div class="flex w-lg bg-c3 rounded-full items-center">
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
                <!-- <input type="text" class="w-full h-full bg-transparent text-c1 font-barlow text-xl pl-5" placeholder="Rechercher un lieu, un événement, un artiste..."> -->
            </div>
        </div>
    </div>

@endsection