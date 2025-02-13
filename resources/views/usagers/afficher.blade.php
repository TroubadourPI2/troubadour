@extends('layouts.app')

@section('title', 'Compte')

@section('contenu')
    {{-- //TODO importer la navbar et le footer --}}
    <div class="flex flex-col w-full h-full ">
        <div class="flex items-center sm:justify-start text-c1 justify-center md:space-x-2 space-x-4 sm:border-b-[3px] border-b-2 border-c1 sm:h-10 h-6 w-full ">
            <button class="text-sm sm:text-2xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 sm:rounded-full sm:w-32">COMPTE</button>
            <div class="md:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
            <button class="text-sm sm:text-2xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 sm:rounded-full sm:w-32">LIEUX</button>
            <div class="md:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
            <button class="text-sm sm:text-2xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 sm:rounded-full sm:w-32">ACTIVITÉS</button>
        </div>
        {{-- //TODO Importer les composants selon le menu choisi --}} 
        <div>@include('usagers.composants.afficherLieux')</div>
    </div>
@endsection

<script src="{{ asset('js/usagers/afficherLieux.js') }}"></script>

