var barreRecherche = document.getElementById("barreRecherche");
var barreRecherche2 = document.getElementById("barreRecherche2");

var btnRecherche = document.getElementById("btnRecherche");
// var selectVille = document.getElementsByName("ville")[0];
var selectQuartier = document.getElementsByName("quartier")[0];

barreRecherche.addEventListener('input', function () {
    let text = barreRecherche.value;

    let elements = document.getElementsByClassName("carteLieu");

    for (let i = 0; i < elements.length; i++) {
        let element = elements[i];
        let titre = element.getElementsByClassName("carteTitre")[0].innerText;

        if (titre.toLowerCase().includes(text.toLowerCase())) {
            element.style.display = "flex";
        } else {
            element.style.display = "none";
        }
    }
});

barreRecherche2.addEventListener('input', function () {
    let text = barreRecherche2.value;

    let elements = document.getElementsByClassName("carteLieu");

    for (let i = 0; i < elements.length; i++) {
        let element = elements[i];
        let titre = element.getElementsByClassName("carteTitre")[0].innerText;

        if (titre.toLowerCase().includes(text.toLowerCase())) {
            element.style.display = "flex";
        } else {
            element.style.display = "none";
        }
    }
});

selectQuartier.addEventListener('change', function () {
    let quartier = selectQuartier.value;
    console.log("Nouveau quartier: " + quartier);

    if(quartier === "" || quartier === undefined || quartier === null)
    {
        btnRecherche.setAttribute("disabled", "true");
    }
    else if (selectVille.value !== "defaut") {
        console.log("Ville sélectionnée: " + selectVille.value + "/ Quartier sélectionné: " + quartier);
        btnRecherche.removeAttribute("disabled");
    }
});

selectVille.addEventListener('change', function () {
    let ville = selectVille.value;
    console.log("Nouvelle ville: " + ville);

    if(ville === "defaut")
    {
        btnRecherche.setAttribute("disabled", "disabled");
    }
    else if (selectQuartier.value !== "default") {
        console.log("Ville sélectionnée: " + ville + "/ Quartier sélectionné: " + selectQuartier.value);
        
    }
});