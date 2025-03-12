document.addEventListener('DOMContentLoaded', () => {
    
    setTimeout(()=> {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    document.querySelectorAll('.boutonModifierQuartier').forEach(bouton => {
        bouton.addEventListener('click', function() {
            const idQuartier = this.getAttribute('data-id');

            axios.get(`/compte/obtenirQuartier/${idQuartier}`)
                .then(reponse => {
                    const quartier = reponse.data.data;

                    if(document.getElementById('idQuartierModif'))
                        document.getElementById('idQuartierModif').value = quartier.id || '';

                    if(document.getElementById('nomQuartierModif'))
                        document.getElementById('nomQuartierModif').value = quartier.nom || '';

                    if(document.getElementById('actifQuartierModif'))
                        document.getElementById('actifQuartierModif').selectedIndex = quartier.actif

                    if(document.getElementById('selectVilleModifierQuartier'))
                        document.getElementById('selectVilleModifierQuartier').selectedIndex = (quartier.ville_id-1)

                })
                .catch(erreur => {
                    console.error("Erreur lors de la récupération du quartier :", erreur);
                });
        });

        document.querySelector("#formulaireQuartierModif").addEventListener("submit", function (e) {
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: Lang.get('strings.attention'),
                text: "bop"
            });
        });

        

    


    })
},1000);

});