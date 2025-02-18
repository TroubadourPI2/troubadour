let boutonAjouterLieu;
let boutonRetourAfficherLieux;
let ajouterLieu;
let afficherLieux;

document.addEventListener("DOMContentLoaded", function () {
    ObtenirElementsMenuLieux();
    AjouterMenuLieuxListeners();
});


function ObtenirElementsMenuLieux() {
    boutonAjouterLieu = document.getElementById('boutonAjouterLieu');
    boutonRetourAfficherLieux = document.getElementById('boutonRetourAfficherLieux');
    ajouterLieu = document.getElementById('ajouterLieu');
    afficherLieux = document.getElementById('afficherLieux');
}

function AjouterMenuLieuxListeners() {
    boutonAjouterLieu.addEventListener("click", AfficherSectionAjouterLieu);
    boutonRetourAfficherLieux.addEventListener("click", AfficherSectionAfficherLieu);
}

function AfficherSectionAjouterLieu(){
    ajouterLieu.classList.remove("hidden");
    afficherLieux.classList.add("hidden");
    boutonAjouterLieu.classList.add("hidden");
}

function AfficherSectionAfficherLieu(){
    ajouterLieu.classList.add("hidden");
    afficherLieux.classList.remove("hidden");
    boutonAjouterLieu.classList.remove("hidden");
}