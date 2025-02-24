@extends('layouts.app')

@section('title', 'Compte')

@section('contenu')

    <div class="flex flex-col w-full h-full ">

        <div
            class="flex items-center sm:justify-start text-c1 justify-center md:space-x-2 space-x-4 sm:border-b-[3px] border-b-2 border-c1 sm:h-10 h-6 w-full my-3">
            <button id="boutonCompte" data-section="compte"
                class="BoutonMenuCompte text-base px-4 sm:text-2xl font-semibold bg-c1 text-c3 rounded-full sm:w-32 mb-1 uppercase transition">Compte</button>
            @role(['Gestionnaire'])
                <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
                <button id="boutonLieu" data-section="lieux"
                    class="BoutonMenuCompte text-base px-4 sm:text-2xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">Lieux</button>
                <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
                <button id="boutonActivites" data-section="activites"
                    class="BoutonMenuCompte text-base px-4 sm:text-2xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">Activités</button>
            @endrole
        </div>
        {{-- //TODO Importer les composants selon le menu choisi --}}
        <div id="compte" class="SectionMenu">COMPTE</div>
        <div id="lieux" class="SectionMenu hidden">@include('usagers.composants.AfficherLieux')</div>
        <div id="activites" class="SectionMenu hidden">@include('usagers.composants.afficherActivites')</div>

    </div>
@endsection

<script src="{{ asset('js/usagers/GestionAffichageMenu.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/AfficherLieux.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/AfficherAjouterLieux.js') }}"></script>
@if (session('formulaireValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('lieux').classList.remove('hidden');
            document.getElementById('compte').classList.add('hidden');
            document.getElementById('activites').classList.add('hidden');

            const boutonLieu = document.getElementById('boutonLieu');
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonCompte = document.getElementById('boutonCompte');
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

        });
    </script>
    @php
        session()->forget('formulaireValide');
    @endphp
@endif
