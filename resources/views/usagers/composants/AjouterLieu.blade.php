<button id="boutonRetourAfficherLieux"
    class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
    <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
        data-inline="false"></span>
    Retour
</button>

<form class="mt-2 text-c1" action="#" method="POST">
    <div class="font-barlow text-c1 font-semibold mb-3">
        <h2 class="uppercase underline text-center text-xl sm:text-2xl">Ajouter un lieu</h2>
        <div class="font-barlow text-c1 font-semibold uppercase mt-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg ">
                <div class="sm:col-span-1">
                    <label for="nomLieu" class="block">Nom</label>
                    <input type="text" name="nomLieu" id="nomLieu" class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                </div>

                <div class="sm:col-span-1">
                    <label for="descriptionLieu" class="block">Description</label>
                    <textarea rows="3" name="descriptionLieu" id="descriptionLieu" class="block w-full rounded-lg font-medium p-2"></textarea>
                </div>

                <div class="sm:col-span-1">
                    <label for="numTelephoneLieu" class="block">Numéro de téléphone</label>
                    <input type="text" name="numTelephoneLieu" id="numTelephoneLieu" class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                </div>

                <div class="sm:col-span-1">
                    <label for="siteWebLieu" class="block">Site web</label>
                    <input type="text" name="siteWebLieu" id="siteWebLieu" class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                </div>

                <div class="sm:col-span-1">
                    <label for="numCiviqueLieu" class="block">Numéro civique</label>
                    <input type="text" name="numCiviqueLieu" id="numCiviqueLieu" class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                </div>

                <div class="sm:col-span-1">
                    <label for="photoLieu" class="block">Photo du lieu</label>
                    <input id="photoLieu" name="photoLieu" type="file" class="w-full rounded-lg bg-c3 p-2 font-medium"
                        accept=".png,.jpg">
                </div>

                <div class="sm:col-span-1">
                    <label for="rueLieu" class="block">Rue</label>
                    <input type="text" name="rueLieu" id="rueLieu" class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                </div>

                <div class="sm:col-span-1">
                    <label for="codePostalLieu" class="block">Code postal</label>
                    <input type="text" name="codePostalLieu" id="codePostalLieu" class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                </div>

                <div class="sm:col-span-1">
                    <label for="villeLieu" class="block">Ville</label>
                    <select type="text" name="villeLieu" id="villeLieu" class="block w-full rounded-lg p-2 sm:p-3 bg-c3">
                        <option></option>
                    </select>
                </div>

                <div class="sm:col-span-1">
                    <label for="quartierLieu" class="block">Quartier</label>
                    <select type="text" name="quartierLieu" id="quartierLieu" class="block w-full rounded-lg p-2 sm:p-3 bg-c3" disabled>
                        <option></option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row justify-center">
        <button id="boutonRetourAfficherLieux"
            class="text-c1 py-2 px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 mr-2 hover:bg-c3 transition uppercase">
            Annuler
        </button>
        <button type="submit"
            class="bg-c1 text-c3 px-3 sm:py-2 sm:px-6 font-barlow font-semibold text-base sm:text-xl  rounded-full w-75 mt-2 uppercase">
            Ajouter
        </button>
    </div>
</form>


