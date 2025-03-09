var btnSuppTerme = document.getElementById('btnSuppTerme');

Lang.setLocale(document.body.getAttribute('data-locale'));

// btnSuppTerme.addEventListener('click', function() {
//     swal({
//         title: "Êtes-vous sûr?",
//         text: "Une fois supprimé, vous ne pourrez pas récupérer ce terme!",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//     })
//     .then((willDelete) => {
//         if (willDelete) {
//             swal("Le terme a été supprimé!", {
//                 icon: "success",
//             });
//         } else {
//             swal("Le terme est en sécurité!");
//         }
//     });
// });

function supprimerTerme(id) {
    Swal.fire({
        title: "Êtes-vous sûr?",
        text: "Une fois supprimé, vous ne pourrez pas récupérer ce terme!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, supprimer!",
        cancelButtonText: "Non, annuler!",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete.isConfirmed) {
            // window.location.href = "index.php?action=deleteTerme&id=" + id;
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
               
            });

            axios
                .get(`/recherche/supprimer/${id}`)
                .then((response) => {
                    let reponse = response.data;
                    let success = reponse.success;
                    let message = reponse.message;

                    if (success) {
                        // Swal.fire({
                        //     title: message + "\nLa modification sera visible après un rafraîchissement de la page",
                        //     icon: "success"});


    
                        Toast.fire({
                            icon: "success",
                            title: Lang.get('strings.termeSupprime'),
                            customClass: {
                                title: "text-c1 font-bold",
                                timerProgressBar: "color-c1",
                            }
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: Lang.get('strings.termeSupprimeErreur'),
                            customClass: {
                                title: "text-c1 font-bold",
                                timerProgressBar: "color-c1",
                            }
                        }).then(() => {
                            window.location.reload();
                        });
                        
                        Swal.fire({
                            title: message,
                            icon: "error"});
                    }
                })
                .catch((error) =>
                    console.error('Erreur lors de la suppression : ', error)
                );

        } else {
            Swal.fire({
                title: "Le terme est en sécurité!",
                icon: "success"});
            // swal("Le terme est en sécurité!");
        }
    });
}