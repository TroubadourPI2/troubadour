let selectQuartier;
let selectVilleLieu;

document.addEventListener('DOMContentLoaded', function () {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsAjouterQuartiers();
});

function ObtenirElementsAjouterQuartiers() {
    selectVille = document.getElementById('selectVille');
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
