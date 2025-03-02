let boutonsBascule;
let textesActifs;

document.addEventListener("DOMContentLoaded", function () {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsDesactiver();
    AjouterDesactiverListeners();
    VerifierEtatInitial();
});

function ObtenirElementsDesactiver() {
    // Récupère tous les boutons bascule et tous les textes actifs
    boutonsBascule = document.querySelectorAll(".boutonBascule");
    textesActifs = document.querySelectorAll(".texteActif");
}

function AjouterDesactiverListeners() {
    // Ajoute un écouteur d'événements pour chaque bouton bascule
    boutonsBascule.forEach((boutonBascule) => {
        boutonBascule.addEventListener('change', function () {
            const action = boutonBascule.checked ? Lang.get('strings.activer') : Lang.get('strings.desactiver');
            const lieuId = boutonBascule.getAttribute("data-lieuId");
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            Swal.fire({
                title: Lang.get('strings.confirmation'),
                text: Lang.get('strings.confirmationChangerEtat', { action: action }),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: action,
                cancelButtonText: Lang.get('strings.annuler'),
                reverseButtons: true,
                customClass: {
                    popup: 'font-barlow text-xl text-c1 bg-c2',
                    title: 'text-3xl uppercase underline',
                    confirmButton: 'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
                    cancelButton: 'text-c1 uppercase bg-c2 font-semibold rounded-full px-4 py-2 hover:bg-white transition',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.put(`/compte/changerEtatLieu/${lieuId}`, {
                        actif: boutonBascule.checked 
                    })
                    .then(response => {
                        if (response.data.success) {
                            const texteActif = document.querySelector(`.texteActif[data-lieuId="${lieuId}"]`);
                            texteActif.textContent = boutonBascule.checked ?  Lang.get('strings.actif') : Lang.get('strings.inactif');
                            
                            Toast.fire({
                                icon: "success",
                                title: response.data.message
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: Lang.get('strings.erreur'),
                            text: Lang.get('strings.erreurGenerale'),
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        boutonBascule.checked = !boutonBascule.checked;
                    });
                } else {
                    boutonBascule.checked = !boutonBascule.checked;
                    const texteActif = document.querySelector(`.texteActif[data-lieuId="${lieuId}"]`);
                    texteActif.textContent = boutonBascule.checked ? Lang.get('strings.actif') : Lang.get('strings.inactif');
                }
            });
        });
    });
}

function VerifierEtatInitial() {
    boutonsBascule.forEach((boutonBascule) => {
        const lieuId = boutonBascule.getAttribute("data-lieuId");
        const texteActif = document.querySelector(`.texteActif[data-lieuId="${lieuId}"]`);
        const actif = texteActif.getAttribute("data-actif"); 
        if (actif == 1) {
            boutonBascule.checked = true; 
            texteActif.textContent = Lang.get('strings.actif'); 
        } else {
            boutonBascule.checked = false;  
            texteActif.textContent = Lang.get('strings.inactif'); 
        }
    });
}

