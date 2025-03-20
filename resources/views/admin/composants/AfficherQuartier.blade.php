<div class="flex w-full h-full flex-col" id="afficherQuartiers">

<button id="boutonAjouterQuartier"
    class="rounded-full flex items-center justify-center uppercase text-lg leading-tight border-c1 border-2 text-c1 bg-c2 hover:bg-c3 pr-4 w-full sm:w-fit px-4 py-2">
    <span class="iconify text-c1 sm:size-8 size-4 sm:ml-2 font-semibold" data-icon="ion:add"
        data-inline="false"></span>
    {{ __('ajouter') }}
</button>
    <div class="grid lg:grid-cols-4 sm:grid-cols-2" id="affichageQuartiers"></div>

</div>

<div id="ajouterQuartier" class="hidden">@include('admin.composants.AjouterQuartier')</div>
<div id="modifierQuartier" class="hidden">@include('admin.composants.ModifierQuartier')</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("boutonAjouterQuartier").addEventListener("click", function() {
            let affichage = document.getElementById("afficherQuartiers");
            let ajout = document.getElementById("ajouterQuartier");
            affichage.classList.add("hidden");
            ajout.classList.remove("hidden");
        });

        document.getElementById("afficherQuartiers").addEventListener("click", function(event) {
            if (event.target.closest(".boutonModifierQuartier")) {
                let affichage = document.getElementById("afficherQuartiers");
                let ajout = document.getElementById("modifierQuartier");
                affichage.classList.add("hidden");
                ajout.classList.remove("hidden");
            }
        });

    });
</script>
