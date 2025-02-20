function ChargerCSSPersonnalise() {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "/connexion.css"; 
    link.type = "text/css";
    document.head.appendChild(link);
}


ChargerCSSPersonnalise();

function AfficherModalConnexion() {
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    Swal.fire({
        title: "Connexion",
        html: `
            
            <div class="flex flex-col items-center space-y-2">
                <input id="courriel" type="email" class="swal2-input w-full p-3 border rounded-lg bg-white text-c1" placeholder="Courriel">
                <input id="password" type="password" class="swal2-input w-full p-3 border rounded-lg bg-white text-c1" placeholder="Mot de passe">
            </div>
            
        `,
        focusConfirm: false,
        showCancelButton: false,
        showDenyButton: true,
        confirmButtonText: "Se connecter",
        denyButtonText: "S'inscrire",
        customClass: {
            popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
            title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
            confirmButton: 'bg-c1 hover:bg-white text-c3 hover:text-c3 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
            denyButton: 'bg-c3 hover:bg-c1 text-c1 hover:text-c3 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
        },
        preConfirm: () => {
            const courriel = document.getElementById("courriel").value;
            const password = document.getElementById("password").value;

            if (!courriel || !password) {
                Swal.showValidationMessage("Veuillez remplir tous les champs.");
                return false;
            }

            return { courriel, password };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const { courriel, password } = result.value;

            axios.post("/usagers/Connexion", { courriel, password }, {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                }
            })
            .then(response => {
                // console.log("Réponse :", response); 
                const data = response.data;
                console.log("Réponse du serveur :", data);

                if (data.success) {
                   
                    
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

                    Toast.fire({
                        icon: "success",
                        title: "Connexion réussie!",
                        customClass: {
                            title: "text-c1 font-bold",
                            timerProgressBar: "color-c1",
                        }
                    }).then(() => {
                        window.location.reload();
                    });

                } else {
                    Swal.fire("Erreur", "Courriel et/ou le mot de passe est invalide.", "error").then(() => {
                        AfficherModalConnexion(); 
                    });
                }
            })
            .catch(error => {
                console.error("Erreur Axios :", error); 
                Swal.fire("Erreur", "Courriel et/ou le mot de passe est invalide. ", "error").then(() => {
                    AfficherModalConnexion(); 
                });
            });

        } else if (result.isDenied) {
            AfficherModalInscription(); 
        }
    });
}
