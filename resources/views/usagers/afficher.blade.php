@extends('layouts.app')

@section('title', 'Compte')

@section('contenu')
{{-- //TODO importer la navbar et le footer --}}
<div class="flex flex-col w-full h-full ">
    <div class="flex items-center sm:justify-start text-c1 justify-center md:space-x-2 space-x-4 sm:border-b-[3px] border-b-2 border-c1 sm:h-10 h-6 w-full my-3">
        <button id="boutonCompte" data-section="compte" class="BoutonMenuCompte text-base px-4 sm:text-2xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">Compte</button>
        <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
        <button id="boutonLieu" data-section="lieux" class="BoutonMenuCompte text-base px-4 sm:text-2xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">Lieux</button>
        <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
        <button id="boutonActivites" data-section="activites" class="BoutonMenuCompte text-base px-4 sm:text-2xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">Activités</button>
    </div>
    {{-- //TODO Importer les composants selon le menu choisi --}}
    <div id="compte" class="SectionMenu">COMPTE</div>
    <div id="lieux" class="SectionMenu hidden">@include('usagers.composants.AfficherLieux')</div>
    <div id="activites" class="SectionMenu hidden">ACTIVITÉS</div>
</div>
@endsection


<script src="{{ asset('js/usagers/GestionAffichageMenu.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/AfficherLieux.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/AfficherAjouterLieux.js') }}"></script>

@if(session('erreurAjouterLieu'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const boutonCompte = document.getElementById('boutonCompte');
        const compte = document.getElementById('compte');
        compte.classList.add("hidden");
        boutonCompte.classList.remove("bg-c1", "text-c3");
        boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");
        const boutonLieu = document.getElementById('boutonLieu');
        boutonLieu.classList.add("bg-c1", "text-c3");
        boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");
        const sectionAjouterLieu = document.getElementById('ajouterLieu');
        sectionAjouterLieu.classList.remove("hidden");
        sectionAjouterLieu.classList.add("flex");
        const sectionAfficherLieux = document.getElementById('afficherLieux');
        sectionAfficherLieux.classList.add("hidden");
        
    });
</script>
@php
session()->forget('erreurAjouterLieu');
@endphp
@endif