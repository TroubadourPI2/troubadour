<div class="flex w-full h-full flex-col" id="ajouterQuartier">
    <button id="boutonRetourQuartier"
        class="rounded-full w-fit items-center uppercase text-lg flex leading-tight border-c1 border-2 my-4 text-c1 bg-c2 hover:bg-c3 pr-4">
        <span class="iconify text-c1 sm:size-8 size-4 sm:ml-2 font-semibold" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
        {{ __('retour') }}
    </button>

    <form action="{{ route('ajouter.quartier') }}" id="formulaireQuartierAjout" method="post">
        @csrf

        <div class="flex flex-col gap-5 sm:flex-row">
            <input name="nom" placeholder="nom du quartier" id="nomQuartierAjout"
                class="block w-1/2 rounded-lg p-1 sm:p-2 font-medium">

            <select name="actif" id="actifQuartierAjout" class="block w-fit rounded-lg p-1 sm:p-2 font-medium">
                <option value="1"> {{ __('actif') }}</option>
                <option value="0"> {{ __('inactif') }}</option>
            </select>

            <select name="ville_id" id="selectVilleAjoutQuartier" class="block w-fit rounded-lg p-1 sm:p-2 font-medium">
                <option></option>
            </select>
        </div>

        <div class="my-4">
            <button type="submit"
                class="rounded-full w-fit items-center uppercase text-lg flex leading-tight border-c1 border-2 text-c1 bg-c2 hover:bg-c3 px-4">
                {{ __('ajouter') }} </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("boutonRetourQuartier").addEventListener("click", function() {
            let affichage = document.getElementById("afficherQuartiers");
            let ajout = document.getElementById("ajouterQuartier");
            ajout.classList.add("hidden");
            affichage.classList.remove("hidden");
        });
    });
</script>
