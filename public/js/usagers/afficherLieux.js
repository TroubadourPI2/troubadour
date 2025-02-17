let carteLieuMobileDerriere;
let carteLieuxMobile;

document.addEventListener("DOMContentLoaded", function () {
    ObtenirCartesLieux();
    AjouterCarterLieuxListeners();
});

function ObtenirCartesLieux() {
    carteLieuxMobile = document.querySelectorAll(".carteLieuxMobile");
}

function AjouterCarterLieuxListeners() {
    carteLieuxMobile.forEach((carte) => {
        carte.addEventListener("click", () => TournerCarteLieux(carte));
        carteLieuMobileDerriere = carte.querySelector(
            ".carteLieuxMobileDerriere"
        );

        let boutons = carteLieuMobileDerriere.querySelectorAll("button");
        boutons.forEach((bouton) => {
            bouton.addEventListener("click", function (event) {
                event.stopPropagation();
            });
        });
    });
}

function TournerCarteLieux(carte) {
    carte.classList.toggle("[transform:rotateY(180deg)]");
}
