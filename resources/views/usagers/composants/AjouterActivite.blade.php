@php
    // Date du jour (au format YYYY-MM-DD)
    $aujourdhui = date('Y-m-d');
    // Date d'aujourd'hui + 5 ans
    $dateLimite = date('Y-m-d', strtotime('+5 years'));
@endphp
<div>
    <!-- Bouton Retour -->
    <button 
        class="boutonRetourAfficherActivite flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
            {{ __('retour') }}
    </button>

    <form class="mt-2 text-c1" action="{{ route('usagerActivites.ajouterActivite') }}" method="POST"
        enctype="multipart/form-data" id="activiteForm">
        @csrf
        <div class="font-barlow text-c1 font-semibold mb-3">
            <h2 class="uppercase text-center text-xl sm:text-3xl">{{ __('ajouterActivite') }}</h2>
            
            <!-- Informations générales -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-3">
                <h3 class="text-lg sm:text-2xl mb-2 underline">{{ __('infoGenerales') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <div class="sm:col-span-2">
                        <label for="nomActivite" class="block">    {{ __('nom') }}<span class="text-c5 ml-2">*</span></label>
                        <input type="text" name="nomActivite" id="nomActivite"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('nomActivite') }}">
                        @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('nomActivite'))
                            <div class="erreurAjouterActiviteMessages">
                                <span class="text-c5 font-medium erreur-message">
                                    {{ session('erreurAjouterActivite')->first('nomActivite') }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="typeActivite_id" class="block">{{ __('typeActivite') }} <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="typeActivite_id" id="typeActivite_id"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">{{ __('selectionnerType') }}</option>
                            @foreach ($typesActivite as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('typeActivite_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('typeActivite_id'))
                            <div class="text-c5 font-medium erreurAjouterActiviteMessages">
                                {{ session('erreurAjouterActivite')->first('typeActivite_id') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="lieu_id" class="block"> {{ __('lieux') }} <span class="text-c5 ml-2">*</span></label>
                        <select name="lieu_id[]" id="lieu_id" class="block w-full rounded-lg p-1  bg-c3 font-medium"
                            multiple>
                            @foreach ($lieuxUsager as $lieu)
                            @if ($lieu->actif == 1)
                                <option value="{{ $lieu->id }}"
                                    {{ in_array($lieu->id, old('lieu_id', [])) ? 'selected' : '' }}>
                                    {{ $lieu->nomEtablissement }}
                                </option>
                                @endif
                            @endforeach
                        </select>

                        @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('lieu_id'))
                            <div class="text-c5 font-medium erreurAjouterActiviteMessages">
                                {{ session('erreurAjouterActivite')->first('lieu_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="sm:col-span-2">
                        <label for="descriptionActivite" class="block">{{ __('description') }}</label>
                        <textarea rows="4" name="descriptionActivite" id="descriptionActivite"
                            class="block w-full rounded-lg font-medium p-2">{{ old('descriptionActivite') }}</textarea>
                        @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('descriptionActivite'))
                            <div class="text-c5 font-medium erreurAjouterActiviteMessages">
                                {{ session('erreurAjouterActivite')->first('descriptionActivite') }}
                            </div>
                        @endif
                    </div>
                    <!-- Ajout des images -->
                    <div class="sm:col-span-1">
                        <label for="photos" class="block">{{ __('photoActivite') }} {{ __('maxTaille') }}</label>
                        <input id="photos" name="photos[]" type="file"
                            class="w-full rounded-lg bg-c3 p-2 font-medium" accept=".png,.jpg" multiple>
                        @if (session('erreurAjouterActivite'))
                            @php
                                $errorMessages = [];
                                foreach (session('erreurAjouterActivite')->getMessages() as $key => $messages) {
                                    if (substr($key, 0, 6) === 'photos') {
                                        foreach ($messages as $message) {
                                            $errorMessages[] = $message;
                                        }
                                    }
                                }
                                $errorMessages = array_unique($errorMessages);
                            @endphp

                            @foreach ($errorMessages as $uniqueMessage)
                                <div class="text-c5 font-medium erreurAjouterActiviteMessages">{{ $uniqueMessage }}
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

            <!-- Section Position des images -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <h3 class="text-lg sm:text-2xl mb-2 underline">{{ __('positionImages') }}</h3>
                <p class="text-sm mb-2 text-c1 opacity-40 italic">{{ __('indiquerPosition') }}
                </p>
                <div id="positionInputs" class="grid grid-cols-1 lg:grid-cols-2 gap-4"></div>
                @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('positions'))
    <div class="text-c5 font-medium erreurAjouterActiviteMessages">
        {{ session('erreurAjouterActivite')->first('positions') }}
    </div>
@endif


            </div>

            <!-- DATE ACTIVITE -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg  ">
                    <!-- Date de début -->
                    <div class="sm:col-span-1">
                        <div class="flex flex-col w-full md:w-1/2">
                            <label for="dateDebut">{{ __('dateDebut') }}</label>
                            <input type="date" id="dateDebut" name="dateDebut"
                                value="{{ old('dateDebut', $aujourdhui) }}" min="{{ $aujourdhui }}"
                                max="{{ $dateLimite }}" class="p-2 font-medium rounded-lg bg-c3" />
                            @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('dateDebut'))
                                <div class="text-c5 font-medium erreurAjouterActiviteMessages">
                                    {{ session('erreurAjouterActivite')->first('dateDebut') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Date de fin -->
                    <div class="sm:col-span-1">
                        <div class="flex flex-col  w-full md:w-1/2">
                            <label for="dateFin">{{ __('dateFin') }}</label>
                            <input type="date" id="dateFin" name="dateFin"
                                value="{{ old('dateFin', $aujourdhui) }}" min="{{ $aujourdhui }}"
                                max="{{ $dateLimite }}" class="p-2 font-medium rounded-lg bg-c3" />
                            @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('dateFin'))
                                <div class="text-c5 font-medium erreurAjouterActiviteMessages">
                                    {{ session('erreurAjouterActivite')->first('dateFin') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons du formulaire -->
            <div class="flex flex-row justify-center mt-4">
                <button type="button"
                    class=" boutonRetourAfficherActivite text-c1 py-2 px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 mr-2 hover:bg-c3 transition uppercase">
                    {{ __('annuler') }}
                </button>
                <button type="submit"
                    class="bg-c1 text-c3 px-3 sm:py-2 sm:px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 uppercase">
                    {{ __('ajouter') }}
                </button>
            </div>
        </div>
    </form>

</div>
{{-- Initialisation de TomSelect --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Lang.setLocale(document.body.getAttribute('data-locale'))
        new TomSelect("#lieu_id", {
            plugins: ['remove_button'],
            placeholder: Lang.get('strings.selectMultipleLieux')
        });
    });

    
</script>
