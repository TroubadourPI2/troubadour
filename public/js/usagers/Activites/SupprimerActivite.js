document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".boutonSupprimerActivite").forEach(button => {
        button.addEventListener("click", function () {
            let activiteId = this.getAttribute("data-activite-id");
            const nomActivite = this.getAttribute("data-nomActivite"); 
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
          
            });

            Swal.fire({
                title:  Lang.get('strings.confirmation'),
                text: `${Lang.get('strings.confirmationSuppressionActivite')} ${nomActivite} ?`,
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
                    fetch(`compte/supprimerActivites/${activiteId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            "Accept": "application/json",
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                          
                            return response.json().then(errorData => { throw errorData; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        let activiteElement = document.querySelector(`[data-activite-id="${activiteId}"]`).closest(".activite-carte");
                        activiteElement.style.transition = "opacity 0.3s ease-out";
                        activiteElement.style.opacity = "0";
                        setTimeout(() => activiteElement.remove(), 300);

                        Toast.fire({
                            icon: "success",
                            title:Lang.get('strings.succesSupprimer')
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: Lang.get('strings.erreur'),
                            text:  error.message,  
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
});
