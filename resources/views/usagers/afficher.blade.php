@extends('layouts.app')

@section('title', 'Compte')

@section('contenu')
    {{-- //TODO importer la navbar et le footer --}}
    <div class="flex w-full h-full ">
        <div class="flex items-center md:justify-start justify-center md:space-x-2 space-x-4 md:border-b-[3px] border-b-2 border-c1 md:h-10 h-6 w-full hover:">
            <button class="font-barlow text-sm md:text-2xl text-c1 font-semibold hover:bg-c1 hover:text-c3">COMPTE</button>
            <div class="md:h-6 h-4 md:border-l-[3px] border-l-2 border-c1"></div>
            <button class="font-barlow text-sm md:text-2xl text-c1 font-semibold">LIEUX</button>
            <div class="md:h-6 h-4 md:border-l-[3px] border-l-2 border-c1"></div>
            <button class="font-barlow text-sm md:text-2xl text-c1 font-semibold">ACTIVITÉS</button>
        </div>
        {{-- //TODO Importer les composants selon le menu choisi --}}
    </div>
@endsection

