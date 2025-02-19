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

function ActiverSelectQuartier(){
   if(selectVilleLieu.value != "")
    selectQuartier.removeAttribute("disabled");
   else{
    selectQuartier.setAttribute("disabled", "");
    console.log("ici")
   }
    
}