function ChargerCSSPersonnalise() {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "/connexion.css"; 
    link.type = "text/css";
    document.head.appendChild(link);
}


ChargerCSSPersonnalise();

Lang.setLocale(document.body.getAttribute('data-locale'));

async function AfficherModalInscription() {
    const { value: formValues } = await Swal.fire({
        title: "Inscription",
        html: `
            <div class="flex flex-col items-center space-y-6 ">
                <div class="flex flex-col space-y-3 w-full mb-2">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">${Lang.get('strings.role')}</h1>
                    <div class="text-left">
                        <select id="swal-input-role" class="swal-input w-full p-3 border rounded-lg">
                            <option value="utilisateur">${Lang.get('strings.utilisateur')}</option>
                            <option value="gestionnaire">${Lang.get('strings.gestion')}</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col space-y-3 w-full mb-2">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">${Lang.get('strings.prenomNom')}</h1>
                    <div class="text-left">
                        <label for="prenom" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.prenom')}</label>
                        <input type="text" id="swal-input-firstname" class="swal-input w-full p-3 border rounded-lg">
                        <span id="error-prenom" class="text-c5 font-medium erreur-message"></span>
                    </div>
                    <div class="text-left">
                        <label for="nom" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.nomF')}</label>
                        <input type="text" id="swal-input-lastname" class="swal-input w-full p-3 border rounded-lg">
                        <span id="error-nom" class="text-c5 font-medium erreur-message"></span>
                    </div>
                </div>
                <div class="flex flex-col space-y-3 w-full">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">Coordonnées</h1>
                    <div class="text-left">
                        <label for="email" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.courriel')}</label>
                        <input type="email" id="swal-input-email" class="swal-input w-full p-3 border rounded-lg">
                        <span id="error-courriel" class="text-c5 font-medium erreur-message"></span>
                    </div>
                    <div class="text-left">
                        <label for="password" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.motDePasse')}</label>
                        <input type="password" id="swal-input-password" class="swal-input w-full p-3 border rounded-lg">
                        <span id="error-password" class="text-c5 font-medium erreur-message"></span>
                    </div>
                    <div class="text-left">
                        <label for="confirm-password" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.confirmationMotDePasse')}</label>
                        <input type="password" id="swal-input-password-confirm" class="swal-input w-full p-3 border rounded-lg">
                        <span id="error-password-confirm" class="text-c5 font-medium erreur-message"></span>
                    </div>
                </div>
            </div>
        `,
        focusConfirm: false,
        showCancelButton: false,
        confirmButtonText: "S'inscrire",
        customClass: {
            popup: 'bg-c2 rounded-l max-w-96 max-h-96 overflow-auto',
            title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
            confirmButton: 'bg-c1 hover:bg-c3 text-c3 hover:text-c1 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
        },
        preConfirm: async () => {
            const response = await axios.post('/usagers/CreationUsager', {
                role: document.getElementById('swal-input-role').value,
                prenom: document.getElementById('swal-input-firstname').value,
                nom: document.getElementById('swal-input-lastname').value,
                courriel: document.getElementById('swal-input-email').value,
                password: document.getElementById('swal-input-password').value,
                confirmPassword: document.getElementById('swal-input-password-confirm').value
            });

            if (response.data.errors) {
                // Clear previous error messages
                ['prenom', 'nom', 'courriel', 'password', 'password-confirm'].forEach(field => {
                    const errorElement = document.getElementById(`error-${field}`);
                    if (errorElement) {
                        errorElement.textContent = '';
                    }
                });

                // Display errors dynamically
                Object.keys(response.data.errors).forEach(field => {
                    const errorMessage = response.data.errors[field][0];
                    const errorElement = document.getElementById(`error-${field}`);
                    if (errorElement) {
                        errorElement.textContent = errorMessage;
                    }
                });
            }
            return formValues;
        }
    });
}

