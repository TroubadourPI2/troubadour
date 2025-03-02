@php
    // Date du jour (au format YYYY-MM-DD)
    $aujourdhui = date('Y-m-d');
    // Date d'aujourd'hui + 5 ans
    $dateLimite = date('Y-m-d', strtotime('+5 years'));
@endphp
<div>
    <!-- Bouton Retour -->
    <button 
        class=" boutonRetourAfficherActiviteModif flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
        {{ __('retour') }}
    </button>

    <!-- Formulaire de modification de l'activité -->
    <form class="mt-2 text-c1"
        action="{{ isset($activiteChoisit) ? route('usagerActivites.modifierActivite', $activiteChoisit->id) : '' }}"
        method="POST" enctype="multipart/form-data" id="formulaireActiviteModif">
        @csrf
        @method('PUT')
        <div class="font-barlow text-c1 font-semibold mb-3">
            <h2 class="uppercase text-center text-xl sm:text-3xl"> {{ __('modifierActivite') }}</h2>


            <!-- Informations générales -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-3">
                            <div class="flex  w-full  ">
                            <h3 class="text-lg sm:text-2xl w-full mb-2 underline">{{ __('informationsGenerales') }}</h3>
                            <div class="items-center flex w-full justify-end gap-x-1.5">
                                <label for="actifModif" id="labelActifModif" class="cursor-pointer">ACTIF</label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" id="actifHidden" name="actif" value="{{ old('actif', isset($activiteChoisit) ? $activiteChoisit->actif : 0) }}">
                          
                                <input type="checkbox" id="actifCheck" class="sr-only peer"
                                {{ old('actif', isset($activiteChoisit) ? $activiteChoisit->actif : 0) == 1 ? 'checked' : '' }}>
                            
                <div class="w-11 h-6 bg-c3 rounded-full peer peer-checked:after:translate-x-5 peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-c1 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-c1 peer-checked:after:bg-white"></div>
            </label>
            @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('actif'))
            <div class="erreurModifierActiviteMessages">
                <span class="text-c5 font-medium erreur-message">
                    {{ session('erreurModifierActivite')->first('actif') }}
                </span>
            </div>
        @endif
            </div>
        </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <!-- Nom -->
                    <div class="sm:col-span-2">
                        <label for="nomActiviteModif" class="block">{{ __('nom') }}<span
                                class="text-c5 ml-2">*</span></label>
                        <input type="text" name="nomActivite" id="nomActiviteModif"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('nomActivite') }}">
                        @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('nomActivite'))
                            <div class="erreurModifierActiviteMessages">
                                <span class="text-c5 font-medium erreur-message">
                                    {{ session('erreurModifierActivite')->first('nomActivite') }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <!-- Type d'activité -->
                    <div class="sm:col-span-1">
                        <label for="typeActiviteModif" class="block">{{ __('typeActivite') }} <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="typeActivite_id" id="typeActiviteModif"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">{{ __('SelectionnerType') }}</option>
                            @foreach ($typesActivite as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('typeActivite_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('typeActivite_id'))
                            <div class="text-c5 font-medium erreurModifierActiviteMessages">
                                {{ session('erreurModifierActivite')->first('typeActivite_id') }}
                            </div>
                        @endif
                    </div>
                    <!-- Lieux (TomSelect) -->
                    <div class="sm:col-span-1">
                        <label for="lieuIdModif" class="block">{{ __('lieux') }}<span
                                class="text-c5 ml-2">*</span></label>
                        <select name="lieu_id[]" id="lieuIdModif" class="block w-full rounded-lg p-1 bg-c3 font-medium"
                            multiple>
                            @foreach ($lieuxUsager as $lieu)
                                <option value="{{ $lieu->id }}"
                                    {{ in_array($lieu->id, old('lieu_id', [])) ? 'selected' : '' }}>
                                    {{ $lieu->nomEtablissement }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('lieu_id'))
                            <div class="text-c5 font-medium erreurModifierActiviteMessages">
                                {{ session('erreurModifierActivite')->first('lieu_id') }}
                            </div>
                        @endif
                    </div>
                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label for="descriptionActiviteModif" class="block">{{ __('description') }}</label>
                        <textarea rows="4" name="descriptionActivite" id="descriptionActiviteModif"
                            class="block w-full rounded-lg font-medium p-2">{{ old('descriptionActivite') }}</textarea>
                        @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('descriptionActivite'))
                            <div class="text-c5 font-medium erreurModifierActiviteMessages">
                                {{ session('erreurModifierActivite')->first('descriptionActivite') }}
                            </div>
                        @endif
                    </div>
                    <!-- Nouvelles photos -->
                    <div class="sm:col-span-1">
                        <label for="photosModif" class="block">{{ __('photoActivite') }}
                            {{ __('maxTaille') }}</label>
                        <input id="photosModif" name="photos[]" type="file"
                            class="w-full rounded-lg bg-c3 p-2 font-medium" accept=".png,.jpg" multiple>
                        @if (session('erreurModifierActivite'))
                            @php
                                $errorMessages = [];
                                foreach (session('erreurModifierActivite')->getMessages() as $key => $messages) {
                                    if (substr($key, 0, 6) === 'photos') {
                                        foreach ($messages as $message) {
                                            $errorMessages[] = $message;
                                        }
                                    }
                                }
                                $errorMessages = array_unique($errorMessages);
                            @endphp
                            @foreach ($errorMessages as $uniqueMessage)
                                <div class="text-c5 font-medium erreurModifierActiviteMessages">{{ $uniqueMessage }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Section Position des nouvelles images -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <h3 class="text-lg sm:text-2xl mb-2 underline">{{ __('positionNouvelleImage') }}</h3>
                <p class="text-sm mb-2 text-c1 opacity-40 italic">
                    {{ __('positionNouvelleImageIndiquer') }}
                </p>
                <div id="positionInputsModif" class="grid grid-cols-1 lg:grid-cols-2 gap-4"></div>
            </div>

            <!-- Section des photos actuelles -->
            <div id="positionActuellesContainer" class="mt-4">
                <h3 class="text-lg sm:text-2xl mb-2 underline"></h3>
                <div id="positionActuelles" class="grid grid-cols-1 lg:grid-cols-2 gap-4"></div>
            </div>
            @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('positions'))
                <div class="text-c5 font-medium erreurAjouterActiviteMessages">
                    {{ session('erreurModifierActivite')->first('positions') }}
                </div>
            @endif

            <!-- Dates de l'activité -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <!-- Date de début -->
                    <div class="sm:col-span-1">
                        <div class="flex flex-col w-1/2">
                            <label for="dateDebutModif">{{ __('dateDebut') }}</label>
                            <input type="date" id="dateDebutModif" name="dateDebut"
                                value="{{ old('dateDebut', $aujourdhui) }}" min="{{ $aujourdhui }}"
                                max="{{ $dateLimite }}" class="p-2 font-medium rounded-lg bg-c3" />
                            @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('dateDebut'))
                                <div class="text-c5 font-medium erreurModifierActiviteMessages">
                                    {{ session('erreurModifierActivite')->first('dateDebut') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <div class="flex flex-col w-1/2">
                            <label for="dateFinModif">{{ __('dateFin') }}</label>
                            <input type="date" id="dateFinModif" name="dateFin"
                                value="{{ old('dateFin', $aujourdhui) }}" min="{{ $aujourdhui }}"
                                max="{{ $dateLimite }}" class="p-2 font-medium rounded-lg bg-c3" />
                            @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('dateFin'))
                                <div class="text-c5 font-medium erreurModifierActiviteMessages">
                                    {{ session('erreurModifierActivite')->first('dateFin') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div id="conteneur_photos_a_supprimer"></div>

            <input type="hidden" name="photos_actuelles" id="photos_actuelles">

            <input type="hidden" id="nombrePhotosActuelles" value="0">

            <!-- Boutons du formulaire -->
            <div class="flex flex-row justify-center mt-4">
                <button type="button" 
                    class="text-c1 boutonRetourAfficherActiviteModif py-2 px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 mr-2 hover:bg-c3 transition uppercase">
                    {{ __('annuler') }}
                </button>
                <button type="submit"
                    class="bg-c1 text-c3 px-3 sm:py-2 sm:px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 uppercase">
                    {{ __('enregistrer') }}
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Initialisation de TomSelect pour le select des lieux --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    new TomSelect("#lieuIdModif", {
        plugins: ['remove_button'],
        placeholder: Lang.get('strings.selectMultipleLieux')
    });
    

});

</script>

