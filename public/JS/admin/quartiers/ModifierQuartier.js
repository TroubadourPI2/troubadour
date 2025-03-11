document.addEventListener('DOMContentLoaded', () => {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    document.querySelectorAll('.boutonModifierActivite').forEach(bouton => {
        bouton.addEventListener('click', function() {
            const idQuartier = this.getAttribute('data-id');
     

            axios.get(`/admin/modifierQuartier/${idQuartier}`)
                .then(reponse => {
                    const activite = reponse.data.data;

                    if(document.getElementById('nomActiviteModif'))
                        document.getElementById('nomActiviteModif').value = activite.nom || '';
                    if(document.getElementById('descriptionActiviteModif'))
                        document.getElementById('descriptionActiviteModif').value = activite.description || '';
                    if(document.getElementById('dateDebutModif'))
                        document.getElementById('dateDebutModif').value = activite.dateDebut || '';
                    if(document.getElementById('dateFinModif'))
                        document.getElementById('dateFinModif').value = activite.dateFin || '';

                    if(document.getElementById('typeActiviteModif'))
                        document.getElementById('typeActiviteModif').value = activite.type_activite ? activite.type_activite.id : '';
                   
                    const selectLieux = document.getElementById('lieuIdModif');
                    if(selectLieux && selectLieux.tomselect) {
                        selectLieux.tomselect.setValue(activite.lieux.map(lieu => lieu.id));
                    }


                })
                .catch(erreur => {
                    console.error("Erreur lors de la récupération du quartier :", erreur);
                });
        });
    });
});