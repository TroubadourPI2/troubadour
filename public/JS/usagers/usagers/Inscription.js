function ChargerCSSPersonnalise() {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "/connexion.css"; 
    link.type = "text/css";
    document.head.appendChild(link);
}


ChargerCSSPersonnalise();

async function AfficherModalInscription() {
    const result = await Swal.fire({
        title: "Inscription",
        html: `
            <div class="flex flex-col items-center space-y-6">
                <div class="flex flex-col space-y-4 w-full">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">Prénom & Nom</h1>
                    <input type="text" id="swal-input-firstname" class="swal-input w-full p-3 border rounded-lg"
                        placeholder="Prénom">
                    <input type="text" id="swal-input-lastname" class="swal-input w-full p-3 border rounded-lg" placeholder="Nom">
                </div>
                <div  class="flex flex-col space-y-4 w-full">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">Coordonnées</h1>
                    <input type="email" id="swal-input-email" class="swal-input w-full p-3 border rounded-lg"
                        placeholder="Courriel">
                    <input type="password" id="swal-input-password" class="swal-input w-full p-3 border rounded-lg"
                        placeholder="Mot de passe">
                    <input type="password" id="swal-input-password" class="swal-input w-full p-3 border rounded-lg"
                        placeholder="Confirmation de mot de passe">
                </div>
            </div>
        `,
        focusConfirm: false,
        showCancelButton: false,
        confirmButtonText: "S'inscrire",

        customClass: {
            popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
            title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
            confirmButton: 'bg-c1 hover:bg-c3 text-c3 hover:text-c1 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
        },
        
    });
    if (result.isConfirmed) {
        Swal.fire({
            title: "Enregistré!",
            html: '<p class="text-c1 font-bold text-lg">Vous êtes maintenant connecté avec succès!</p>',
            icon: "success",
            timer: 6000,
            showConfirmButton: false,
            customClass: {
                title: "text-c1 font-bold",
                text: "text-c1 font-semibold text-lg",
                popup: "bg-c3 shadow-lg rounded-lg",
            }
        });
        
    }
}
