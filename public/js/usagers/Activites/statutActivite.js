document.addEventListener('DOMContentLoaded', () => {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    document
        .querySelectorAll('input[type="checkbox"][id^="actifCheck-"]')
        .forEach((switchActif) => {
            switchActif.addEventListener('change', function (evenement) {
                evenement.preventDefault();
                const nomActivite = this.getAttribute('data-nom');
                const idActivite = this.id.split('-')[1];
                const nouvelleValeur = this.checked ? 1 : 0;
                const messageConfirmation =
                    nouvelleValeur === 1
                        ? Lang.get('strings.activerActivite')
                        : Lang.get('strings.desactiverActivite');

                Swal.fire({
                    title: Lang.get('strings.confirmation'),
                    html: `${ messageConfirmation} <strong>${nomActivite}</strong> `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: Lang.get('strings.enregistrer'),
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
                            .patch(`/compte/activite/statut/${idActivite}`, {
                                actif: nouvelleValeur
                            })
                            .then((reponse) => {
                                if (reponse.data.success) {
                                    location.reload();
                                } else {
                                    Swal.fire({
                                        title: Lang.get(
                                            'strings.erreurGenerale'
                                        ),
                                        icon: 'error'
                                    }).then(() => {
                                        location.reload();
                                    });
                                }
                            })
                            .catch((erreur) => {
                                Swal.fire({
                                    title: Lang.get('strings.erreurGenerale'),
                                    icon: 'error'
                                }).then(() => {
                                    location.reload();
                                });
                            });
                    } else {
                        this.checked = !this.checked;
                    }
                });
            });
        });
});
