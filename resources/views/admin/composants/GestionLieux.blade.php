<div id="afficherLieux">
    <div class="flex flex-col md:flex-row md:items-center md:gap-4">
        <!-- Filtre par ville -->
        <select name="ville" id="filtreVille" class="border-2 border-c1 p-1 sm:p-2 my-2 md:my-0 rounded-full w-full md:w-1/4 text-sm sm:text-base uppercase">
            <option value="">{{ __('toutesVilles') }}</option>
            @foreach ($villes as $ville)
            <option class="uppercase" value="{{ $ville->id }}">
                {{ $ville->nom }}
            </option>
            @endforeach
        </select>

        <!-- Filtre par quartier -->
        <select name="quartier" id="filtreQuartier" class="border-2 border-c1 p-1 sm:p-2 mb-2 md:mb-0 rounded-full w-full md:w-1/4 text-sm sm:text-base uppercase">
            <!-- Les quartiers seront remplis par JS ou passés en variable -->
        </select>

        <!-- Recherche et Toggle ensemble -->
        <div class="flex items-center gap-2 w-full justify-betwwen">
            <!-- Recherche par nom -->
            <input type="text" name="rechercheNomLieu" id="rechercheNomLieu" placeholder="{{ __('rechercheLieu') }}"
                class="border-2 border-c1 p-1 sm:p-2 rounded-full w-3/4 md:w-4/5 text-sm sm:text-base">

            <!-- Toggle Actif -->
            <div class="flex items-center gap-2 w-1/4 md:w-1/5">
                <span id="texteActifRechercheAdmin" class="text-lg font-semibold text-c1 uppercase">{{ __('Actif') }}</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input id="boutonFiltreActif" type="checkbox" name="actif" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-c3 rounded-full peer peer-checked:bg-c1 peer-checked:after:translate-x-full 
                    rtl:peer-checked:after:-translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] 
                    after:bg-c1 peer-checked:after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all">
                    </div>
                </label>
            </div>
        </div>
    </div>
    <span class="text-c1 uppercase font-semibold text-base sm:text-lg italic">{{__('selectionnerVilleAvant')}}</span>

    <button id="boutonAjouterLieu"
        class="flex items-center text-sm sm:text-xl border-c1 border-2 rounded-full  {{ App::getLocale() == 'en' ? 'sm:w-24 w-14' : 'sm:w-36 w-24' }}  text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-6 size-4 sm:mr-2 sm:ml-2 mr-2" data-icon="ion:add-outline"
            data-inline="false"></span>
        {{ __('ajouter') }}
    </button>
    <div id="pagination" class="flex justify-center gap-4 mt-4"></div>

    
       
        <div id="affichageDesLieux" class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-4">
       
        </div>
</div>

<div id="ajouterLieu" class="hidden">@include('admin.composants.AjouterLieuAdmin')</div>
<div id="modifierLieu" class="hidden">@include('admin.composants.ModifierLieuAdmin')</div>

@if (session('erreurAjouterLieu'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("demandes").classList.add("hidden");
        const boutonDemandes = document.getElementById("boutonDemandes");
        boutonDemandes.classList.remove("bg-c1", "text-c3");
        boutonDemandes.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

        const boutonLieu = document.getElementById("boutonLieu");
        boutonLieu.classList.add("bg-c1", "text-c3");
        boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

        document.getElementById("ajouterLieu").classList.remove("hidden");
        const lieux = document.getElementById("lieux");
        lieux.classList.remove("hidden");

        document.getElementById("afficherLieux").classList.add("hidden");
    });
</script>
@php
session()->forget('erreurAjouterLieu');
@endphp
@endif

@if (session('erreurModifierLieu'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("demandes").classList.add("hidden");
        const boutonDemandes = document.getElementById("boutonDemandes");
        boutonDemandes.classList.remove("bg-c1", "text-c3");
        boutonDemandes.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

        const boutonLieu = document.getElementById("boutonLieu");
        boutonLieu.classList.add("bg-c1", "text-c3");
        boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

        document.getElementById("modifierLieu").classList.remove("hidden");
        const lieux = document.getElementById("lieux");
        lieux.classList.remove("hidden");

        document.getElementById("afficherLieux").classList.add("hidden");

    
    });
</script>
@php
session()->forget('erreurModifierLieu');
@endphp
@endif