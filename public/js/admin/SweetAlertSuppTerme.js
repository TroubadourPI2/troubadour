var btnSuppTerme = document.getElementById('btnSuppTerme');

// Lang.setLocale(document.body.getAttribute('data-locale'));

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
        title: Lang.get('strings.titreAlertSupprimer'),
        text: Lang.get('strings.alertConfirmationSuppression'),
        icon: "warning",
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: Lang.get('strings.ouiAllezY'),
        cancelButtonText: Lang.get('strings.nonAnnuler'),
        customClass: {
            popup: 'font-barlow text-xl text-c1 bg-c2',
            title: 'text-3xl uppercase underline',
            confirmButton: 'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
            cancelButton: 'text-c1 uppercase bg-c2 font-semibold rounded-full px-4 py-2 hover:bg-white transition',
        },
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
                .delete(`/recherche/supprimer/${id}`)
                .then((response) => {
                    let reponse = response.data;
                    let success = reponse.success;
                    let message = reponse.message;

                    if (success) {
                        // Toast.fire({
                        //     icon: "success",
                        //     title: Lang.get('strings.termeSupprime'),
                        //     customClass: {
                        //         title: "text-c1 font-bold",
                        //         timerProgressBar: "color-c1",
                        //     }
                        // }).then(() => {
                            window.location.reload();
                        // });
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
                    }
                })
                .catch((error) =>
                    console.error('Erreur lors de la suppression : ', error)
                );

        }
    });
}