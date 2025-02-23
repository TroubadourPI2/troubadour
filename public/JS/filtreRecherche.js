var selectQuartierMobile = document.getElementById('selectQuartierMobile');
let btnRechercherMobile = document.getElementById('btnRechercherMobile');
var selectVilleMobile = document.getElementById('selectVilleMobile');
let btnRechercherPC = document.getElementById('btnRechercherPC');
var selectQuartier = document.getElementById('selectQuartier');
var selectVille = document.getElementById('selectVille');

let optionDefault = document.createElement('option');
optionDefault.text = 'Choisissez un quartier';
optionDefault.value = 'default';

function ajusterEtatBoutonRecherche(page){
    if (page === 'PC') {
        btnRechercherPC.disabled = (
            selectQuartier.value === 'default' ||
            selectVille.value === 'default' ||
            selectQuartier.value === 'aucunResultat' ||
            selectVille.value === 'aucunResultat' ||
            selectQuartier.value === ''
        );

    } else if (page === 'Mobile') {
        btnRechercherMobile.disabled = (
            selectQuartierMobile.value === 'default' ||
            selectVilleMobile.value === 'default' ||
            selectQuartierMobile.value === 'aucunResultat' ||
            selectVilleMobile.value === 'aucunResultat' ||
            selectQuartierMobile.value === '');
    }
}

selectQuartier.addEventListener('change', function () {
    ajusterEtatBoutonRecherche('PC');
});
selectQuartierMobile.addEventListener('change', function () {
    ajusterEtatBoutonRecherche('Mobile');
});

function setQuartiersPC() {
    let idVille = selectVille.value;

    ajusterEtatBoutonRecherche('PC');
    deleteAll('PC');

    if (idVille !== 'default') {
        ajusterEtatBoutonRecherche('PC');

        axios
            .get(`/quartiers?villeId=${idVille}`)
            .then((response) => {
                let quartiers = response.data;
                let listeQuartiers = quartiers.quartiers;

                listeQuartiers.forEach((quartier) => {
                    let option = document.createElement('option');
                    option.text = quartier.nom;
                    option.value = quartier.id;
                    selectQuartier.add(option);
                });
            })
            .catch((error) =>
                console.error('Error fetching quartiers:', error)
            );

        
        ajusterEtatBoutonRecherche('PC');
    }

    ajusterEtatBoutonRecherche('PC');
}

function deleteAll(page) {
    if (page === 'PC') {
        while (selectQuartier.options.length > 0) {
            selectQuartier.options.remove(0);
        }

        selectQuartier.add(optionDefault);
    } else if (page === 'Mobile') {
        while (selectQuartierMobile.options.length > 0) {
            selectQuartierMobile.options.remove(0);
        }

        selectQuartierMobile.add(optionDefault);
    }
}

function setQuartiersMobile() {
    let idVille = selectVilleMobile.value;

    ajusterEtatBoutonRecherche('Mobile');
    deleteAll('Mobile');

    if (idVille !== 'default') {
        ajusterEtatBoutonRecherche('Mobile');

        axios
            .get(`/quartiers?villeId=${idVille}`)
            .then((response) => {
                let quartiers = response.data;
                let listeQuartiersMobile = quartiers.quartiers;

                listeQuartiersMobile.forEach((quartier) => {
                    let option = document.createElement('option');
                    option.text = quartier.nom;
                    option.value = quartier.id;
                    selectQuartierMobile.add(option);
                });
            })
            .catch((error) =>
                console.error('Error fetching quartiers:', error)
            );

        ajusterEtatBoutonRecherche('Mobile');
    }
    ajusterEtatBoutonRecherche('Mobile');
}


