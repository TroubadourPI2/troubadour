<button
    class="flex items-center text-sm md:text-xl border-c1 border-2 rounded-full md:w-36 w-[80px] text-c1 font-medium my-3">
    <span class="iconify text-c1 md:size-8 size-4 md:mr-2" data-icon="ion:add" data-inline="false"></span>
    AJOUTER
</button>
{{-- //TODO Afficher avec la BD si pas de lieux afficher "Aucun lieu d'enregistrer" --}}
{{-- //* Afficher seulement en carte pour mobile --}}
<div class="px-[15vw] text-c1 items-center align-middle flex flex-row">
    <div class="max-w-sm w-full rounded-[3vw] bg-c3 overflow-hidden shadow-lg h-80"> <!-- Hauteur de la carte augmentée -->
        <img class="w-full h-[63vw] object-cover" src="{{ asset('Images/lieux/borealis.jpg') }}" alt="Boréalis"> <!-- Hauteur de l'image augmentée -->
        <div class="px-6 py-4 flex flex-row justify-between items-center"> <!-- Espacement réduit -->
            <div class="font-semibold mb-2">MUSÉE BORÉALIS</div>
            <div class="flex space-x-3 mb-2">
                <button><span class="iconify text-c1 size-5" data-icon="ion:trash-outline" data-inline="false"></span></button>
                <button><span class="iconify text-c1 size-5" data-icon="ep:edit" data-inline="false"></span></button>
            </div>
        </div>
    </div>
</div>



