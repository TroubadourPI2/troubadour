<button
    class="flex items-center text-sm md:text-xl border-c1 border-2 rounded-full md:w-36 w-[80px] text-c1 font-medium my-3">
    <span class="iconify text-c1 md:size-8 size-4 md:mr-2" data-icon="ion:add" data-inline="false"></span>
    AJOUTER
</button>
{{-- //TODO Afficher avec la BD si pas de lieux afficher "Aucun lieu d'enregistrer" --}}
{{-- //* Afficher seulement en carte pour mobile --}}
<div class="px-[15vw] text-c1 items-center align-middle flex flex-row cursor-pointer group [perspective:1000px]">
    <div id="carteLieuxMobile"
        class="relative max-w-sm w-full h-80 rounded-[3vw] shadow-lg transition-transform duration-500 [transform-style:preserve-3d] ">
        <div id="carteLieuxMobileDevant"
            class="absolute inset-0 bg-c3 overflow-hidden shadow-lg rounded-[3vw] [backface-visibility:hidden]">
            <img class="w-full h-[63vw] object-cover" src="{{ asset('Images/lieux/borealis.jpg') }}" alt="Boréalis">
            <div class="px-6 py-4 flex justify-center items-center">
                <div class="font-semibold mb-2 uppercase ">Musée Boréalis</div>
            </div>
        </div>
        <div id="carteLieuxMobileDerriere"
            class="absolute inset-0 bg-c3 overflow-hidden shadow-lg rounded-[3vw] [transform:rotateY(180deg)] [backface-visibility:hidden] font-semibold">
            <div class="px-6 py-4 flex flex-col justify-between h-full">
                <div class="mb-2">
                    <div class="uppercase underline">Description</div>
                    <div>Musée du Patrimoine retraçant l'histoire de l'industrie locale du papier et proposant un
                        atelier de fabrication de papier.</div>
                </div>
                <div>
                    <div class="uppercase underline">Coordonnées</div>
                    <div class="flex flex-col">
                        <span>200 Av. des Draveurs</span>
                        <span>Trois-Rivières, QC, G9A 0B6</span>
                        <span><a href="http://www.borealis3r.ca" class="text-blue-500 underline"
                                target="_blank">www.borealis3r.ca</a></span>
                        <span>(819) 372-4633</span>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mb-2">
                    <button><span class="iconify text-c1 size-5" data-icon="ion:trash-outline"
                            data-inline="false"></span></button>
                    <button><span class="iconify text-c1 size-5" data-icon="ep:edit"
                            data-inline="false"></span></button>
                </div>
            </div>
        </div>
    </div>
</div>

