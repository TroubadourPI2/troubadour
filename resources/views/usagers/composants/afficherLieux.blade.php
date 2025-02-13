<button
    class="flex items-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-36 w-[80px] text-c1 font-semibold my-3">
    <span class="iconify text-c1 sm:size-8 size-4 sm:mr-2 font-semibold" data-icon="ion:add" data-inline="false"></span>
    AJOUTER
</button>
{{-- //TODO Afficher avec la BD si pas de lieux afficher "Aucun lieu d'enregistrer" --}}

{{-- //* Affichage mobile < 640px --}}
<!-- Carte lieu pour mobile -->
<div class="sm:hidden flex flex-col items-center text-c1 rounded-lg shadow-sm">
    <div id="carteLieuxMobile"
        class="relative w-full min-h-[36vh] h-auto rounded-lg shadow-lg transition-transform duration-500 [transform-style:preserve-3d]">

        <div id="carteLieuxMobileDevant" class="absolute bg-c3 inset-0 rounded-lg shadow-lg [backface-visibility:hidden]">
            <img class="object-cover w-full h-72 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                src="{{ asset('Images/lieux/borealis.jpg') }}" alt="Musée Boréalis">
            <h5 class="mb-2 text-2xl font-semibold uppercase p-2 text-center">Musée Boréalis</h5>
        </div>

        <div id="carteLieuxMobileDerriere"
            class="absolute inset-0 bg-c3 rounded-lg shadow-lg [transform:rotateY(180deg)] [backface-visibility:hidden] ">
            <div class="p-4 flex flex-col justify-between h-full">
                <div class="mb-2">
                    <div class="uppercase underline text-lg font-semibold">Description</div>
                    <div>Musée du Patrimoine retraçant l'histoire de l'industrie locale du papier et proposant un
                        atelier de fabrication de papier.</div>
                </div>
                <div>
                    <div class="uppercase underline text-lg font-semibold">Coordonnées</div>
                    <div class="flex flex-col">
                        <span>200 Av. des Draveurs</span>
                        <span>Trois-Rivières, QC, G9A 0B6</span>
                        <span>www.borealis3r.ca</span>
                        <span>(819) 372-4633</span>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-3">
                    <button><span class="iconify text-ci size-6" data-icon="ion:trash-outline"
                            data-inline="false"></span></button>
                    <button><span class="iconify text-ci size-6" data-icon="ep:edit"
                            data-inline="false"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Carte lieu pour web/tablette  -->
<div
    class="flex flex-col sm:flex-row text-c1 rounded-lg shadow-sm bg-white w-full max-w-4xl mx-auto my-4 hidden sm:flex h-[500px]"> <!-- Ajout d'une hauteur maximale -->
    <div class="w-full sm:w-1/2 rounded-l-lg h-full">
        <img class="object-cover w-full h-full rounded-l-lg" src="{{ asset('Images/lieux/borealis.jpg') }}"
            alt="Musée Boréalis">
    </div>

    <div class="w-full sm:w-1/2 p-4 flex flex-col h-full gap-y-[30px]"> 
        <h5 class="text-xl sm:text-3xl font-semibold uppercase mb-2">Musée Boréalis</h5>

        <div>
            <div class="uppercase underline text-2xl font-semibold">Description</div>
            <div class="text-xl">Musée du Patrimoine retraçant l'histoire de l'industrie locale du papier et proposant
                un atelier de fabrication de papier.</div>
        </div>

        <div>
            <div class="uppercase underline font-semibold text-2xl">Coordonnées</div>
            <div class="flex flex-col text-xl">
                <span>200 Av. des Draveurs</span>
                <span>Trois-Rivières, QC, G9A 0B6</span>
                <span>www.borealis3r.ca</span>
                <span>(819) 372-4633</span>
            </div>
        </div>

        <div class="flex justify-end space-x-3 mt-auto">
            <button><span class="iconify text-ci size-8" data-icon="ion:trash-outline"
                    data-inline="false"></span></button>
            <button><span class="iconify text-ci size-8" data-icon="ep:edit" data-inline="false"></span></button>
        </div>
    </div>
</div>



