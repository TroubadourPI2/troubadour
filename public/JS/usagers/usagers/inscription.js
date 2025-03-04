async function AfficherModalInscription() {
    const modal = await Swal.fire({
        title: 'Inscription',
        html: `
            <div class="flex flex-col items-center space-y-6 ">
                <div class="flex flex-col space-y-3 w-full mb-2">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">${Lang.get('strings.role')}</h1>
                    <div class="text-left">
                        <select id="role" class="swal-input w-full p-3 border rounded-lg">
                            <option value="utilisateur" selected>${Lang.get('strings.utilisateur')}</option>
                            <option value="gestionnaire">${Lang.get('strings.gestion')}</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col space-y-3 w-full mb-2">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">${Lang.get('strings.prenomNom')}</h1>
                    <div class="text-left">
                        <label for="prenom" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.prenom')}</label>
                        <input type="text" id="prenom" class="swal-input w-full p-3 border rounded-lg">
                        <span id="errorPrenom" class="text-c5 font-medium erreur-message"></span>
                    </div>
                    <div class="text-left">
                        <label for="nom" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.nomF')}</label>
                        <input type="text" id="nom" class="swal-input w-full p-3 border rounded-lg">
                        <span id="errorNom" class="text-c5 font-medium erreur-message"></span>
                    </div>
                </div>
                <div class="flex flex-col space-y-3 w-full">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">Coordonnées</h1>
                    <div class="text-left">
                        <label for="email" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.courriel')}</label>
                        <input type="email" id="courriel" class="swal-input w-full p-3 border rounded-lg">
                        <span id="errorCourriel" class="text-c5 font-medium erreur-message"></span>
                    </div>
                    <div class="text-left">
                        <label for="password" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.motDePasse')}</label>
                        <input type="password" id="password" class="swal-input w-full p-3 border rounded-lg">
                        <span id="errorPassword" class="text-c5 font-medium erreur-message"></span>
                    </div>
                    <div class="text-left">
                        <label for="confirm-password" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.confirmationMotDePasse')}</label>
                        <input type="password" id="confirmationPassword" name="password_confirmation" class="swal-input w-full p-3 border rounded-lg">
                        <span id="errorConfirmationPassword" class="text-c5 font-medium erreur-message"></span>
                    </div>
                </div>
            </div>
        `,
        focusConfirm: false,
        showCancelButton: false,
        confirmButtonText: "S'inscrire",
        heightAuto: false,
        customClass: {
            popup: ' bg-c2 rounded-l max-w-96 max-h-96 overflow-auto m-5',
            title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
            confirmButton:
                'bg-c1 hover:bg-c3 text-c3 hover:text-c1 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl'
        },
        preConfirm: async () => {
            // Collect form data
            const role = document.getElementById('role').value;
            const prenom = document.getElementById('prenom').value;
            const nom = document.getElementById('nom').value;
            const courriel = document.getElementById('courriel').value;
            const password = document.getElementById('password').value;
            const confirmationPassword = document.getElementById(
                'confirmationPassword'
            ).value;

            // Check if any required field is empty before sending
            if (
                !prenom ||
                !nom ||
                !courriel ||
                !password ||
                !confirmationPassword
            ) {
                Swal.showValidationMessage(
                    Lang.get('strings.messageErreurInscription')
                );
                return false;
            }

            return {
                role,
                prenom,
                nom,
                courriel,
                password,
                confirmationPassword
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const {
                role,
                prenom,
                nom,
                courriel,
                password,
                confirmationPassword
            } = result.value;

            axios
                .post('/usagers', {
                    role,
                    prenom,
                    nom,
                    courriel,
                    password,
                    password_confirmation: confirmationPassword
                })
                .then((response) => {
                    const data = response.data;
                    console.log('Validation errors:', data.errors);

                    if (data.errors) {
                        [
                            'Prenom',
                            'Nom',
                            'Courriel',
                            'Password',
                            'ConfirmationPassword'
                        ].forEach((field) => {
                            const errorElement = document.getElementById(
                                `error${field}`
                            );
                            if (errorElement) {
                                errorElement.textContent = ''; // Clear previous errors
                            }
                        });

                        // Display the errors under the corresponding fields
                        Object.keys(data.errors).forEach((field) => {
                            const errorMessage = data.errors[field][0];
                            const errorElement = document.getElementById(
                                `error${field}`
                            );
                            if (errorElement) {
                                errorElement.textContent = errorMessage;
                            }
                        });

                        AfficherModalInscription(); // Reopen the modal to show errors
                    } else {
                        Swal.fire(
                            Lang.get('strings.sInscrire'),
                            Lang.get('strings.connexionMessage'),
                            'success'
                        ).then(() => {
                            window.location.reload();
                        });
                    }
                })
                .catch((error) => {
                    console.error('Erreur Axios :', error);
                    Swal.fire(
                        Lang.get('strings.erreur'),
                        Lang.get('strings.erreurConnexion'),
                        'error'
                    ).then(() => {
                        AfficherModalInscription();
                    });
                });
        }
    });
}
