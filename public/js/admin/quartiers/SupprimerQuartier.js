document.addEventListener("DOMContentLoaded", function () {
    setTimeout(()=> {
    document.querySelectorAll(".boutonSupprimerQuartier").forEach(button => {

        button.addEventListener("click", function () {
            let quartierId = this.getAttribute("id");
            const nomQuartier = this.getAttribute("nom"); 
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
          
            });
            const data = {
                id: quartierId,
              };


            Swal.fire({
                title:  Lang.get('strings.confirmation'),
                text: Lang.get('strings.confirmationSuppressionQuartier'),
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
                    fetch(`admin/supprimerQuartier`, { // Enlever l'ID de l'URL
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                            "Accept": "application/json",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ id: quartierId }) // Envoyer l'ID dans le corps de la requête
                    })
                    
                    .then(response => {
                        if (!response.ok) throw new Error("Erreur lors de la suppression.");
                        return response.json();
                    })
                    .then(data => {
                        let quartierElement = document.querySelector(`[id="${quartierId}"]`);
                        if (quartierElement) { // Vérifier si l'élément existe avant d'accéder à .closest()
                            let quartierCarte = quartierElement.closest(".quartier-carte");
                            console.log(quartierCarte);
                            if (quartierCarte) {
                                quartierCarte.style.transition = "opacity 0.3s ease-out";
                                quartierCarte.style.opacity = "0";
                                setTimeout(() => quartierCarte.remove(), 300);
                            }
                        }
                    
                        Toast.fire({
                            icon: "success",
                            title: Lang.get('strings.succesSupprimer')
                        });
                    })
                    
                    .catch(error => {
                        Swal.fire(Lang.get('strings.erreur') + error.message, "error");
                    });
                }
            });
        });
    });
}, 3000)
});
