<div>
    <button id="boutonRetourAfficherActivite"
        class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
        Retour
    </button>


    <form class="mt-2 text-c1" action="{{ route('usagerLieux.ajouterLieu') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="font-barlow text-c1 font-semibold mb-3">
            <h2 class="uppercase text-center text-xl sm:text-3xl">Ajouter un lieu</h2>

            <!-- Informations générales du lieu -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-3">
                <h3 class="text-lg sm:text-2xl mb-2 underline">Informations générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <div class="sm:col-span-1">
                        <label for="nomEtablissement" class="block">Nom <span class="text-c5 ml-2">*</span></label>
                        <input type="text" name="nomEtablissement" id="nomEtablissement"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium"
                            value="{{ old('nomEtablissement') }}">
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('nomEtablissement'))
                            <span
                                class="text-c5 font-medium erreur-message">{{ session('erreurAjouterLieu')->first('nomEtablissement') }}</span>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectTypeLieu" class="block">Type de lieu <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="selectTypeLieu" id="selectTypeLieu"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner un type</option>
                            @foreach ($typesLieu as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('selectTypeLieu') == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('selectTypeLieu'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('selectTypeLieu') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="block">Description</label>
                        <textarea rows="4" name="description" id="description" class="block w-full rounded-lg font-medium p-2">{{ old('description') }}</textarea>
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('description'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('description') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="photoLieu" class="block">Photo du lieu (Ne doit pas dépasser 2mo)</label>
                        <input id="photoLieu" name="photoLieu" type="file"
                            class="w-full rounded-lg bg-c3 p-2 font-medium" accept=".png,.jpg">
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('photoLieu'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('photoLieu') }}
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
                        <input type="text" name="noCivic" id="noCivic"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('noCivic') }}">
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('noCivic'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('noCivic') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="rue" class="block">Rue <span class="text-c5 ml-2">*</span></label>
                        <input type="text" name="rue" id="rue"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('rue') }}">
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('rue'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('rue') }}</div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="codePostal" class="block">Code postal <span class="text-c5 ml-2">*</span></label>
                        <input type="text" name="codePostal" id="codePostal" placeholder="A1A 1A1"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" value="{{ old('codePostal') }}">
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('codePostal'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('codePostal') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectVilleLieu" class="block">Ville</label>
                        <select name="selectVilleLieu" id="selectVilleLieu"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner une ville</option>
                            @foreach ($villes as $ville)
                                <option value="{{ $ville->id }}">
                                    {{ $ville->nom }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('selectVilleLieu'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('selectVilleLieu') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="selectQuartierLieu" class="block">Quartier (choisir une ville avant) <span
                                class="text-c5 ml-2">*</span></label>
                        <select name="selectQuartierLieu" id="selectQuartierLieu"
                            class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium"
                            {{ old('selectVilleLieu') ? '' : 'disabled' }}>
                            <option value="">Sélectionner un quartier</option>
                        </select>
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('selectQuartierLieu'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('selectQuartierLieu') }}
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
                        <label for="numeroTelephone" class="block">Numéro de téléphone <span
                                class="text-c5 ml-2">*</span></label>
                        <input type="text" name="numeroTelephone" id="numeroTelephone"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium" placeholder="###-###-####"
                            value="{{ old('numeroTelephone') }}">
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('numeroTelephone'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('numeroTelephone') }}
                            </div>
                        @endif
                    </div>
                    <div class="sm:col-span-1">
                        <label for="siteWeb" class="block">Site web</label>
                        <input type="text" name="siteWeb" id="siteWeb"
                            class="block w-full rounded-lg p-1 sm:p-2 font-medium"
                            placeholder="https://www.monsite.com/" value="{{ old('siteWeb') }}">
                        @if (session('erreurAjouterLieu') && session('erreurAjouterLieu')->has('siteWeb'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurAjouterLieu')->first('siteWeb') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

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




@if (session('erreurAjouterActivite'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("compte").classList.add("hidden");
            const boutonCompte = document.getElementById("boutonCompte");
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonActivites = document.getElementById("boutonActivites");
            boutonActivites.classList.add("bg-c1", "text-c3");
            boutonActivites.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            document.getElementById("ajouterActivite").classList.remove("hidden");
            const activites = document.getElementById("activites");
            activites.classList.remove("hidden");

            document.getElementById("afficherActivites").classList.add("hidden");
        });
    </script>
    @php
        session()->forget('erreurAjouterActivite');
    @endphp
@endif
