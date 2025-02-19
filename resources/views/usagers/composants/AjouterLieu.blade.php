<button id="boutonRetourAfficherLieux"
    class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
    <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
        data-inline="false"></span>
    Retour
</button>

<form class="mt-2 text-c1" action="{{ route('usagerLieux.ajouterLieu') }}" method="POST">
    @csrf
    <div class="font-barlow text-c1 font-semibold mb-3">
        <h2 class="uppercase underline text-center text-xl sm:text-2xl">Ajouter un lieu</h2>
        <div class="font-barlow text-c1 font-semibold uppercase mt-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg ">
                <div class="sm:col-span-1">
                    <label for="nomEtablissement" class="block">Nom</label>
                    <input type="text" name="nomEtablissement" id="nomEtablissement"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                    @error('nomEtablissement')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="description" class="block">Description</label>
                    <textarea rows="3" name="description" id="description" class="block w-full rounded-lg font-medium p-2"></textarea>
                    @error('description')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="selectTypeLieu" class="block">Type de lieu</label>
                    <select type="text" name="selectTypeLieu" id="selectTypeLieu"
                        class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                        <option value="">Sélectionner un type</option>
                        @foreach ($typesLieu as $type)
                            <option value="{{ $type->id }}">{{ $type->nom }}</option>
                        @endforeach
                    </select>
                    @error('selectTypeLieu')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="numeroTelephone" class="block">Numéro de téléphone</label>
                    <input type="text" name="numeroTelephone" id="numeroTelephone"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                    @error('numeroTelephone')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="siteWeb" class="block">Site web</label>
                    <input type="text" name="siteWeb" id="siteWeb"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                    @error('siteWeb')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="noCivic" class="block">Numéro civique</label>
                    <input type="text" name="noCivic" id="noCivic"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                    @error('noCivic')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="photoLieu" class="block">Photo du lieu</label>
                    <input id="photoLieu" name="photoLieu" type="file"
                        class="w-full rounded-lg bg-c3 p-2 font-medium" accept=".png,.jpg">
                    @error('photoLieu')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="rue" class="block">Rue</label>
                    <input type="text" name="rue" id="rue"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                    @error('rue')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="codePostal" class="block">Code postal</label>
                    <input type="text" name="codePostal" id="codePostal"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium">
                    @error('codePostal')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="selectVilleLieu" class="block">Ville</label>
                    <select type="text" name="selectVilleLieu" id="selectVilleLieu"
                        class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                        <option value="">Sélectionner une ville</option>
                        @foreach ($villes as $ville)
                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                    @error('selectVilleLieu')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-1">
                    <label for="selectQuartierLieu" class="block">Quartier</label>
                    <select type="text" name="selectQuartierLieu" id="selectQuartierLieu"
                        class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium" disabled>
                        <option value="">Sélectionner un quartier</option>
                    </select>
                    @error('selectQuartierLieu')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
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
            class="bg-c1 text-c3 px-3 sm:py-2 sm:px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 uppercase">
            Ajouter
        </button>
    </div>
</form>

