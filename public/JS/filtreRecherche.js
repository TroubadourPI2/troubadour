let selectVille = document.getElementById('selectVille');
let nbOptions = selectQuartier.length;

let villes = ["Trois-Rivières", "Shawinigan"];
let quartiers = ["Cap-de-la-Madeleine", "Trois-Rivières Ouest", "Saint-Louis-de-France", "Sainte-Marthe-du-Cap", "Pointe-du-Lac"];
let idQuartiers = ["CAP", "TRO", "SLF", "SM", "PDL"];

let optionDefault = document.createElement("option");
optionDefault.text = "Choisir un quartier";
optionDefault.value = "default";
optionDefault.disabled = true;
optionDefault.selected = true;
selectQuartier.add(optionDefault);

selectVille.addEventListener('change', function () {

    let selectQuartier = document.getElementById('selectQuartier');

    let idVille = selectVille.value;
    let optionsExistants = selectQuartier.options;

    deleteAll(selectQuartier);

    if(idVille === "TR"){

        // if(selectQuartier.options.length > 0){
        //     deleteAll(selectQuartier);
        // }

        // selectQuartier.add(optionDefault);

        for (let i = 0; i < quartiers.length; i++) {
            let option = document.createElement("option");
            option.text = quartiers[i];
            option.value = idQuartiers[i];
            selectQuartier.add(option);
        }


    }
    else if(idVille === "QC"){

        deleteAll(selectQuartier);

    }
});

function deleteAll(element) {
    while(selectQuartier.options.length > 0){
        selectQuartier.remove(0);
    }

    element.add(optionDefault);
}

