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
                text: 'bop',
                title: Lang.get('strings.attention'),
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: Lang.get('strings.confirmer'),
                cancelButtonText: Lang.get('strings.annuler'),
                reverseButtons: false,
                customClass: {
                    popup: 'font-barlow text-xl text-c1 bg-c2',
                    title: 'text-3xl uppercase underline',
                    confirmButton: 'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
                    cancelButton: 'text-c1 uppercase bg-c2 font-semibold rounded-full px-4 py-2 hover:bg-white transition',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    if(document.getElementById('nomQuartierModif').value != '' && document.getElementById('nomQuartierModif').value.length >= 3)
                        {
                        document.querySelector("#formulaireQuartierModif").submit();
                        
                        }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: Lang.get('strings.attention'),
                            text: "le nom entré est invalide, veuillez le corriger"
                    });
                    }
                }
            })
        });

        

    


    })
},1000);

});