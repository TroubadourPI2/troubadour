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
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1"
              data-icon="ion:arrow-back-outline" data-inline="false"></span>
        Retour
    </button>

    <!-- Formulaire de modification de l'activité -->
    <form class="mt-2 text-c1"
          action="{{ isset($activiteChoisit) ? route('usagerActivites.modifierActivite', $activiteChoisit->id) : '' }}"
          method="POST" enctype="multipart/form-data" id="formulaireActiviteModif">
        @csrf
        @method('PUT')
        <div class="font-barlow text-c1 font-semibold mb-3">
            <h2 class="uppercase text-center text-xl sm:text-3xl">Modifier l'activité</h2>

            <!-- Affichage global des erreurs -->
            @if (session('erreurModifierActivite'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach (session('erreurModifierActivite')->all() as $erreur)
                            <li>{{ $erreur }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Informations générales -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-3">
                <h3 class="text-lg sm:text-2xl mb-2 underline">Informations générales</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <!-- Nom -->
                    <div class="sm:col-span-2">
                        <label for="nomActiviteModif" class="block">Nom <span class="text-c5 ml-2">*</span></label>
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
                        <label for="typeActiviteModif" class="block">Type d'activité <span class="text-c5 ml-2">*</span></label>
                        <select name="typeActivite_id" id="typeActiviteModif"
                                class="block w-full rounded-lg p-2 sm:p-3 bg-c3 font-medium">
                            <option value="">Sélectionner un type</option>
                            @foreach ($typesActivite as $type)
                                <option value="{{ $type->id }}" {{ old('typeActivite_id') == $type->id ? 'selected' : '' }}>
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
                        <label for="lieuIdModif" class="block">Lieux <span class="text-c5 ml-2">*</span></label>
                        <select name="lieu_id[]" id="lieuIdModif"
                                class="block w-full rounded-lg p-1 bg-c3 font-medium" multiple>
                            @foreach ($lieuxUsager as $lieu)
                                <option value="{{ $lieu->id }}" {{ in_array($lieu->id, old('lieu_id', [])) ? 'selected' : '' }}>
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
                        <label for="descriptionActiviteModif" class="block">Description</label>
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
                        <label for="photosModif" class="block">Nouvelles photos (max 2mo par image)</label>
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
                                <div class="text-c5 font-medium erreurModifierActiviteMessages">{{ $uniqueMessage }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Section Position des nouvelles images -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <h3 class="text-lg sm:text-2xl mb-2 underline">Position des nouvelles images</h3>
                <p class="text-sm mb-2 text-c1 opacity-40 italic">
                    Pour chaque nouvelle image sélectionnée, indiquez sa position.
                </p>
                <div id="positionInputsModif" class="grid grid-cols-1 lg:grid-cols-2 gap-4"></div>
            </div>

            <!-- Section des photos actuelles -->
            <div id="positionActuellesContainer" class="mt-4">
                <h3 class="text-lg sm:text-2xl mb-2 underline">Photos actuelles</h3>
                <div id="positionActuelles" class="grid grid-cols-1 lg:grid-cols-2 gap-4"></div>
            </div>

            <!-- Dates de l'activité -->
            <div class="font-barlow text-c1 font-semibold uppercase mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-base sm:text-lg">
                    <!-- Date de début -->
                    <div class="sm:col-span-1">
                        <div class="flex flex-col w-1/2">
                            <label for="dateDebutModif">Date de début</label>
                            <input type="date" id="dateDebutModif" name="dateDebut"
                                   value="{{ old('dateDebut', $aujourdhui) }}" min="{{ $aujourdhui }}" max="{{ $dateLimite }}"
                                   class="p-2 font-medium rounded-lg bg-c3" />
                            @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('dateDebut'))
                                <div class="text-c5 font-medium erreurModifierActiviteMessages">
                                    {{ session('erreurModifierActivite')->first('dateDebut') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Date de fin -->
                    <div class="sm:col-span-1">
                        <div class="flex flex-col w-1/2">
                            <label for="dateFinModif">Date de fin</label>
                            <input type="date" id="dateFinModif" name="dateFin"
                                   value="{{ old('dateFin', $aujourdhui) }}" min="{{ $aujourdhui }}" max="{{ $dateLimite }}"
                                   class="p-2 font-medium rounded-lg bg-c3" />
                            @if (session('erreurModifierActivite') && session('erreurModifierActivite')->has('dateFin'))
                                <div class="text-c5 font-medium erreurModifierActiviteMessages">
                                    {{ session('erreurModifierActivite')->first('dateFin') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Champs cachés pour la gestion des photos -->
            <!-- Conteneur pour les photos à supprimer (tableau d'IDs) -->
            <div id="conteneur_photos_a_supprimer"></div>
            <!-- Les positions des photos actuelles sont envoyées via les inputs avec name="positionsActuelles[photoId]" -->
            <input type="hidden" name="photos_actuelles" id="photos_actuelles">
            <!-- Nombre de photos actuelles (pour le calcul du max global) -->
            <input type="hidden" id="nombrePhotosActuelles" value="0">

            <!-- Boutons du formulaire -->
            <div class="flex flex-row justify-center mt-4">
                <button type="button" id="boutonAnnuler"
                        class="text-c1 py-2 px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 mr-2 hover:bg-c3 transition uppercase">
                    Annuler
                </button>
                <button type="submit"
                        class="bg-c1 text-c3 px-3 sm:py-2 sm:px-6 font-barlow font-semibold text-base sm:text-xl rounded-full w-75 mt-2 uppercase">
                    Modifier
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Initialisation de TomSelect pour le select des lieux --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new TomSelect("#lieuIdModif", {
            plugins: ['remove_button'],
            placeholder: "Sélectionnez un ou plusieurs lieux"
        });
    });
</script>

<!-- Fonction pour mettre à jour le max des positions pour tous les inputs -->
<script>
    function mettreAJourMaxDesPositions() {
        // Récupère le nombre de photos actuelles (après suppression éventuelle) et le nombre de nouvelles photos
        const nbPhotosActuelles = parseInt(document.getElementById('nombrePhotosActuelles').value) || 0;
        const nouveauxInputs = document.querySelectorAll('#positionInputsModif .position-input');
        const nbNouvelles = nouveauxInputs.length;
        const totalPhotos = nbPhotosActuelles + nbNouvelles;
        // Pour les nouvelles photos, mettre à jour leur max
        nouveauxInputs.forEach(input => {
            input.max = totalPhotos;
        });
        // Pour les photos actuelles, mettre à jour leur max également pour autoriser le réordonnancement
        const existantsInputs = document.querySelectorAll('#positionActuelles .position-input');
        existantsInputs.forEach(input => {
            input.max = totalPhotos;
        });
    }
</script>

<!-- Script pour gérer l'ajout des positions pour les nouvelles photos -->
<script>
    const champPhotosModif = document.getElementById('photosModif');
    const conteneurPositionsModif = document.getElementById('positionInputsModif');

    champPhotosModif.addEventListener('change', function() {
        conteneurPositionsModif.innerHTML = '';
        const fichiers = champPhotosModif.files;
        // Récupère le nombre de photos actuelles depuis le champ caché
        const nbPhotosActuelles = parseInt(document.getElementById('nombrePhotosActuelles').value) || 0;
        const totalPhotos = fichiers.length + nbPhotosActuelles;
        for (let i = 0; i < fichiers.length; i++) {
            const fichier = fichiers[i];
            const div = document.createElement('div');
            div.className = 'mb-2';

            const label = document.createElement('label');
            label.setAttribute('for', 'photos_' + i);
            label.className = 'block text-sm';
            label.innerText = 'Position pour "' + fichier.name + '"';

            const input = document.createElement('input');
            input.type = 'number';
            input.id = 'photos_' + i;
            input.name = 'photos[' + i + '][position]';
            input.min = 1;
            input.max = totalPhotos;
            input.classList.add('position-input', 'p-2', 'font-medium', 'rounded-lg', 'bg-c3');

            div.appendChild(label);
            div.appendChild(input);
            conteneurPositionsModif.appendChild(div);
        }
        mettreAJourMaxDesPositions();
    });
</script>

<!-- Script pour gérer la récupération de l'activité et le remplissage du formulaire -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.boutonModifierActivite').forEach(bouton => {
        bouton.addEventListener('click', function() {
            const idActivite = this.getAttribute('data-activite-id');
            console.log("ID de l'activité à modifier :", idActivite);

            axios.get(`/compte/obtenirActivite/${idActivite}`)
                .then(reponse => {
                    console.log("Données de l'activité :", reponse.data);
                    const activite = reponse.data.data;

                    if(document.getElementById('nomActiviteModif'))
                        document.getElementById('nomActiviteModif').value = activite.nom || '';
                    if(document.getElementById('descriptionActiviteModif'))
                        document.getElementById('descriptionActiviteModif').value = activite.description || '';
                    if(document.getElementById('dateDebutModif'))
                        document.getElementById('dateDebutModif').value = activite.dateDebut || '';
                    if(document.getElementById('dateFinModif'))
                        document.getElementById('dateFinModif').value = activite.dateFin || '';

                    if(document.getElementById('typeActiviteModif'))
                        document.getElementById('typeActiviteModif').value = activite.type_activite ? activite.type_activite.id : '';

                    const selectLieux = document.getElementById('lieuIdModif');
                    if(selectLieux && selectLieux.tomselect) {
                        selectLieux.tomselect.setValue(activite.lieux.map(lieu => lieu.id));
                    }

                    // Réinitialiser le conteneur pour les inputs cachés de suppression
                    document.getElementById('conteneur_photos_a_supprimer').innerHTML = '';

                    // Mettre à jour le nombre de photos actuelles
                    const nbActuelles = activite.photos.length;
                    document.getElementById('nombrePhotosActuelles').value = nbActuelles;

                    const conteneurPhotosActuelles = document.getElementById('positionActuelles');
                    conteneurPhotosActuelles.innerHTML = '';
                    activite.photos.forEach(photo => {
                        const divPhoto = document.createElement('div');
                        divPhoto.className = 'photo-actuelle mb-2 flex items-center gap-2 border p-2 rounded';

                        const image = document.createElement('img');
                        image.src = '/storage/Images/' + photo.chemin;
                        image.alt = photo.nom;
                        image.className = 'w-16 h-16 object-cover rounded';

                        const inputPositionPhoto = document.createElement('input');
                        inputPositionPhoto.type = 'number';
                        inputPositionPhoto.id = 'photo_actuelle_' + photo.id;
                        inputPositionPhoto.name = 'positionsActuelles[' + photo.id + ']';
                        inputPositionPhoto.min = 1;
                        // Le max sera mis à jour via mettreAJourMaxDesPositions()
                        inputPositionPhoto.value = photo.position;
                        inputPositionPhoto.classList.add('position-input', 'p-2', 'font-medium', 'rounded-lg', 'bg-c3');

                        const boutonSupprimerPhoto = document.createElement('button');
                        boutonSupprimerPhoto.type = 'button';
                        boutonSupprimerPhoto.className = 'supprimer-photo bg-red-500 text-white p-1 rounded';
                        boutonSupprimerPhoto.innerText = 'Supprimer';
                        boutonSupprimerPhoto.addEventListener('click', function() {
                            divPhoto.remove();
                            // Crée un input caché pour ajouter cet ID au tableau photos_a_supprimer[]
                            const conteneurSuppression = document.getElementById('conteneur_photos_a_supprimer');
                            const inputCache = document.createElement('input');
                            inputCache.type = 'hidden';
                            inputCache.name = 'photos_a_supprimer[]';
                            inputCache.value = photo.id;
                            conteneurSuppression.appendChild(inputCache);
                            // Mettre à jour le nombre de photos actuelles et recalculer le max global
                            const nb = parseInt(document.getElementById('nombrePhotosActuelles').value) || 0;
                            document.getElementById('nombrePhotosActuelles').value = nb - 1;
                            mettreAJourMaxDesPositions();
                        });

                        divPhoto.appendChild(image);
                        divPhoto.appendChild(inputPositionPhoto);
                        divPhoto.appendChild(boutonSupprimerPhoto);
                        conteneurPhotosActuelles.appendChild(divPhoto);
                    });
                    mettreAJourMaxDesPositions();
                    document.getElementById('formulaireActiviteModif').setAttribute('action', `/compte/modifierActivites/${idActivite}`);
                    document.getElementById("afficherActivites").classList.add("hidden");
                    document.getElementById("modifierActivite").classList.remove("hidden");
                })
                .catch(erreur => {
                    console.error("Erreur lors de la récupération de l'activité :", erreur);
                });
        });
    });
});
</script>

<!-- Script de validation du formulaire (vérifie que toutes les positions sont renseignées et uniques) -->
<script>
document.getElementById('formulaireActiviteModif').addEventListener('submit', function(e) {
    console.log('Validation des positions exécutée');
    const inputsPositions = document.querySelectorAll('.position-input');
    let toutRempli = true;
    const valeursPositions = [];

    inputsPositions.forEach(function(input) {
        const valeur = input.value.trim();
        if (valeur === '') {
            toutRempli = false;
            input.classList.add('border-c5');
        } else {
            input.classList.remove('border-c5');
            valeursPositions.push(valeur);
        }
    });

    const positionsUniques = new Set(valeursPositions);
    const doublons = (positionsUniques.size !== valeursPositions.length);

    if (!toutRempli || doublons) {
        e.preventDefault();
        let message = 'Veuillez renseigner la position pour chaque image.';
        if (doublons) {
            message = 'Les positions des images doivent être uniques.';
        }
        Swal.fire({
            icon: 'error',
            title: 'Attention',
            text: message
        });
    }
});
</script>

@if(session('erreurModifierActivite') && session('idActiviteErreur'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const idActiviteErreur = "{{ session('idActiviteErreur') }}";
            if (idActiviteErreur) {
                axios.get(`/compte/obtenirActivite/${idActiviteErreur}`)
                    .then(reponse => {
                        const activite = reponse.data.data;
                        // Ne rafraîchit que la section des photos actuelles
                        const conteneurPhotosActuelles = document.getElementById('positionActuelles');
                        conteneurPhotosActuelles.innerHTML = '';
                        activite.photos.forEach(photo => {
                            const divPhoto = document.createElement('div');
                            divPhoto.className = 'photo-actuelle mb-2 flex items-center gap-2 border p-2 rounded';

                            const image = document.createElement('img');
                            image.src = '/storage/Images/' + photo.chemin;
                            image.alt = photo.nom;
                            image.className = 'w-16 h-16 object-cover rounded';

                            const inputPositionPhoto = document.createElement('input');
                            inputPositionPhoto.type = 'number';
                            inputPositionPhoto.id = 'photo_actuelle_' + photo.id;
                            inputPositionPhoto.name = 'positionsActuelles[' + photo.id + ']';
                            inputPositionPhoto.min = 1;
                            inputPositionPhoto.value = photo.position;
                            inputPositionPhoto.classList.add('position-input', 'p-2', 'font-medium', 'rounded-lg', 'bg-c3');

                            const boutonSupprimerPhoto = document.createElement('button');
                            boutonSupprimerPhoto.type = 'button';
                            boutonSupprimerPhoto.className = 'supprimer-photo bg-red-500 text-white p-1 rounded';
                            boutonSupprimerPhoto.innerText = 'Supprimer';
                            boutonSupprimerPhoto.addEventListener('click', function() {
                                divPhoto.remove();
                                const conteneurSuppression = document.getElementById('conteneur_photos_a_supprimer');
                                const inputCache = document.createElement('input');
                                inputCache.type = 'hidden';
                                inputCache.name = 'photos_a_supprimer[]';
                                inputCache.value = photo.id;
                                conteneurSuppression.appendChild(inputCache);
                                const nb = parseInt(document.getElementById('nombrePhotosActuelles').value) || 0;
                                document.getElementById('nombrePhotosActuelles').value = nb - 1;
                                mettreAJourMaxDesPositions();
                            });

                            divPhoto.appendChild(image);
                            divPhoto.appendChild(inputPositionPhoto);
                            divPhoto.appendChild(boutonSupprimerPhoto);
                            conteneurPhotosActuelles.appendChild(divPhoto);
                        });
                        // Met à jour les max des positions (global)
                        mettreAJourMaxDesPositions();
                    })
                    .catch(erreur => {
                        console.error("Erreur lors du rafraîchissement des photos actuelles :", erreur);
                    });
            }
        });
    </script>
@endif

