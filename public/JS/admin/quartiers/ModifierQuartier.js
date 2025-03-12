document.addEventListener('DOMContentLoaded', () => {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    document.querySelectorAll('.boutonModifierQuartier').forEach(bouton => {
        bouton.addEventListener('click', function() {
            const idQuartier = this.getAttribute('data-id');
            console.log(idQuartier);

            axios.get(`/compte/obtenirQuartier/${idQuartier}`)
                .then(reponse => {
                    const quartier = reponse.data.data;

                    if(document.getElementById('nomQuartierModif'))
                        document.getElementById('nomQuartierModif').value = quartier.nom || '';

                })
                .catch(erreur => {
                    console.error("Erreur lors de la récupération du quartier :", erreur);
                });
        });

    });

});