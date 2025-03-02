document.addEventListener("DOMContentLoaded", function() {
    const checkboxActif = document.getElementById('actifFiltre');
    Lang.setLocale(document.body.getAttribute('data-locale'));

    checkboxActif.checked = true;
    MettreAJourLabelActif(checkboxActif.checked);

    FiltrerCartes();


    checkboxActif.addEventListener('change', function () {
        MettreAJourLabelActif(this.checked);
        FiltrerCartes();
    });
});

function MettreAJourLabelActif(estActif) {
    const labelActif = document.getElementById('labelActif');
    labelActif.textContent = estActif ? Lang.get('strings.actif') : Lang.get('strings.inactif');
}

function FiltrerCartes() {
    const requeteRecherche = document.getElementById('recherche').value.toLowerCase();
    const lieuSelectionne = document.getElementById('filtreLieu').value;
    const typeSelectionne = document.getElementById('filtreType').value;
    const actifSelectionne = document.getElementById('actifFiltre').checked; 

    const cartes = document.querySelectorAll('.activite-carte');
    let nombreVisible = 0;

    cartes.forEach(carte => {
        const nom = carte.getAttribute('data-nom');
        const idLieuxStr = carte.getAttribute('data-lieu-ids');
        const idLieux = idLieuxStr ? idLieuxStr.split(',') : [];
        const idType = carte.getAttribute('data-type');
        const actif = carte.getAttribute('data-actif') === '1'; 

        const correspondRecherche = nom.indexOf(requeteRecherche) !== -1;
        const correspondLieu = !lieuSelectionne || idLieux.includes(lieuSelectionne);
        const correspondType = !typeSelectionne || idType === typeSelectionne;
        const correspondActif = actifSelectionne ? actif : !actif;


        if (correspondRecherche && correspondLieu && correspondType && correspondActif) {
            carte.style.display = '';
            nombreVisible++;
        } else {
            carte.style.display = 'none';
        }
    });

    const zonePasResultat = document.getElementById('pasResultat');
    zonePasResultat.classList.toggle('hidden', nombreVisible > 0);
}


document.getElementById('recherche').addEventListener('keyup', FiltrerCartes);
document.getElementById('filtreLieu').addEventListener('change', FiltrerCartes);
document.getElementById('filtreType').addEventListener('change', FiltrerCartes);
