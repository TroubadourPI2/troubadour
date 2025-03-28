@extends('layouts.app')

@section('title', __('compte'))

@section('contenu')

    <div class="flex flex-col w-full h-full">
        <div
            class="flex items-center sm:justify-start text-c1 justify-center md:space-x-2 space-x-4 sm:border-b-[3px] border-b-2 border-c1 sm:h-10 h-6 w-full my-3">
            <button id="boutonCompte" data-section="compte"
                class="boutonMenu text-base px-4 sm:text-xl font-semibold bg-c1 text-c3 rounded-full sm:w-32 mb-1 uppercase transition">{{ __('compte') }}</button>
            @role(['Utilisateur'])
                <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
                <button id="boutonFavoris" data-section="favoris"
                    class="boutonMenu text-base px-4 sm:text-xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">{{ __('favoris') }}</button>
            @endrole
            @role(['Gestionnaire'])
                <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
                <button id="boutonLieu" data-section="lieux"
                    class="boutonMenu text-base px-4 sm:text-xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">{{ __('lieux') }}</button>
                <div class="sm:h-6 h-4 sm:border-l-[3px] border-l-2 border-c1"></div>
                <button id="boutonActivites" data-section="activites"
                    class="boutonMenu text-base px-4 sm:text-xl font-semibold sm:hover:bg-c1 sm:hover:text-c3 rounded-full sm:w-32 mb-1 uppercase transition">{{ __('activites') }}</button>
            @endrole
        </div>

        <div id="compte" class="sectionMenu">@include('usagers.composants.AfficherCompte')</div>
        <div id="favoris" class="sectionMenu hidden">@include('usagers.composants.AfficherFavoris')</div>
        <div id="lieux" class="sectionMenu hidden">@include('usagers.composants.afficherLieux')</div>
        <div id="activites" class="sectionMenu hidden">@include('usagers.composants.AfficherActivites')</div>
    </div>

@endsection
<script src="{{ asset('js/usagers/GestionAffichageMenu.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/AfficherAjouterLieux.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/GestionAffichageSectionsLieux.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/AfficherModifierLieu.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/SupprimerLieu.js') }}"></script>
<script src="{{ asset('js/usagers/Lieux/ChangerEtatLieu.js') }}"></script>

@if (session('formulaireAjouterLieuValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const succesMessage = "{{ __('succesAjout') }}";
            document.getElementById('lieux').classList.remove('hidden');
            document.getElementById('compte').classList.add('hidden');
            document.getElementById('activites').classList.add('hidden');

            const boutonLieu = document.getElementById('boutonLieu');
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonCompte = document.getElementById('boutonCompte');
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

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
            document.getElementById('compte').classList.add('hidden');
            document.getElementById('activites').classList.add('hidden');

            const boutonLieu = document.getElementById('boutonLieu');
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonCompte = document.getElementById('boutonCompte');
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

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

@if (session('formulaireModifierUValide'))
    <script>
        const succesMessage = "{{ __('succesModifier') }}";
        console.log("to")

        function ModifUsager() {
            window.onload = function() {
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
                }).then(() => {
                    window.location.reload();
                });
            };
        }
        ModifUsager()
    </script>
    @php
        session()->forget('formulaireModifierUValide');
        session()->forget('erreurModifierUsager');
    @endphp
@endif
@if (session('erreurModifierUsager'))
    @php
        session()->forget('erreurModifierUsager');
    @endphp
@endif
@if (session('formulaireAjoutActiviteValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const succesMessage = "{{ __('succesAjout') }}";
            document.getElementById('lieux').classList.add('hidden');
            document.getElementById('compte').classList.add('hidden');
            document.getElementById('activites').classList.remove('hidden');

            const boutonActivites = document.getElementById('boutonActivites');
            boutonActivites.classList.add("bg-c1", "text-c3");
            boutonActivites.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonCompte = document.getElementById('boutonCompte');
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

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
        session()->forget('formulaireAjoutActiviteValide');
    @endphp
@endif

@if (session('formulaireModifierActiviteValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const succesMessage = "{{ __('succesModifier') }}";
            document.getElementById('lieux').classList.add('hidden');
            document.getElementById('compte').classList.add('hidden');
            document.getElementById('activites').classList.remove('hidden');

            const boutonActivites = document.getElementById('boutonActivites');
            boutonActivites.classList.add("bg-c1", "text-c3");
            boutonActivites.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonCompte = document.getElementById('boutonCompte');
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

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
        session()->forget('formulaireModifierActiviteValide');
    @endphp
@endif

@if (session('formulaireModifierActiviteStatutValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const succesMessage = "{{ __('successModifierStatutActivite') }}";
            document.getElementById('lieux').classList.add('hidden');
            document.getElementById('compte').classList.add('hidden');
            document.getElementById('activites').classList.remove('hidden');

            const boutonActivites = document.getElementById('boutonActivites');
            boutonActivites.classList.add("bg-c1", "text-c3");
            boutonActivites.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonCompte = document.getElementById('boutonCompte');
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

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
        session()->forget('formulaireModifierActiviteStatutValide');
    @endphp
@endif

@if (session('formulaireModifierLieuStatutValide') === 'true')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const succesMessage = "{{ __('succesModifier') }}";
            document.getElementById('lieux').classList.remove('hidden');
            document.getElementById('compte').classList.add('hidden');
            document.getElementById('activites').classList.add('hidden');

            const boutonLieu = document.getElementById('boutonLieu');
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonCompte = document.getElementById('boutonCompte');
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

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

@if (session('favoriSupprime'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('favoris').classList.remove('hidden');
            document.getElementById('compte').classList.add('hidden');
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: "success",
                title: "{{ session('favoriSupprime') }}",
                customClass: {
                    title: "text-c1 font-bold",
                    timerProgressBar: "color-c1",
                }
            });
        });
    </script>
    @php
        session()->forget('favoriSupprime');
    @endphp
@endif
