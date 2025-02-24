let boutonsSupprimer;

document.addEventListener("DOMContentLoaded", function () {
    ObtenirElementsSupprimer();
    AjouterSupprimerListeners();
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
                title: "Confirmation",
                text: `Êtes-vous certain(e) de vouloir supprimer ce lieu : ${nomEtablissement} ?`,
                icon: "warning",
                showDenyButton: false,
                showCancelButton: true, confirmButtonText: "Supprimer",
                cancelButtonText: `Annuler`,
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
                            Toast.fire({
                                icon: "success",
                                title: data.message 
                            });
                    
                            bouton.closest(".carteLieuxMobile, .max-w-4xl").remove();
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

