<div>
    <button id="boutonRetourLieux"
        class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
        Retour
    </button>
    <form id="formModifierLieu" class="mt-2 text-c1" action="{{ route('usagerLieux.modifierLieu', ['id' => 1]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="font-barlow text-c1 font-semibold mb-3">
            <h2 class="uppercase text-center text-xl sm:text-3xl">Modifier un lieu</h2>

            <!-- Informations générales du lieu -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-3">
                <h3 class="text-lg sm:text-2xl mb-2 underline">Informations générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <div class="sm:col-span-1">
                        <label for="nomEtablissementModifie" class="block">Nom <span
                                class="text-c5 ml-2">*</span></label>
                        <input type="text" name="nomEtablissement" id="nomEtablissementModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium"
                            value="{{ old('nomEtablissement') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('nomEtablissement'))
                            <span
                                class="text-c5 font-medium erreur-message">{{ session('erreurModifierLieu')->first('nomEtablissement') }}</span>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectTypeLieuModifie" class="block">Type de lieu <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="selectTypeLieu" id="selectTypeLieuModifie"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner un type</option>
                            @foreach ($typesLieu as $type)
                                <option value="{{ $type->id }}"
                                >
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('selectTypeLieu'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('selectTypeLieu') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <label for="descriptionModifie" class="block">Description</label>
                        <textarea rows="4" name="description" id="descriptionModifie" class="block w-full rounded-lg font-medium p-2">{{ old('description') }}</textarea>
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('description'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('description') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="photoLieuModifie" class="block">Photo du lieu (Ne doit pas dépasser 2mo)</label>
                        <input id="photoLieuModifie" name="photoLieu" type="file"
                            class="w-full rounded-lg bg-c3 p-2 font-medium" accept=".png,.jpg">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('photoLieu'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('photoLieu') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Adresse du lieu -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <h3 class="text-lg sm:text-2xl mb-2 underline">Adresse</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <div class="sm:col-span-1">
                        <label for="noCivic" class="block">Numéro civique <span class="text-c5 ml-2">*</span></label>
                        <input type="text" name="noCivic" id="noCivicModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('noCivic') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('noCivic'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('noCivic') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="rueModifie" class="block">Rue <span class="text-c5 ml-2">*</span></label>
                        <input type="text" name="rue" id="rueModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('rue') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('rue'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('rue') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="codePostalModifie" class="block">Code postal <span
                                class="text-c5 ml-2">*</span></label>
                        <input type="text" name="codePostal" id="codePostalModifie" placeholder="A1A 1A1"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('codePostal') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('codePostal'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('codePostal') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectVilleLieuModifie" class="block">Ville</label>
                        <select name="selectVilleLieu" id="selectVilleLieuModifie"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner une ville</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}"
                                   >
                                    {{ $ville->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('selectVilleLieu'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('selectVilleLieu') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectQuartierLieuModifie" class="block">Quartier (choisir une ville avant) <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="selectQuartierLieu" id="selectQuartierLieuModifie"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner un quartier</option>
                        </select>
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('selectQuartierLieu'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('selectQuartierLieu') }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Coordonnées de contact -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <h3 class="text-lg sm:text-2xl mb-2 underline">Coordonnées</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <div class="sm:col-span-1">
                        <label for="numeroTelephoneModifie" class="block">Numéro de téléphone <span
                                class="text-c5 ml-2">*</span></label>
                        <input type="text" name="numeroTelephone" id="numeroTelephoneModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" placeholder="###-###-####"
                            value="{{ old('numeroTelephone') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('numeroTelephone'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('numeroTelephone') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="siteWeb" class="block">Site web</label>
                        <input type="text" name="siteWeb" id="siteWebModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium"
                            placeholder="https://www.monsite.com/" value="{{ old('siteWeb') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('siteWeb'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('siteWeb') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex flex-row justify-center mt-4">
                <button type="button" id="boutonAnnulerModifier"
                    class="text-c1 py-2 px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 mr-2 hover:bg-c3 transition uppercase">
                    Annuler
                </button>
                <button type="submit"
                    class="bg-c1 text-c3 px-3 sm:py-2 sm:px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 uppercase">
                    Enregistrer
                </button>
            </div>
        </div>
    </form>
</div>
