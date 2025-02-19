let boutonAjouterLieu;
let boutonRetourAfficherLieux;
let ajouterLieu;
let afficherLieux;
let selectQuartier;
let selectVilleLieu;

document.addEventListener("DOMContentLoaded", function () {
    ObtenirElementsAjouterLieux();
    AjouterLieuxListeners();
});


function ObtenirElementsAjouterLieux() {
    boutonAjouterLieu = document.getElementById("boutonAjouterLieu");
    boutonRetourAfficherLieux = document.getElementById("boutonRetourAfficherLieux");
    ajouterLieu = document.getElementById("ajouterLieu");
    afficherLieux = document.getElementById("afficherLieux");
    selectQuartier = document.getElementById("selectQuartierLieu");
    selectVilleLieu = document.getElementById("selectVilleLieu");
}

function AjouterLieuxListeners() {
    boutonAjouterLieu.addEventListener("click", AfficherSectionAjouterLieu);
    boutonRetourAfficherLieux.addEventListener("click", AfficherSectionAfficherLieu);
    selectVilleLieu.addEventListener("change", ActiverSelectQuartier)
}

function AfficherSectionAjouterLieu() {
    ajouterLieu.classList.remove("hidden");
    afficherLieux.classList.add("hidden");
    boutonAjouterLieu.classList.add("hidden");
}

function AfficherSectionAfficherLieu() {
    ajouterLieu.classList.add("hidden");
    afficherLieux.classList.remove("hidden");
    boutonAjouterLieu.classList.remove("hidden");
}

function ActiverSelectQuartier() {
    if (selectVilleLieu.value != "") {
        selectQuartier.removeAttribute("disabled");
        ObtenirQuartiersParVille(selectVilleLieu.value);
    }
    else
        selectQuartier.setAttribute("disabled", "");
}


async function ObtenirQuartiersParVille(villeId) {
    try {
        const response = await fetch(`/compte/obtenirQuartiers?ville_id=${villeId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }

        const quartiers = await response.json();
        MettreAJourSelectQuartier(quartiers);

    } catch (error) {
        console.error(error);
    }
}

function MettreAJourSelectQuartier(quartiers) {
    selectQuartier.innerHTML = "";

    const optionDefaut = document.createElement("option");
    optionDefaut.value = "";
    optionDefaut.textContent = "Sélectionner un quartier";
    selectQuartier.appendChild(optionDefaut);

    quartiers.forEach(quartier => {
        const option = document.createElement("option");
        option.value = quartier.id;
        option.textContent = quartier.nom;
        selectQuartier.appendChild(option);
    });

    selectQuartier.removeAttribute("disabled");
}
