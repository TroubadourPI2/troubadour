//sectionsMenuCompte défini dans GestionAffichageMenu.js
let boutonAjouterLieu;
let ajouterLieu;
let boutomnRetourAfficherLieux;

document.addEventListener("DOMContentLoaded", function () {
    ObtenirElements1();
    AjouterMenuListeners1();
});


function ObtenirElements1() {
    boutonAjouterLieu = document.getElementById('boutonAjouterLieu');
    ajouterLieu = document.getElementById('ajouterLieu');
    console.log(boutonAjouterLieu);
    boutomnRetourAfficherLieux = document.getElementById('boutonRetourAfficherLieux');
}

function AjouterMenuListeners1() {
    boutonAjouterLieu.addEventListener("click", function () {
        console.log("click");
        ajouterLieu.classList.remove("hidden");
        boutomnRetourAfficherLieux.classList.add("hidden");
    }); 
}
