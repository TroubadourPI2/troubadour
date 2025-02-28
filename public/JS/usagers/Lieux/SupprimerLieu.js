let boutonsSupprimer;
let success;

document.addEventListener("DOMContentLoaded", function () {
    //configure la lang pour le fichier JS
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsSupprimer();
    AjouterSupprimerListeners();

    const toastMessage = localStorage.getItem('toastMessage');
    if (toastMessage) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        Toast.fire({
            icon: "success",
            title: toastMessage
        });

        localStorage.removeItem('toastMessage');
    }

    if (localStorage.getItem('afficherLieuxVisible') === 'true') {
        console.log(localStorage.getItem('afficherLieuxVisible'));
        document.getElementById("compte").classList.add("hidden");
        const boutonCompte = document.getElementById("boutonCompte");
        boutonCompte.classList.remove("bg-c1", "text-c3");
        boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

        const boutonLieu = document.getElementById("boutonLieu");
        boutonLieu.classList.add("bg-c1", "text-c3");
        boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

        const lieux = document.getElementById("lieux");
        lieux.classList.remove("hidden");

        document.getElementById("afficherLieux").classList.remove("hidden");
        localStorage.removeItem('afficherLieuxVisible');
    }
});


function ObtenirElementsSupprimer() {
    boutonsSupprimer = document.querySelectorAll(".boutonSupprimer");

}

function AjouterSupprimerListeners() {


    boutonsSupprimer.forEach((bouton) => {
        bouton.addEventListener("click", () => {
            const lieuId = bouton.getAttribute("data-lieuId");
            const nomEtablissement = bouton.getAttribute("data-nomLieu");
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            Swal.fire({
                title: Lang.get('strings.confirmation'),
                text: `${Lang.get('strings.confirmationSuppression')} ${nomEtablissement} ?`,
                icon: "warning",
                showDenyButton: false,
                showCancelButton: true, 
                confirmButtonText: Lang.get('strings.supprimer'),
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
                    fetch(`/compte/supprimerLieu/${lieuId}`, {
                        method: "DELETE",
                        headers: {
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                localStorage.setItem('toastMessage', data.message);
                                localStorage.setItem('afficherLieuxVisible', 'true');
                                location.reload();
                            } else {
                                Swal.fire("Erreur", data.message, "error");
                            }
                        })

                        .catch(error => {
                            console.error("Erreur :", error);
                            Swal.fire("Erreur", "Une erreur est survenue. Veuillez réessayer.", "error");
                        });
                }
            });

        });
    });
}



