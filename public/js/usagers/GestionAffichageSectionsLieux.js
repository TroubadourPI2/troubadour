let boutonAjouterLieu;
let boutonRetourAfficherLieux;
let boutonAnnuler;
let boutonsModifierMobile;
let boutonsModifierWeb;
let modifierLieu;
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
    boutonAnnuler = document.getElementById("boutonAnnuler");
    boutonsModifierMobile = document.querySelectorAll(".modifierMobile");
    boutonsModifierWeb = document.querySelectorAll(".modifierWeb");
    ajouterLieu = document.getElementById("ajouterLieu");
    afficherLieux = document.getElementById("afficherLieux");
    modifierLieu = document.getElementById("modifierLieu");
    selectQuartier = document.getElementById("selectQuartierLieu");
    selectVilleLieu = document.getElementById("selectVilleLieu");
    console.log(ajouterLieu)
}

function AjouterLieuxListeners() {
    boutonAjouterLieu?.addEventListener("click", () => toggleSection(ajouterLieu, afficherLieux));
    boutonAnnuler?.addEventListener("click", () => toggleSection(afficherLieux, ajouterLieu));
    boutonRetourAfficherLieux?.addEventListener("click", () => toggleSection(afficherLieux, ajouterLieu));
    console.log(afficherLieux);
    boutonsModifierMobile.forEach(bouton => {
        bouton.addEventListener("click", () => {
            const lieuId = bouton.getAttribute("data-lieu-id"); // Récupère l'id du lieu
            ObtenirLieu(lieuId); // Appelle la fonction ObtenirLieu avec l'id du lieu
            toggleSection(modifierLieu, afficherLieux); // Affiche le formulaire de modification
        });
    });

    boutonsModifierWeb.forEach(bouton => {
        bouton.addEventListener("click", () => {
            const lieuId = bouton.getAttribute("data-lieu-id"); // Récupère l'id du lieu
            ObtenirLieu(lieuId); // Appelle la fonction ObtenirLieu avec l'id du lieu
            toggleSection(modifierLieu, afficherLieux); // Affiche le formulaire de modification
        });
    });

    selectVilleLieu.addEventListener("change", ActiverSelectQuartier);
}

function toggleSection(sectionAfficher, sectionCacher) {
    sectionAfficher.classList.remove("hidden");
    sectionCacher.classList.add("hidden");
}

function ActiverSelectQuartier() {
    if (!selectVilleLieu || !selectQuartier) return;

    const villeId = selectVilleLieu.value;
    selectQuartier.disabled = !villeId;

    if (villeId) {
        ObtenirQuartiersParVille(villeId);
    }
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

async function ObtenirLieu(lieuId){
    try {
        const response = await fetch(`/compte/obtenirLieu?lieu_id=${lieuId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }

        const lieu = await response.json();
       console.log(lieu);

    } catch (error) {
        console.error(error);
    }
}