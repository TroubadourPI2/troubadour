function filtrerCartes() {
    const requeteRecherche = document.getElementById('recherche').value.toLowerCase();
    const lieuSelectionne = document.getElementById('filtreLieu').value;
    const typeSelectionne = document.getElementById('filtreType').value;

    const cartes = document.querySelectorAll('.activite-carte');
    let nombreVisible = 0;

    cartes.forEach(carte => {
        const nom = carte.getAttribute('data-nom');
        const idLieuxStr = carte.getAttribute('data-lieu-ids');
        const idLieux = idLieuxStr ? idLieuxStr.split(',') : [];
        const idType = carte.getAttribute('data-type');

        const correspondRecherche = nom.indexOf(requeteRecherche) !== -1;
        const correspondLieu = !lieuSelectionne || idLieux.includes(lieuSelectionne);
        const correspondType = !typeSelectionne || idType === typeSelectionne;

        if (correspondRecherche && correspondLieu && correspondType) {
            carte.style.display = '';
            nombreVisible++;
        } else {
            carte.style.display = 'none';
        }
    });

    const zonePasResultat = document.getElementById('pasResultat');
    if (nombreVisible === 0) {
        zonePasResultat.classList.remove('hidden');
    } else {
        zonePasResultat.classList.add('hidden');
    }
}

document.getElementById('recherche').addEventListener('keyup', filtrerCartes);
document.getElementById('filtreLieu').addEventListener('change', filtrerCartes);
document.getElementById('filtreType').addEventListener('change', filtrerCartes);
