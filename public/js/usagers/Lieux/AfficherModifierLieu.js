let boutonsModifierMobile;
let boutonsModifierWeb;
let selectQuartierLieuModifie;
let selectVilleLieuModifie;
let selectTypeLieuModifie;
let villeId;
let quartierId;
let typeLieuId;

document.addEventListener("DOMContentLoaded", function () {
    ObtenirElementsModifier();
    AjouterModifierListeners();
    if (selectVilleLieuModifie.value) {
        ObtenirQuartiersParVille(selectVilleLieuModifie.value);
    }
});

function ObtenirElementsModifier() {
    boutonsModifierMobile = document.querySelectorAll(".modifierMobile");
    boutonsModifierWeb = document.querySelectorAll(".modifierWeb");
    selectQuartierLieuModifie = document.getElementById(
        "selectQuartierLieuModifie"
    );
    selectVilleLieuModifie = document.getElementById("selectVilleLieuModifie");
    selectTypeLieuModifie = document.getElementById("selectTypeLieuModifie");
}

function AjouterModifierListeners() {
    boutonsModifierMobile.forEach((bouton) => {
        bouton.addEventListener("click", () => {
            const lieuId = bouton.getAttribute("data-lieuId");
            villeId = bouton.getAttribute("data-villeId");
            typeLieuId = bouton.getAttribute("data-typeLieuId");
            ObtenirLieu(lieuId);
            //Fonction dans AfficherAjouterLieux.js
            ObtenirQuartiersParVille(villeId);
            ChangerSection(modifierLieu, afficherLieux);
        });
    });

    boutonsModifierWeb.forEach((bouton) => {
        bouton.addEventListener("click", () => {
            const lieuId = bouton.getAttribute("data-lieuId");
            villeId = bouton.getAttribute("data-villeId");
            typeLieuId = bouton.getAttribute("data-typeLieuId");
            ObtenirLieu(lieuId);
            //Fonction dans AfficherAjouterLieux.js
            ObtenirQuartiersParVille(villeId);
            ChangerSection(modifierLieu, afficherLieux);
        });
    });

    selectVilleLieuModifie.addEventListener(
        "change",
        ActiverSelectQuartierModifie
    );
}

function ActiverSelectQuartierModifie() {
    if (selectVilleLieuModifie.value != "") {
        selectQuartierLieuModifie.removeAttribute("disabled");
        ObtenirQuartiersParVille(selectVilleLieuModifie.value);
    } else selectQuartierLieuModifie.setAttribute("disabled", "");
}

function MettreAJourSelectQuartierModifie(quartiers) {
    selectQuartierLieuModifie.innerHTML = "";
    const optionDefaut = document.createElement("option");
    optionDefaut.value = "";
    optionDefaut.textContent = "Sélectionner un quartier";
    selectQuartierLieuModifie.appendChild(optionDefaut);

    quartiers.forEach((quartier) => {
        const option = document.createElement("option");
        option.value = quartier.id;
        option.textContent = quartier.nom;
        selectQuartierLieuModifie.appendChild(option);
    });

    selectQuartierLieuModifie.removeAttribute("disabled");
    selectQuartierLieuModifie.value = quartierId;
}

async function ObtenirLieu(lieuId) {
    try {
        const response = await fetch(`/compte/obtenirLieu?lieu_id=${lieuId}`, {
            method: "GET",
            headers: {
                Accept: "application/json"
            }
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }

        const lieu = await response.json();

        document.getElementById("nomEtablissementModifie").value =
            lieu.nomEtablissement;
        document.getElementById("rueModifie").value = lieu.rue;
        document.getElementById("noCivicModifie").value = lieu.noCivic;
        document.getElementById("codePostalModifie").value = lieu.codePostal;
        document.getElementById("descriptionModifie").value = lieu.description;
        document.getElementById("siteWebModifie").value = lieu.siteWeb;
        document.getElementById("numeroTelephoneModifie").value =
            lieu.numeroTelephone;

        selectVilleLieuModifie.value = villeId;
        selectTypeLieuModifie.value = typeLieuId;
        quartierId = lieu.quartier_id;

        const form = document.getElementById("formModifierLieu");
        form.action = form.action.replace(/\/(\d+)$/, `/${lieuId}`);
        
    } catch (error) {
        console.error(error);
    }
}
