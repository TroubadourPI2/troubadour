<div class="flex w-full h-full flex-col" id="afficherQuartiers">
    
    <button id="boutonAjouterQuartier" class="rounded-full w-fit items-center uppercase text-lg flex leading-tight border-c1 border-2 text-c1 bg-c2 hover:bg-c3 pr-4">
        <span class="iconify text-c1 sm:size-8 size-4 sm:ml-2 font-semibold" data-icon="ion:add"
        data-inline="false"></span>
        {{ __('ajouter') }}
    </button>
    <div class="grid lg:grid-cols-4 md:grid-cols-2" id="affichageQuartiers">

    </div>

</div>  

<div id="ajouterQuartier" class="hidden">@include('admin.composants.AjouterQuartier')</div>
<div id="modifierQuartier" class="hidden">@include('admin.composants.ModifierQuartier')</div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("boutonAjouterQuartier").addEventListener("click", function () {
                let affichage = document.getElementById("afficherQuartiers"); // Replace with the actual ID
                let ajout = document.getElementById("ajouterQuartier"); // Replace with the actual ID
                affichage.classList.add("hidden"); // Hide first div
                ajout.classList.remove("hidden"); // Show second div
            });
            document.getElementById("boutonModifierQuartier").addEventListener("click", function () {
                let affichage = document.getElementById("afficherQuartiers"); // Replace with the actual ID
                let ajout = document.getElementById("modifierQuartier"); // Replace with the actual ID
                affichage.classList.add("hidden"); // Hide first div
                ajout.classList.remove("hidden"); // Show second div
            });
        });
    </script>


