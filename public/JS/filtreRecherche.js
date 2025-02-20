// const { document } = require("postcss");

let selectVille;
let selectQuartier;
let selectQuartierMobile;
let selectVilleMobile;

let btnRechercher = document.getElementById('btnRechercher');

function elementEstVisible(element) {
    return element.classList.contains('hidden') ||
           element.classList.contains('invisible') ||
           element.classList.contains('opacity-0');
  }

function checkQuartier() {
    if(selectQuartierMobile.value !== "default" && selectVilleMobile.value !== "default" && selectQuartierMobile.value !== "aucunResultat" && selectVilleMobile.value !== "aucunResultat" || selectQuartier.value !== "default" && selectVille.value !== "default" && selectQuartier.value !== "aucunResultat" && selectVille.value !== "aucunResultat")
    {
        btnRechercher.disabled = false;
    } 
    else 
    {
        btnRechercher.disabled = true;
    }
    // else if (selectVilleMobile.style.display === "none") 
    // {
    //     if(selectQuartier.value !== "default" && selectVille.value !== "default" && selectQuartier.value !== "aucunResultat" && selectVille.value !== "aucunResultat")
    //     {
    //         btnRechercher.disabled = false;
    //     }
    //     else 
    //     { 
    //         btnRechercher.disabled = true;
    //     }
    // }
}


let optionDefault;

document.addEventListener('DOMContentLoaded', function () {
    console.log("DOM loaded");
    selectVille             = document.getElementById('selectVille');
    selectQuartier          = document.getElementById('selectQuartier');
    selectQuartierMobile    = document.getElementById('selectQuartierMobile');
    selectVilleMobile       = document.getElementById('selectVilleMobile');
    checkQuartier();
});

function setQuartiersPC() {
    let idVille = selectVille.value;
    let optionsExistants = selectQuartier.options;

    deleteAll(selectQuartier);

    if (idVille !== "default") {

        checkQuartier();

        selectQuartier.disabled = false;
        console.log("idVille: ", idVille);

        axios.get(`/quartiers?villeId=${idVille}`)
            .then(response => {
                let quartiers = response.data;
                console.log("quartiers : ", quartiers);

                let listeQuartiers = quartiers.quartiers;
                console.log("listeQuartiers : ", listeQuartiers);

                listeQuartiers.forEach(quartier => {
                    let option = document.createElement("option");
                    option.text = quartier.nom;
                    option.value = quartier.id;
                    selectQuartier.add(option);
                });
            })
            .catch(error => console.error('Error fetching quartiers:', error));
    }

    checkQuartier();
}

function deleteAll(element) {
    console.log("deleteAll");
    console.log("selectQuartier options : ", selectQuartier.options);
    if(selectQuartier.options !== undefined)
    {
        while(selectQuartier.options.length > 0){
            selectQuartier.options.remove(0);
        }
    }

}

function setQuartiersMobile(){
    let idVille = selectQuartierMobile.value;
    let optionsExistants = selectQuartierMobile.options;

    deleteAllMobile(selectQuartierMobile);

    if (idVille !== "default") {
        axios.get(`/quartiers?villeId=${idVille}`)
            .then(response => {
                let quartiers = response.data.quartiers;

                // let listeQuartiers = quartiers.quartiers;

                quartiers.forEach(quartier => {
                    let option = document.createElement("option");
                    option.text = quartier.nom;
                    option.value = quartier.id;
                    selectQuartierMobile.add(option);
                });
            })
            .catch(error => console.error('Error fetching quartiers:', error));
    }
    else {
        // selectQuartierMobile.add(optionDefault);
    }

    checkQuartier();
}
