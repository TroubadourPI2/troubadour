<button id="boutonRetourAfficherLieux"
    class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
    <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2" data-icon="ion:arrow-back-outline"
        data-inline="false"></span>
    Retour
</button>

<form class="mt-2 text-c1" action="#" method="POST">
    <div class="font-barlow text-c1 font-semibold ">
        <h2 class="uppercase underline text-center text-2xl">Ajouter un lieu</h2>
        <div class="font-barlow text-c1 font-semibold uppercase">
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6 text-base">
                <div class="sm:col-span-4">
                    <label for="nomLieu" class="block">Nom</label>
                    <input type="text" name="nomLieu" id="nomLieu" class="block w-full rounded-lg p-1">
                </div>

                <div class="sm:col-span-4">
                    <label for="descriptionLieu" class="block">Description</label>
                    <textarea rows="3" name="descriptionLieu" id="nomLieu" class="block w-full rounded-lg p-1"></textarea>
                </div>

                <div class="sm:col-span-4">
                    <label for="photoLieu" class="block">Photo du lieu</label>
                    <input id="photoLieu" name="photoLieu" type="file" class="w-full rounded-lg bg-c3 p-2"
                        accept=".png,.jpg">
                </div>

                <div class="sm:col-span-4">
                    <label for="nomLieu" class="block">Nom</label>
                    <input type="text" name="nomLieu" id="nomLieu" class="block w-full rounded-lg p-1">
                </div>

                <div class="sm:col-span-4">
                    <label for="nomLieu" class="block">Nom</label>
                    <input type="text" name="nomLieu" id="nomLieu" class="block w-full rounded-lg p-1">
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row justify-center">
        <button id="boutonRetourAfficherLieux"
            class="text-c1 py-2 px-6 font-barlow font-semibold text-xl rounded-full w-75 mt-2 mr-2 hover:bg-c3 transition uppercase">
            Annuler
        </button>
        <button type="submit"
            class="bg-c1 text-c3 py-2 px-6 font-barlow font-semibold text-xl rounded-full w-75 mt-2 uppercase">
            Ajouter
        </button>
    </div>
</form>

