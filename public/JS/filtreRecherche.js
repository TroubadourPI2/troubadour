let selectVille = document.getElementById('selectVille');
let nbOptions = selectQuartier.length;


let optionDefault = document.createElement("option");
optionDefault.text = "Choisir un quartier";
optionDefault.value = "default";
optionDefault.disabled = true;
optionDefault.selected = true;
optionDefault.hidden = true;
// selectQuartier.add(optionDefault);

// selectVille.addEventListener('change', setQuartiersPC);

function setQuartiersPC() {
    let selectQuartier = document.getElementById('selectQuartier');

    let idVille = selectVille.value;
    let optionsExistants = selectQuartier.options;

    deleteAll(selectQuartier);

    if (idVille !== "default") {
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
    else {
        selectQuartier.add(optionDefault);
    }
}

function deleteAll(element) {
    while(selectQuartier.options.length > 0){
        selectQuartier.remove(0);
    }

    element.add(optionDefault);
}



var mbBtnVilles = document.getElementById("mbBtnVilles");
let mbBtnQuartier = document.getElementById('mbBtnQuartier');

// mbBtnVilles.addEventListener('change', setQuartiersMobile);


function setQuartiersMobile(){
    let mbBtnQuartier = document.getElementById('mbBtnQuartier');
    let idVille = mbBtnVilles.value;
    let optionsExistants = mbBtnQuartier.options;

    deleteAllMobile(mbBtnQuartier);

    if (idVille !== "default") {
        axios.get(`/quartiers?villeId=${idVille}`)
            .then(response => {
                let quartiers = response.data.quartiers;

                // let listeQuartiers = quartiers.quartiers;

                quartiers.forEach(quartier => {
                    let option = document.createElement("option");
                    option.text = quartier.nom;
                    option.value = quartier.id;
                    mbBtnQuartier.add(option);
                });
            })
            .catch(error => console.error('Error fetching quartiers:', error));
    }
    else {
        mbBtnQuartier.add(optionDefault);
    }
}

function deleteAllMobile(element) {
    let mbBtnQuartier = document.getElementById('mbBtnQuartier');

    while(mbBtnQuartier.options.length > 0){
        mbBtnQuartier.remove(0);
    }


    element.add(optionDefault);
}