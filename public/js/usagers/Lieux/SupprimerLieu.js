let boutonsSupprimer;
let success;

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        ObtenirElementsSupprimer();
        AjouterSupprimerListeners();
    }, 2000); 
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
            });

            Swal.fire({
                title: Lang.get('strings.confirmation'),
                text: `${Lang.get('strings.confirmationSuppressionLieu')} ${nomEtablissement} ?`,
                icon: "warning",
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
                            // Supprimer la carte mobile
                            let lieuElementMobile = document.querySelector(`[data-lieuId="${lieuId}"]`).closest(".carteLieuxMobile");
                            if (lieuElementMobile) {
                                lieuElementMobile.style.transition = "opacity 0.3s ease-out";
                                lieuElementMobile.style.opacity = "0";
                                setTimeout(() => lieuElementMobile.remove(), 300);
                            }
                    
                            // Supprimer la carte web/tablette
                            let lieuElementWeb = document.querySelector(`.carteWeb  [data-lieuId="${lieuId}"]`).closest(".carteWeb");
                            if (lieuElementWeb) {
                                lieuElementWeb.style.transition = "opacity 0.3s ease-out";
                                lieuElementWeb.style.opacity = "0";
                                setTimeout(() => lieuElementWeb.remove(), 300);
                            }
                    
                            Toast.fire({
                                icon: "success",
                                title: data.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: Lang.get('strings.erreur'),
                                text: data.message,
                                customClass: {
                                    popup: 'font-barlow text-xl text-c1 bg-c2',
                                    title: 'text-3xl uppercase underline',
                                    confirmButton: 'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
                                },
                                didOpen: () => {
                                    const xMarkLeft = document.querySelector('.swal2-x-mark-line-left');
                                    const xMarkRight = document.querySelector('.swal2-x-mark-line-right');
                            
                                    if (xMarkLeft && xMarkRight) {
                                        xMarkLeft.style.backgroundColor = '#154C51'; 
                                        xMarkRight.style.backgroundColor = '#154C51'; 
                                    }
                                }
                            });
                        }
                    })                    
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: Lang.get('strings.erreur'),
                            text: data.message,
                            customClass: {
                                popup: 'font-barlow text-xl text-c1 bg-c2',
                                title: 'text-3xl uppercase underline',
                                confirmButton: 'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
                            },
                            didOpen: () => {
                                const xMarkLeft = document.querySelector('.swal2-x-mark-line-left');
                                const xMarkRight = document.querySelector('.swal2-x-mark-line-right');
                        
                                if (xMarkLeft && xMarkRight) {
                                    xMarkLeft.style.backgroundColor = '#154C51'; 
                                    xMarkRight.style.backgroundColor = '#154C51'; 
                                }
                            }
                        });
                    });
                }
            });
        });
    });
}
