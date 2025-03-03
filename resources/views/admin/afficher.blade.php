@extends('layouts.app')

@section('title', 'Administration')

@section('contenu')

    <div class="flex flex-col w-full h-full ">
        <div
            class="flex items-center sm:justify-start text-c1 justify-center md:space-x-2 space-x-4 sm:border-b-[3px] border-b-2 border-c1 sm:h-10 h-6 w-full my-3">
            <button id="boutonDemandes" data-section="demandes"
                class="boutonMenu text-base px-4 sm:text-xl font-semibold bg-c1 text-c3 rounded-full sm:w-32 mb-1 uppercase transition">{{ __('demandes') }}</button>
            <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
            <button id="boutonLieu" data-section="villes"
                class="boutonMenu text-base px-4 sm:text-xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">{{ trans_choice('ville', 2) }}</button>
            <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
            <button id="boutonLieu" data-section="lieux"
                class="boutonMenu text-base px-4 sm:text-xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">{{ __('lieux') }}</button>
            <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
            <button id="boutonActivites" data-section="activites"
                class="boutonMenu text-base px-4 sm:text-xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">{{ __('activites') }}</button>
        </div>
        {{-- //TODO Importer les composants selon le menu choisi --}}
        <div id="demandes" class="sectionMenu">COMPTE</div>
        <div id="villes" class="sectionMenu hidden">VILLES</div>
        <div id="lieux" class="sectionMenu hidden">LIEUX</div>
        <div id="activites" class="sectionMenu hidden">ACTIVITES</div>
    </div>

@endsection
<script src="{{ asset('js/usagers/GestionAffichageMenu.js') }}"></script>
