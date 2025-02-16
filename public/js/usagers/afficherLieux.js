let carteLieuxMobileDevant;
let carteLieuxMobileDerriere;
let carteLieuxMobile;

document.addEventListener("DOMContentLoaded", function () {
    ObtenirCartesLieux();
    AjouterCarterLieuxListeners();
});

function ObtenirCartesLieux() {
    carteLieuxMobileDevant = document.getElementById("carteLieuxMobileDevant");
    carteLieuxMobileDerriere = document.getElementById("carteLieuxMobileDerriere");
    carteLieuxMobile = document.getElementById("carteLieuxMobile");
}

function AjouterCarterLieuxListeners() {
    carteLieuxMobile.addEventListener("click", TournerCarteLieux);
    
    let boutons = carteLieuxMobileDerriere.querySelectorAll("button");
    boutons.forEach(bouton => {
        bouton.addEventListener("click", function(event) {
            event.stopPropagation();
        });
    });
}

function TournerCarteLieux() {
    carteLieuxMobile.classList.toggle("[transform:rotateY(180deg)]");
}
