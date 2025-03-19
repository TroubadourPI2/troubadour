let boutonsModifier;
let selectQuartierLieuModifie;
let selectVilleLieuModifie;
let selectTypeLieuModifie;
let villeId;
let quartierId;
let typeLieuId;
let divPhotoLieu;
let photoLieuSupprimer;
let inputPhotoModifie;
let lieu;
let lieuSelectionne;
let statutLieuCache;

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        ObtenirElementsModifier();
        AjouterModifierListeners();
        if (selectVilleLieuModifie.value) {
            ObtenirQuartiersParVille(selectVilleLieuModifie.value);

        }
    }, 1000);

    const form = document.getElementById('formModifierLieu');
    form.action = `/compte/modifierLieu/${localStorage.getItem('lieuId')}`;

    const lieuStocke = localStorage.getItem('lieu');
    if (lieuStocke) {
        lieu = JSON.parse(lieuStocke);
        AfficherPhotoLieu(lieu);
    }
});

function ObtenirElementsModifier() {
    boutonsModifier = document.querySelectorAll('.boutonModifier');
    selectQuartierLieuModifie = document.getElementById(
        'selectQuartierLieuModifie'
    );
    selectVilleLieuModifie = document.getElementById('selectVilleLieuModifie');
    selectTypeLieuModifie = document.getElementById('selectTypeLieuModifie');
    divPhotoLieu = document.getElementById('divPhotoLieu');
    photoLieuSupprimer = document.getElementById('photoLieuSupprimer');
    inputPhotoModifie = document.getElementById('photoLieuModifie');
}

function AjouterModifierListeners() {
    boutonsModifier.forEach((bouton) => {
        bouton.addEventListener('click', () => {
            const lieuId = bouton.getAttribute('data-lieuId');
            localStorage.setItem('lieuId', lieuId);
            villeId = bouton.getAttribute('data-villeId');
            typeLieuId = bouton.getAttribute('data-typeLieuId');
            ObtenirLieu(lieuId);
        });
    });

    selectVilleLieuModifie.addEventListener(
        'change',
        ActiverSelectQuartierModifie
    );

    inputPhotoModifie.addEventListener('change', ChangerPhotoChoisie);
}


function ActiverSelectQuartierModifie() {
    if (selectVilleLieuModifie.value != '') {
        selectQuartierLieuModifie.removeAttribute('disabled');
        ObtenirQuartiersParVille(selectVilleLieuModifie.value);
    } else selectQuartierLieuModifie.setAttribute('disabled', '');
}

function MettreAJourSelectQuartierModifie(quartiers) {

    selectQuartierLieuModifie.innerHTML = '';
    const optionDefaut = document.createElement('option');
    optionDefaut.value = '';
    optionDefaut.textContent = Lang.get('strings.choisirQuartier');
    selectQuartierLieuModifie.appendChild(optionDefaut);

    quartiers.forEach((quartier) => {
        const option = document.createElement('option');
        option.value = quartier.id;
        option.textContent = quartier.nom;
        selectQuartierLieuModifie.appendChild(option);
    });

    selectQuartierLieuModifie.removeAttribute('disabled');
    selectQuartierLieuModifie.value = quartierId;
}

function ChangerPhotoChoisie() {
    const file = inputPhotoModifie.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const divPhotoLieu = document.getElementById('divPhotoLieu');
            divPhotoLieu.innerHTML = ''; 

            const divConteneurPhoto = document.createElement('div');
            divConteneurPhoto.className =
                'photo-lieu mb-2 flex items-center w-full gap-2 border border-c1 p-2 rounded justify-between';

            const conteneurGauche = document.createElement('div');
            conteneurGauche.className =
                'flex items-center gap-2 w-full justify-between';

            // Création de l'image de la photo choisie
            const imageLieu = document.createElement('img');
            imageLieu.src = e.target.result;
            imageLieu.alt = file.name;
            imageLieu.className = 'w-16 h-16 object-cover rounded';

            // Création du texte (nom de la photo)
            const titreSpan = document.createElement('span');
            titreSpan.textContent = file.name;
            titreSpan.className = 'inline-block max-w-sm sm:max-w-xs truncate'; 
            titreSpan.style.whiteSpace = 'nowrap'; 
            titreSpan.style.overflow = 'hidden'; 
            titreSpan.style.textOverflow = 'ellipsis'; 

            conteneurGauche.appendChild(imageLieu);
            conteneurGauche.appendChild(titreSpan);

            // Création du bouton de suppression
            const boutonSupprimerPhoto = document.createElement('button');
            boutonSupprimerPhoto.type = 'button';
            boutonSupprimerPhoto.className =
                'supprimer-photo bg-red-500 p-1 rounded';
            boutonSupprimerPhoto.innerHTML = `
                <span class="iconify text-c5 size-6" data-icon="ion:trash-outline" data-inline="true"></span>
            `;

            // Événement au clic sur le bouton de suppression
            boutonSupprimerPhoto.addEventListener('click', function () {
                divConteneurPhoto.remove(); // Supprimer la photo affichée
                document.getElementById('photoLieuSupprime').value = '1'; // Marquer la photo comme supprimée
            });

            // Conteneur pour le bouton de suppression
            const conteneurDroite = document.createElement('div');
            conteneurDroite.className = 'flex items-center gap-2';
            conteneurDroite.appendChild(boutonSupprimerPhoto);

            // Ajouter le conteneur de gauche et de droite dans le conteneur principal
            divConteneurPhoto.appendChild(conteneurGauche);
            divConteneurPhoto.appendChild(conteneurDroite);

            // Ajouter le conteneur principal dans divPhotoLieu
            divPhotoLieu.appendChild(divConteneurPhoto);
        };

        reader.readAsDataURL(file); // Lire le fichier comme URL de données
    }
}

