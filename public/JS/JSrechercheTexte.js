var barreRecherche = document.getElementById("barreRecherche");
var barreRecherche2 = document.getElementById("barreRecherche2");

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