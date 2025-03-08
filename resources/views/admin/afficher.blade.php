@extends('layouts.app')

@section('title', 'Administration')

@section('contenu')

    <div class="flex flex-col w-full h-full">
        <div
            class="flex items-center sm:justify-start text-c1 justify-center md:space-x-2 space-x-4 sm:border-b-[3px]  border-c1 sm:h-10 h-6 w-full my-4">
            <button id="boutonDemandes" data-section="demandes"
                class="boutonMenu text-base px-2 py-2 sm:px-4 sm:py-0 sm:text-xl font-semibold bg-c1 text-c3 rounded-full sm:w-32 uppercase transition">
                <span class="iconify size-8 sm:hidden" data-icon="mingcute:document-line"></span>
                <span class="hidden sm:inline">{{ __('demandes') }}</span>
            </button>

            <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1 hidden sm:inline"></div>
            <button id="boutonVilles" data-section="villes"
                class="boutonMenu text-base px-2 py-2 sm:px-4 sm:py-0 sm:text-xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 uppercase transition">
                <span class="iconify size-8 sm:hidden" data-icon="solar:city-linear"></span>
                <span class="hidden sm:inline">{{ trans_choice('ville', 2) }}</span>
            </button>
            <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1 hidden sm:inline"></div>
            <button id="boutonLieu" data-section="lieux"
                class="boutonMenu text-base px-2 py-2 sm:px-4 sm:py-0 sm:text-xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 uppercase transition">
                <span class="iconify size-8 sm:hidden" data-icon="mingcute:location-3-line"></span>
                <span class="hidden sm:inline">{{ __('lieux') }}</span>
            </button>
            <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1 hidden sm:inline"></div>
        </div>
        {{-- //TODO Importer les composants selon le menu choisi --}}
        <div id="demandes" class="sectionMenu">COMPTE</div>
        <div id="villes" class="sectionMenu hidden">VILLES</div>
        <div id="lieux" class="sectionMenu hidden">@include('admin.composants.GestionLieux')</div>
    </div>

@endsection
<script src="{{ asset('js/usagers/GestionAffichageMenu.js') }}"></script>
<script src="{{ asset('js/admin/RechercheLieux.js') }}" defer></script>
<script src="{{ asset('js/usagers/Lieux/AfficherAjouterLieux.js') }}" defer></script>
<script src="{{ asset('js/usagers/Lieux/GestionAffichageSectionsLieux.js') }}" defer></script>
<script src="{{ asset('js/usagers/Lieux/AfficherModifierLieu.js') }}" defer></script>
<script src="{{ asset('js/usagers/Lieux/SupprimerLieu.js') }}" defer></script>
<script src="{{ asset('js/usagers/Lieux/ChangerEtatLieu.js') }}"></script>

@if (session('formulaireAjouterLieuValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const succesMessage = "{{ __('succesAjout') }}";
            document.getElementById('lieux').classList.remove('hidden');
            document.getElementById('demandes').classList.add('hidden');
            document.getElementById('villes').classList.add('hidden');

            const boutonLieu = document.getElementById('boutonLieu');
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonDemandes = document.getElementById('boutonDemandes');
            boutonDemandes.classList.remove("bg-c1", "text-c3");
            boutonDemandes.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: "success",
                title: succesMessage,
                customClass: {
                    title: "text-c1 font-bold",
                    timerProgressBar: "color-c1",
                }
            });
        });
    </script>
    @php
        session()->forget('formulaireAjouterLieuValide');
    @endphp
@endif

@if (session('formulaireModifierLieuValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const succesMessage = "{{ __('succesModifier') }}";
            document.getElementById('lieux').classList.remove('hidden');
            document.getElementById('demandes').classList.add('hidden');
            document.getElementById('villes').classList.add('hidden');

            const boutonLieu = document.getElementById('boutonLieu');
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonDemandes = document.getElementById('boutonDemandes');
            boutonDemandes.classList.remove("bg-c1", "text-c3");
            boutonDemandes.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: "success",
                title: succesMessage,
                customClass: {
                    title: "text-c1 font-bold",
                    timerProgressBar: "color-c1",
                }
            });
        });
    </script>
    @php
        session()->forget('formulaireModifierLieuValide');
    @endphp
@endif

@if (session('formulaireModifierLieuStatutValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const succesMessage = "{{ __('succesModifier') }}";
            document.getElementById('lieux').classList.remove('hidden');
            document.getElementById('demandes').classList.add('hidden');
            document.getElementById('villes').classList.add('hidden');

            const boutonLieux = document.getElementById('boutonLieu');
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonDemandes = document.getElementById('boutonDemandes');
            boutonDemandes.classList.remove("bg-c1", "text-c3");
            boutonDemandes.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: "success",
                title: succesMessage,
                customClass: {
                    title: "text-c1 font-bold",
                    timerProgressBar: "color-c1",
                }
            });
        });
    </script>
    @php
        session()->forget('formulaireModifierLieuStatutValide');
    @endphp
@endif
