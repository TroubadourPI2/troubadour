<div>
    <button id="boutonRetourLieux"
        class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full {{ App::getLocale() == 'en' ? 'sm:w-24 w-16' : 'sm:w-32 w-20' }} text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
        {{ __('retour') }}
    </button>
    <form id="formModifierLieu" class="mt-2 text-c1 md:mx-10 xl:mx-20 2xl:mx-60"
        action="{{ route('usagerLieux.modifierLieu', ['id' => 1]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="font-barlow text-c1 font-semibold mb-3 uppercase">

            <h2 class="uppercase text-center text-xl sm:text-3xl">{{ __('modifierLieu') }}</h2>

            <!-- Informations générales du lieu -->
            <div class="flex items-center justify-between w-full mb-2 uppercase">
                <h3 class="text-lg sm:text-2xl underline">{{ __('infoGenerales') }}</h3>
                <div class="flex items-center gap-2">
                    <span id="texteActif" class="text-lg font-semibold text-c1">{{ __('actif') }}</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" id="statutLieuCache" name="actif" value="0">
                        <input type="checkbox" id="boutonBascule" class="sr-only peer" checked>

                        <div
                            class="w-11 h-6 bg-c3 rounded-full peer peer-checked:bg-c1 peer-checked:after:translate-x-full 
                rtl:peer-checked:after:-translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] 
                after:bg-c1 peer-checked:after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all">
                        </div>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                <div class="sm:col-span-1">
                    <label for="nomEtablissementModifie" class="block">{{ __('nom') }} <span
                            class="text-c5 ml-2">*</span></label>
                    <input type="text" name="nomEtablissement" id="nomEtablissementModifie"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('nomEtablissement') }}">
                    @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('nomEtablissement'))
                        <span
                            class="text-c5 font-medium erreur-message">{{ session('erreurModifierLieu')->first('nomEtablissement') }}</span>
                    @endif
                </div>
                <div class="sm:col-span-1">
                    <label for="selectTypeLieuModifie" class="block">{{ __('typeLieu') }} <span
                            class="text-c5 ml-2">*</span></label>
                    <select name="selectTypeLieu" id="selectTypeLieuModifie"
                        class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                        <option value="">{{ __('selectionnerType') }}</option>
                        @foreach ($typesLieu as $type)
                            <option value="{{ $type->id }}">
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
                    <label for="descriptionModifie" class="block">{{ __('description') }}</label>
                    <textarea rows="4" name="description" id="descriptionModifie" class="block w-full rounded-lg font-medium p-2">{{ old('description') }}</textarea>
                    @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('description'))
                        <div class="text-c5 font-medium erreur-message">
                            {{ session('erreurModifierLieu')->first('description') }}
                        </div>
                    @endif
                </div>
                <div class="sm:col-span-1">
                    <label for="photoLieuModifie" class="block">{{ __('photoLieu') }}
                        {{ __('maxTaille') }}</label>
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
            <h3 class="text-lg sm:text-2xl mb-2 underline">{{ __('adresse') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                <div class="sm:col-span-1">
                    <label for="noCivic" class="block">{{ __('numCivique') }} <span
                            class="text-c5 ml-2">*</span></label>
                    <input type="text" name="noCivic" id="noCivicModifie"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('noCivic') }}">
                    @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('noCivic'))
                        <div class="text-c5 font-medium erreur-message">
                            {{ session('erreurModifierLieu')->first('noCivic') }}
                        </div>
                    @endif
                </div>
                <div class="sm:col-span-1">
                    <label for="rueModifie" class="block">{{ __('rue') }} <span
                            class="text-c5 ml-2">*</span></label>
                    <input type="text" name="rue" id="rueModifie"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('rue') }}">
                    @if (session('erreurModifierLieu') && session('erreurModifierLieu')->has('rue'))
                        <div class="text-c5 font-medium erreur-message">
                            {{ session('erreurModifierLieu')->first('rue') }}
                        </div>
                    @endif
                </div>
                <div class="sm:col-span-1">
                    <label for="codePostalModifie" class="block">{{ __('codePostal') }} <span
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
                    <label for="selectVilleLieuModifie" class="block">{{ trans_choice('ville', 1) }}</label>
                    <select name="selectVilleLieu" id="selectVilleLieuModifie"
                        class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                        <option value="">{{ __('choisirVille') }}</option>
                        @foreach ($villes as $ville)
                            <option value="{{ $ville->id }}">
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
                    <label for="selectQuartierLieuModifie" class="block">{{ __('quartier') }}
                        {{ __('villeAvant') }} <span class="text-c5 ml-2">*</span></label>
                    <select name="selectQuartierLieu" id="selectQuartierLieuModifie"
                        class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                        <option value="">{{ __('choisirQuartier') }}</option>
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
            <h3 class="text-lg sm:text-2xl mb-2 underline">{{ __('coordonnees') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                <div class="sm:col-span-1">
                    <label for="numeroTelephoneModifie" class="block">{{ __('telephone') }} <span
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
                    <label for="siteWeb" class="block">{{ __('siteWeb') }}</label>
                    <input type="text" name="siteWeb" id="siteWebModifie"
                        class="block w-full rounded-lg p-1 sm:p-2 font-medium" placeholder="https://www.monsite.com/"
                        value="{{ old('siteWeb') }}">
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
                {{ __('annuler') }}
            </button>
            <button type="submit"
                class="bg-c1 text-c3 px-3 sm:py-2 sm:px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 uppercase">
                {{ __('enregistrer') }}
            </button>
        </div>
    </form>
</div>
