<div>
    <button id="boutonRetourLieux"
        class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
        Retour
    </button>
    <form id="formModifierLieu" class="mt-2 text-c1" action="{{ route('usagerLieux.modifierLieu', [$lieu->id]) }}"
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
                        <input type="text" name="nomEtablissementModifie" id="nomEtablissementModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium"
                            value="{{ old('nomEtablissementModifie') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('nomEtablissementModifie'))
                            <span
                                class="text-c5 font-medium erreur-message">{{ session('erreurModifierLieu')->first('nomEtablissementModifie') }}</span>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectTypeLieuModifie" class="block">Type de lieu <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="selectTypeLieuModifie" id="selectTypeLieuModifie"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner un type</option>
                            @foreach ($typesLieu as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('selectTypeLieuModifie', $lieu->type_lieu_id) == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('selectTypeLieuModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('selectTypeLieuModifie') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <label for="descriptionModifie" class="block">Description</label>
                        <textarea rows="4" name="descriptionModifie" id="descriptionModifie"
                            class="block w-full rounded-lg font-medium p-2">{{ old('descriptionModifie') }}</textarea>
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('descriptionModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('descriptionModifie') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="photoLieuModifie" class="block">Photo du lieu (Ne doit pas dépasser 2mo)</label>
                        <input id="photoLieuModifie" name="photoLieuModifie" type="file"
                            class="w-full rounded-lg bg-c3 p-2 font-medium" accept=".png,.jpg">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('photoLieuModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('photoLieuModifie') }}
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
                        <input type="text" name="noCivicModifie" id="noCivicModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('noCivicModifie') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('noCivicModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('noCivicModifie') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="rueModifie" class="block">Rue <span class="text-c5 ml-2">*</span></label>
                        <input type="text" name="rueModifie" id="rueModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('rueModifie') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('rueModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('rueModifie') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="codePostalModifie" class="block">Code postal <span
                                class="text-c5 ml-2">*</span></label>
                        <input type="text" name="codePostalModifie" id="codePostalModifie" placeholder="A1A 1A1"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium"
                            value="{{ old('codePostalModifie') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('codePostalModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('codePostalModifie') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectVilleLieuModifie" class="block">Ville</label>
                        <select name="selectVilleLieuModifie" id="selectVilleLieuModifie"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner une ville</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}"
                                    {{ old('selectVilleLieuModifie', $lieu->ville_id) == $ville->id ? 'selected' : '' }}>
                                    {{ $ville->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('selectVilleLieuModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('selectVilleLieuModifie') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectQuartierLieuModifie" class="block">Quartier (choisir une ville avant) <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="selectQuartierLieuModifie" id="selectQuartierLieuModifie"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner un quartier</option>
                        </select>
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('selectQuartierLieuModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('selectQuartierLieuModifie') }}
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
                        <input type="text" name="numeroTelephoneModifie" id="numeroTelephoneModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" placeholder="###-###-####"
                            value="{{ old('numeroTelephoneModifie') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('numeroTelephoneModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('numeroTelephoneModifie') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="siteWeb" class="block">Site web</label>
                        <input type="text" name="siteWebModifie" id="siteWebModifie"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium"
                            placeholder="https://www.monsite.com/" value="{{ old('siteWebModifie') }}">
                        @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('siteWebModifie'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierLieu')->first('siteWebModifie') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
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
