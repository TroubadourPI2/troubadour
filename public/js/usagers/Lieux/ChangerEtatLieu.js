let boutonsBascule;
let textesActifs;

document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        ObtenirElementsDesactiver();
        AjouterDesactiverListeners();
        MiseAJourStatutLieu();
    }, 2000); 
});

function ObtenirElementsDesactiver() {
    boutonsBascule = document.querySelectorAll('.boutonBascule');
    textesActifs = document.querySelectorAll('.texteActif');
}

function AjouterDesactiverListeners() {
    boutonsBascule.forEach((boutonBascule) => {
        boutonBascule.addEventListener('change', function () {
            const action = boutonBascule.checked
                ? Lang.get('strings.activer')
                : Lang.get('strings.desactiver');
            const lieuId = boutonBascule.getAttribute('data-lieuId');
            const nomEtablissement = boutonBascule.getAttribute('data-nomLieu');
       
            Swal.fire({
                title: Lang.get('strings.confirmation'),
                text: Lang.get('strings.confirmationChangerEtat', {
                    action: action,
                    lieu: nomEtablissement
                }),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: action,
                cancelButtonText: Lang.get('strings.annuler'),
                reverseButtons: true,
                customClass: {
                    popup: 'font-barlow text-xl text-c1 bg-c2',
                    title: 'text-3xl uppercase underline',
                    confirmButton:
                        'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
                    cancelButton:
                        'text-c1 uppercase bg-c2 font-semibold rounded-full px-4 py-2 hover:bg-white transition'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .patch(`/compte/changerEtatLieu/${lieuId}`, {
                            actif: boutonBascule.checked
                        })
                        .then((reponse) => {
                            if (reponse.data.success) {
                                location.reload();
                            } else {
                                Swal.fire({
                                    title: Lang.get('strings.erreurGenerale'),
                                    icon: 'error'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        })
                        .catch((error) => {
                            Swal.fire({
                                title: Lang.get('strings.erreur'),
                                text: Lang.get('strings.erreurGenerale'),
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                            boutonBascule.checked = boutonBascule.checked;
                        });
                } else {
                    boutonBascule.checked = !boutonBascule.checked;
                    // const texteActif = document.querySelector(
                    //     `.texteActif[data-lieuId="${lieuId}"]`
                    // );
                    // texteActif.textContent = boutonBascule.checked
                    //     ? Lang.get('strings.actif')
                    //     : Lang.get('strings.inactif');
                }
            });
        });
    });
}

function MiseAJourStatutLieu() {
    boutonsBascule.forEach((boutonBascule) => {
        const lieuId = boutonBascule.getAttribute('data-lieuId');
        const texteActif = document.querySelector(
            `.texteActif[data-lieuId="${lieuId}"]`
        );
        const actif = texteActif.getAttribute('data-actif');

        if (actif == '1') {
            boutonBascule.checked = true;
            texteActif.textContent = Lang.get('strings.actif');
            texteActif.setAttribute('data-actif', '1');
        } else {
            boutonBascule.checked = false;
            texteActif.textContent = Lang.get('strings.inactif');
            texteActif.setAttribute('data-actif', '0');
        }
    });
}
