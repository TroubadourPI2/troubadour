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
   if(selectVilleLieu.value != ""){
    selectQuartier.removeAttribute("disabled");
    test();
   }
    
   else
    selectQuartier.setAttribute("disabled", "");
}

async function test(){
    let quartier = await ObtenirQuartiersParVille(selectQuartier.value);
    console.log(quartier);
  }

async function ObtenirQuartiersParVille(villeId){
    const response = await fetch('/compte/obtenirQuartiers', {
        method : 'POST',
        headers :{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('[name="_token"]').getAttribute('value')
        },
        body : JSON.stringify({ville_id : villeId})
    })
    console.log(response);
    const data = await response.json();
    return data.quartiers;
}