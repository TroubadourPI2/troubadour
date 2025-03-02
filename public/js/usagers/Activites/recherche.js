document.addEventListener("DOMContentLoaded", function() {
  
    document.getElementById('actif').checked = true;
    
   
    filtrerCartes();
});


function filtrerCartes() {
    const requeteRecherche = document.getElementById('recherche').value.toLowerCase();
    const lieuSelectionne = document.getElementById('filtreLieu').value;
    const typeSelectionne = document.getElementById('filtreType').value;
    const actifSelectionne = document.getElementById('actif').checked; 

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
        const correspondActif = !actifSelectionne || actif; 

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


document.getElementById('recherche').addEventListener('keyup', filtrerCartes);
document.getElementById('filtreLieu').addEventListener('change', filtrerCartes);
document.getElementById('filtreType').addEventListener('change', filtrerCartes);
document.getElementById('actif').addEventListener('change', filtrerCartes); 
