let boutonAjouterLieu;
let boutonRetourAfficherLieux;
let boutonRetourLieux;
let boutonAnnuler;
let boutonAnnulerModifier
let modifierLieu;
let ajouterLieu;
let afficherLieux;

let carteLieuMobileDerriere;
let carteLieuxMobile;


document.addEventListener("DOMContentLoaded", function () {
    ObtenirElementsLieux();
    AjouterGestionAffichageListeners();
});

function ObtenirElementsLieux() {
    carteLieuxMobile = document.querySelectorAll('.carteLieuxMobile');
    boutonAjouterLieu = document.getElementById("boutonAjouterLieu");
    boutonRetourAfficherLieux = document.getElementById("boutonRetourAfficherLieux");
    boutonRetourLieux = document.getElementById("boutonRetourLieux");
    boutonAnnuler = document.getElementById("boutonAnnuler");
    boutonAnnulerModifier = document.getElementById("boutonAnnulerModifier");
    ajouterLieu = document.getElementById("ajouterLieu");
    afficherLieux = document.getElementById("afficherLieux");
    modifierLieu = document.getElementById("modifierLieu");
}

function AjouterGestionAffichageListeners() {
    boutonAjouterLieu.addEventListener("click", () => ChangerSection(ajouterLieu, afficherLieux));
    boutonAnnuler.addEventListener("click", () => ChangerSection(afficherLieux, ajouterLieu));
    boutonRetourAfficherLieux.addEventListener("click", () => ChangerSection(afficherLieux, ajouterLieu));
    boutonRetourLieux.addEventListener("click", () => ChangerSection(afficherLieux, modifierLieu));
    boutonAnnulerModifier.addEventListener("click", () => ChangerSection(afficherLieux, modifierLieu));
    carteLieuxMobile.forEach((carte) => {
        carte.addEventListener("click", () => TournerCarteLieux(carte));
        carteLieuMobileDerriere = carte.querySelector('.carteLieuxMobileDerriere');

        let boutons = carteLieuMobileDerriere.querySelectorAll('button');
        boutons.forEach((bouton) => {
            bouton.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
    });
}

function TournerCarteLieux(carte) {
    carte.classList.toggle('[transform:rotateY(180deg)]');
}

function ChangerSection(sectionAfficher, sectionCacher) {
    sectionAfficher.classList.remove("hidden");
    sectionCacher.classList.add("hidden");
}
