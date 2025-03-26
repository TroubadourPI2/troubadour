let selectQuartier;
let selectVilleLieu;
let inputPhotoLieu;

document.addEventListener('DOMContentLoaded', function () {
    ObtenirElementsAjouterLieux();
    AjouterLieuxListeners();
});

function ObtenirElementsAjouterLieux() {
    selectQuartier = document.getElementById('selectQuartierLieu');
    selectVilleLieu = document.getElementById('selectVilleLieu');
    inputPhotoLieu = document.getElementById('photoLieu');
}

function AjouterLieuxListeners() {
    if (selectVilleLieu)
        selectVilleLieu.addEventListener('change', ActiverSelectQuartier);

    if(inputPhotoLieu){
        inputPhotoLieu.addEventListener('change', function(event) {
            VerifierTailleEtTypePhoto(event);
        });
    }
        
}

function ActiverSelectQuartier() {
    if (selectVilleLieu.value != '') {
        selectQuartier.removeAttribute('disabled');
        ObtenirQuartiersParVille(selectVilleLieu.value);
    } else selectQuartier.setAttribute('disabled', '');
}

async function ObtenirQuartiersParVille(villeId) {
    try {
        const response = await fetch(
            `/compte/obtenirQuartiers?ville_id=${villeId}`,
            {
                method: 'GET',
                headers: {
                    Accept: 'application/json'
                }
            }
        );

        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }

        const quartiers = await response.json();
        if (selectQuartier) MettreAJourSelectQuartier(quartiers);
        if (selectQuartierLieuModifie) {
            //Fonction dans le fichier public/js/usagers/Lieux/AfficherModifierLieu.js
            MettreAJourSelectQuartierModifie(quartiers);
            //Fonction dans le fichier public/js/admin/RechercheLieux.js
            MettreAJourRechercheQuartier(quartiers);
        }
    } catch (error) {
        console.error(error);
    }
}

function MettreAJourSelectQuartier(quartiers) {
    selectQuartier.innerHTML = '';

    const optionDefaut = document.createElement('option');
    optionDefaut.value = '';
    optionDefaut.textContent = Lang.get('strings.choisirQuartier');
    selectQuartier.appendChild(optionDefaut);

    quartiers.forEach((quartier) => {
        const option = document.createElement('option');
        option.value = quartier.id;
        option.textContent = quartier.nom;
        selectQuartier.appendChild(option);
    });

    selectQuartier.removeAttribute('disabled');
}

function VerifierTailleEtTypePhoto(event){
    const tailleMax = 2 * 1024 * 1024; 
    const photo = event.target.files[0];
    if (photo && !(photo.type=== 'image/jpeg' || photo.type === 'image/png')){
        Swal.fire({
            icon: 'error',
            title: Lang.get('strings.erreur'),
            text: Lang.get('validations.photoLieuFormat'),
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
        if(inputPhotoLieu){
            inputPhotoLieu.value = '';
            inputPhotoLieu.innerHTML = '';
        }
        if(inputPhotoModifie){
            inputPhotoModifie.value = '';
            inputPhotoModifie.innerHTML = '';
        }
      
        return false;
    }
    if (photo && photo.size > tailleMax) {
        Swal.fire({
            icon: 'error',
            title: Lang.get('strings.erreur'),
            text: Lang.get('validations.photoLieuMax'), 
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
        if(inputPhotoLieu){
            inputPhotoLieu.value = '';
            inputPhotoLieu.innerHTML = '';
        }
        if(inputPhotoModifie){
            inputPhotoModifie.value = '';
            inputPhotoModifie.innerHTML = '';
        }
        return false;
    }
    return true;
}