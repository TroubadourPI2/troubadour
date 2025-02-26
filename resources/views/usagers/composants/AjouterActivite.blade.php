@php
    // Date du jour (au format YYYY-MM-DD)
    $aujourdhui = date('Y-m-d');
    // Date d'aujourd'hui + 5 ans
    $dateLimite = date('Y-m-d', strtotime('+5 years'));
@endphp
<div>
    <!-- Bouton Retour -->
    <button id="boutonRetourAfficherActivite"
        class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
        Retour
    </button>

    <form class="mt-2 text-c1" action="{{ route('usagerActivites.ajouterActivite') }}" method="POST"
        enctype="multipart/form-data" id="activiteForm">
        @csrf
        <div class="font-barlow text-c1 font-semibold mb-3">
            <h2 class="uppercase text-center text-xl sm:text-3xl">Ajouter une activité</h2>

            <!-- Informations générales -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-3">
                <h3 class="text-lg sm:text-2xl mb-2 underline">Informations générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <div class="sm:col-span-2">
                        <label for="nomActivite" class="block">Nom <span class="text-c5 ml-2">*</span></label>
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
                        <label for="typeActivite_id" class="block">Type d'activite <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="typeActivite_id" id="typeActivite_id"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner un type</option>
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
                        <label for="lieu_id" class="block">Lieux <span class="text-c5 ml-2">*</span></label>
                        <select name="lieu_id[]" id="lieu_id" class="block w-full rounded-lg p-1  bg-c3 font-medium"
                            multiple>
                            @foreach ($lieuxUsager as $lieu)
                                <option value="{{ $lieu->id }}"
                                    {{ in_array($lieu->id, old('lieu_id', [])) ? 'selected' : '' }}>
                                    {{ $lieu->nomEtablissement }}
                                </option>
                            @endforeach
                        </select>


                        @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('lieu_id'))
                            <div class="text-c5 font-medium erreurAjouterActiviteMessages">
                                {{ session('erreurAjouterActivite')->first('lieu_id') }}
                            </div>
                        @endif
                    </div>

                    <div class="sm:col-span-2">
                        <label for="descriptionActivite" class="block">Description</label>
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
                        <label for="photos" class="block">Photos de l'activité (Ne doit pas dépasser 2mo par
                            image)</label>
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
                <h3 class="text-lg sm:text-2xl mb-2 underline">Position des images</h3>
                <p class="text-sm mb-2 text-c1 opacity-40 italic">Pour chaque image sélectionnée, indiquez sa position.
                </p>
                <div id="positionInputs" class="grid grid-cols-1 gap-4"></div>

            </div>

            <!-- DATE ACTIVITE -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg  ">
                    <!-- Date de début -->
                    <div class="sm:col-span-1">
                        <div class="flex flex-col w-1/2">
                            <label for="dateDebut">Date de début</label>
                            <input type="date" id="dateDebut" name="dateDebut"
                                value="{{ old('dateDebut', $aujourdhui) }}" min="{{ $aujourdhui }}"
                                max="{{ $dateLimite }}" />
                            @if (session('erreurAjouterActivite') && session('erreurAjouterActivite')->has('dateDebut'))
                                <div class="text-c5 font-medium erreurAjouterActiviteMessages">
                                    {{ session('erreurAjouterActivite')->first('dateDebut') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Date de fin -->
                    <div class="sm:col-span-1">
                        <div class="flex flex-col w-1/2">
                            <label for="dateFin">Date de fin</label>
                            <input type="date" id="dateFin" name="dateFin"
                                value="{{ old('dateFin', $aujourdhui) }}" min="{{ $aujourdhui }}"
                                max="{{ $dateLimite }}" />
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
                <button type="button" id="boutonAnnuler"
                    class="text-c1 py-2 px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 mr-2 hover:bg-c3 transition uppercase">
                    Annuler
                </button>
                <button type="submit"
                    class="bg-c1 text-c3 px-3 sm:py-2 sm:px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 uppercase">
                    Ajouter
                </button>
            </div>
        </div>
    </form>
</div>
{{-- Initialisation de TomSelect --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new TomSelect("#lieu_id", {
            plugins: ['remove_button'],
            placeholder: "Sélectionnez un ou plusieurs lieux"
        });
    });
</script>
s