function AfficherPhotoLieu(lieu) {
    const divPhotoLieu = document.getElementById('divPhotoLieu');
    divPhotoLieu.innerHTML = '';

    if (lieu.photoLieu) {
        const divConteneurPhoto = document.createElement('div');
        divConteneurPhoto.className =
            'photo-lieu mb-2 flex items-center w-full gap-2 border border-c1 p-2 rounded justify-between';

        const conteneurGauche = document.createElement('div');
        conteneurGauche.className =
            'flex items-center gap-2 w-full justify-between';

        const imageLieu = document.createElement('img');
        if (lieu.photoLieu.startsWith('data:image')) {
            imageLieu.src = lieu.photoLieu;
        } else {
            imageLieu.src = `/storage/Images/${lieu.photoLieu}`;
        }
        imageLieu.alt = lieu.photoLieu;
        imageLieu.className = 'w-16 h-16 object-cover rounded';

        const titreSpan = document.createElement('span');
        titreSpan.textContent = lieu.photoLieu;
        titreSpan.className = 'inline-block max-w-sm sm:max-w-xs truncate';

        conteneurGauche.appendChild(imageLieu);
        conteneurGauche.appendChild(titreSpan);

        const boutonSupprimerPhoto = document.createElement('button');
        boutonSupprimerPhoto.type = 'button';
        boutonSupprimerPhoto.className =
            'supprimer-photo bg-red-500 p-1 rounded';
        boutonSupprimerPhoto.innerHTML = `
            <span class="iconify text-c5 size-6" data-icon="ion:trash-outline" data-inline="true"></span>
        `;

        boutonSupprimerPhoto.addEventListener('click', function () {
            divConteneurPhoto.remove();
            document.getElementById('photoLieuSupprime').value = '1';
        });

        conteneurGauche.appendChild(boutonSupprimerPhoto);
        divConteneurPhoto.appendChild(conteneurGauche);

        divPhotoLieu.appendChild(divConteneurPhoto);
    }
}

async function ObtenirLieu(lieuId) {
    try {
        const response = await fetch(`/compte/obtenirLieu?lieu_id=${lieuId}`, {
            method: 'GET',
            headers: { Accept: 'application/json' }
        });

        if (!response.ok) {
            const errorResponse = await response.json();
            throw new Error(errorResponse.message);
        }

        const result = await response.json();
        const lieu = result.data;

        localStorage.setItem('lieu', JSON.stringify(lieu));

        // Fonction dans AfficherAjouterLieux.js
        ObtenirQuartiersParVille(villeId);
        ChangerSection(modifierLieu, afficherLieux);

        document.getElementById('nomEtablissementModifie').value = lieu.nomEtablissement;
        document.getElementById('rueModifie').value = lieu.rue;
        document.getElementById('noCivicModifie').value = lieu.noCivic;
        document.getElementById('codePostalModifie').value = lieu.codePostal;
        document.getElementById('descriptionModifie').value = lieu.description;
        document.getElementById('siteWebModifie').value = lieu.siteWeb;
        document.getElementById('numeroTelephoneModifie').value = lieu.numeroTelephone;
        document.getElementById('selectVilleLieuModifie').value = villeId;
        await ObtenirQuartiersParVille(villeId);
        selectQuartierLieuModifie.value = lieu.quartier_id;
        document.getElementById('selectTypeLieuModifie').value = lieu.typeLieu_id;
        inputPhotoModifie.value = '';
        const form = document.getElementById('formModifierLieu');
        form.action = `/compte/modifierLieu/${lieuId}`;

        AfficherPhotoLieu(lieu);

    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: Lang.get('strings.erreur'),
            text: error.message ,
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
    }
}
