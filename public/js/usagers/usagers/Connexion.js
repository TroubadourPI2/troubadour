function ChargerCSSPersonnalise() {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "/connexion.css"; 
    link.type = "text/css";
    document.head.appendChild(link);
}


ChargerCSSPersonnalise();
Lang.setLocale(document.body.getAttribute('data-locale'));
function AfficherModalConnexion() {
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    Swal.fire({
        title: Lang.get('strings.connexion'),
        html: `
            <div class="flex flex-col items-center w-full space-y-2">
                <div class="w-full text-left">
                    <label for="courriel" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.courriel')}</label>
                </div>
                <input id="courriel" type="email" class="swal2-input w-full p-3 border rounded-lg bg-white text-c1" >

                <div class="w-full text-left">
                    <label for="password" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.motDePasse')}</label>
                </div>
                <input id="password" type="password" class="swal2-input w-full p-3 border rounded-lg bg-white text-c1">
            </div>
        `,
        focusConfirm: false,
        showCancelButton: false,
        showDenyButton: true,
        reverseButtons : true,
        confirmButtonText: Lang.get('strings.seConnecter'),
        denyButtonText: Lang.get('strings.sInscrire'),
        customClass: {
            popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
            title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
            confirmButton: 'bg-c1 hover:bg-c3 text-c3 hover:text-c1 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
            denyButton: 'bg-c3 hover:bg-c1 text-c1 hover:text-c3 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
        },
        preConfirm: () => {
            const courriel = document.getElementById("courriel").value;
            const password = document.getElementById("password").value;

            if (!courriel || !password) {
                Swal.showValidationMessage(Lang.get('strings.messageErreurConnexion'));
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
                        timer: 2000,
                        timerProgressBar: true,
                       
                    });

                    Toast.fire({
                        icon: "success",
                        title: Lang.get('strings.connexionMessage'),
                        customClass: {
                            title: "text-c1 font-bold",
                            timerProgressBar: "color-c1",
                        }
                    }).then(() => {
                        window.location.reload();
                    });

                } else {
                    Swal.fire(Lang.get('strings.erreur'), Lang.get('strings.erreurConnexion'), "error").then(() => {
                        AfficherModalConnexion(); 
                    });
                }
            })
            .catch(error => {
                console.error("Erreur Axios :", error); 
                Swal.fire(Lang.get('strings.erreur'), Lang.get('strings.erreurConnexion'), "error").then(() => {
                    AfficherModalConnexion(); 
                });
            });

        } else if (result.isDenied) {
            AfficherModalInscription(); 
        }
    });
}
