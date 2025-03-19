function MettreAJourMaxDesPositions() {
   
    const nbPhotosActuelles = parseInt(document.getElementById('nombrePhotosActuelles').value) || 0;
    const nouveauxInputs = document.querySelectorAll('#positionInputsModif .position-input');
    const nbNouvelles = nouveauxInputs.length;
    const totalPhotos = nbPhotosActuelles + nbNouvelles;

    nouveauxInputs.forEach(input => {
        input.max = totalPhotos;
    });
   
    const existantsInputs = document.querySelectorAll('#positionActuelles .position-input');
    existantsInputs.forEach(input => {
        input.max = totalPhotos;
    });
}

function MettreAJourSectionPhotos(activite) {
    const nbActuelles = activite.photos.length;
    document.getElementById('nombrePhotosActuelles').value = nbActuelles;

    const conteneurPhotosActuelles = document.getElementById('positionActuelles');
    conteneurPhotosActuelles.innerHTML = '';

    activite.photos.forEach(photo => {
 
        const divPhoto = document.createElement('div');
        divPhoto.className = 'photo-actuelle mb-2 flex items-center  gap-2 border border-c1 p-2 rounded justify-between';

   
        const conteneurGauche = document.createElement('div');
        conteneurGauche.className = 'flex items-center gap-2';

        const image = document.createElement('img');
        image.src = '/storage/Images/' + photo.chemin;
        image.alt = photo.nom;
        image.className = 'w-16 h-16 object-cover rounded';


        const titreSpan = document.createElement('span');
        titreSpan.textContent = photo.nom;
        titreSpan.className = 'inline-block max-w-sm hidden sm:flex truncate';
       
        titreSpan.setAttribute('title', photo.nom);

        conteneurGauche.appendChild(image);
        conteneurGauche.appendChild(titreSpan);

    
        const conteneurDroite = document.createElement('div');
        conteneurDroite.className = 'flex items-center gap-2';

        const inputPositionPhoto = document.createElement('input');
        inputPositionPhoto.type = 'number';
        inputPositionPhoto.id = 'photo_actuelle_' + photo.id;
        inputPositionPhoto.name = 'positionsActuelles[' + photo.id + ']';
        inputPositionPhoto.min = 1;
        inputPositionPhoto.value = photo.position;
        inputPositionPhoto.classList.add('position-input', 'p-2', 'font-medium', 'rounded-lg', 'bg-c3');

        const boutonSupprimerPhoto = document.createElement('button');
        boutonSupprimerPhoto.type = 'button';
        boutonSupprimerPhoto.className = 'supprimer-photo bg-red-500 p-1 rounded';
        boutonSupprimerPhoto.style.backgroundColor = '#ef4444'; // si besoin de forcer la couleur
        boutonSupprimerPhoto.innerHTML = `
            <span class="iconify text-white" data-icon="mdi:trash-can" data-inline="true"></span>
        `;

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
            MettreAJourMaxDesPositions();
        });

        conteneurDroite.appendChild(inputPositionPhoto);
        conteneurDroite.appendChild(boutonSupprimerPhoto);

        // Ajouter les deux conteneurs (gauche et droite) au div principal
        divPhoto.appendChild(conteneurGauche);
        divPhoto.appendChild(conteneurDroite);

        conteneurPhotosActuelles.appendChild(divPhoto);
    });

    MettreAJourMaxDesPositions();
}


document.getElementById('formulaireActiviteModif').addEventListener('submit', function(e) {
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
            valeursPositions.push(parseInt(valeur, 10));
        }
    });

    const positionsUniques = new Set(valeursPositions);
    const doublons = (positionsUniques.size !== valeursPositions.length);

    valeursPositions.sort((a, b) => a - b);
    let estSequentiel = true;
    for (let i = 0; i < valeursPositions.length; i++) {
        if (valeursPositions[i] !== i + 1) {
            estSequentiel = false;
            break;
        }
    }

    if (!toutRempli || doublons || !estSequentiel) {
        e.preventDefault();
        let message = Lang.get('validations.photoPositionRequise');
        if (doublons) {
            message = Lang.get('validations.photoPositionDistinct');
        } else if (!estSequentiel) {
            message = Lang.get('validations.positionsSequentielle');
        }

        Swal.fire({
            icon: 'error',
            title: Lang.get('strings.attention'),
            text: message
        });
    }
});


document.addEventListener('DOMContentLoaded', () => {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    document.querySelectorAll('.boutonModifierActivite').forEach(bouton => {
        bouton.addEventListener('click', function() {
            const idActivite = this.getAttribute('data-activite-id');
     

            axios.get(`/compte/obtenirActivite/${idActivite}`)
                .then(reponse => {
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

                
                    document.getElementById('conteneur_photos_a_supprimer').innerHTML = '';

               
                    MettreAJourSectionPhotos(activite);

                 
                    document.getElementById('formulaireActiviteModif').setAttribute('action', `/compte/modifierActivites/${idActivite}`);
                    document.getElementById("afficherActivites").classList.add("hidden");
                    document.getElementById("modifierActivite").classList.remove("hidden");
                    
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: Lang.get('strings.erreur'),
                        text:  error.response.data.message,  
                        customClass: {
                            popup: 'font-barlow text-xl text-c1 bg-c2',
                            title: 'text-3xl uppercase underline',
                            confirmButton: 'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
                        },
                        didOpen: () => {
                            const xMarkLeft = document.querySelector('.swal2-x-mark-line-left');
                            const xMarkRight = document.querySelector('.swal2-x-mark-line-right');
                    
                            if (xMarkLeft && xMarkRight) {
                                xMarkLeft.style.backgroundColor = '#154C51'; 
                                xMarkRight.style.backgroundColor = '#154C51'; 
                            }
                        }
                    });
                });
        });
    });
});
document.getElementById('photosModif').addEventListener('change', function() {
    const conteneurPositions = document.getElementById('positionInputsModif');
    conteneurPositions.innerHTML = '';
    const fichiers = this.files;
    
    for (let i = 0; i < fichiers.length; i++) {
        const fichier = fichiers[i];
        const div = document.createElement('div');
        div.className = 'mb-2';
        
        const label = document.createElement('label');
        label.setAttribute('for', 'photos_modif_' + i);
        label.className = 'block text-sm';
        label.innerText =  Lang.get('strings.positionPour')+" "  + fichier.name;
        
        const input = document.createElement('input');
        input.type = 'number';
        input.id = 'photos_modif_' + i;
        input.name = 'photos[' + i + '][position]';
        input.min = 1;
   
        input.classList.add('position-input','p-2','font-medium','rounded-lg','bg-c3');
        
        div.appendChild(label);
        div.appendChild(input);
        conteneurPositions.appendChild(div);
    }
    
    MettreAJourMaxDesPositions();
});


