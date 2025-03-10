function ChargerCSSPersonnalise() {
    let link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '/connexion.css';
    link.type = 'text/css';
    document.head.appendChild(link);
}

ChargerCSSPersonnalise();
Lang.setLocale(document.body.getAttribute('data-locale'));

async function AfficherModalInscription() {
    const modal = await Swal.fire({
        title: 'Inscription',
        html: `
            <div class="flex flex-col items-center space-y-6">
                <div class="flex flex-col space-y-3 w-full mb-2">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">${Lang.get('strings.role')}</h1>
                    <div class="text-left">
                        <select id="role_id" class="swal-input w-full p-3 border rounded-lg">
                            <option value="2" selected>${Lang.get('strings.utilisateur')}</option>
                            <option value="3">${Lang.get('strings.gestion')}</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col space-y-3 w-full mb-2">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">${Lang.get('strings.prenomNom')}</h1>
                    <div class="text-left">
                        <label for="prenom" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.prenom')}</label>
                        <input type="text" id="prenom" class="swal-input w-full p-3 border rounded-lg">
                        <span id="erreurPrenom" class="text-c5 font-medium erreur-message hidden"></span>
                    </div>
                    <div class="text-left">
                        <label for="nom" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.nomF')}</label>
                        <input type="text" id="nom" class="swal-input w-full p-3 border rounded-lg">
                        <span id="erreurNom" class="text-c5 font-medium erreur-message hidden"></span>
                    </div>
                </div>
                <div class="flex flex-col space-y-3 w-full">
                    <h1 class="uppercase font-barlow text-c1 font-bold text-xl">Coordonnées</h1>
                    <div class="text-left">
                        <label for="email" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.courriel')}</label>
                        <input type="email" id="courriel" class="swal-input w-full p-3 border rounded-lg">
                        <span id="erreurCourriel" class="text-c5 font-medium erreur-message hidden"></span>
                    </div>
                    <div class="text-left">
                        <label for="password" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.motDePasse')}</label>
                        <input type="password" id="password" class="swal-input w-full p-3 border rounded-lg">
                    </div>
                    <div class="text-left">
                        <label for="confirm-password" class="text-lg font-bold text-c1 uppercase font-barlow">${Lang.get('strings.confirmationMotDePasse')}</label>
                        <input type="password" id="confirmationPassword" name="password_confirmation" class="swal-input w-full p-3 border rounded-lg">
                    </div>
                    <span id="erreurPassword" class="text-c5 font-medium erreur-message hidden"></span>
                </div>
            </div>
        `,
        focusConfirm: false,
        showCancelButton: false,
        confirmButtonText: "S'inscrire",
        heightAuto: false,
        customClass: {
            popup: 'bg-c2 rounded-l max-w-96 max-h-96 overflow-auto m-5',
            title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
            confirmButton:
                'bg-c1 hover:bg-c3 text-c3 hover:text-c1 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl'
        },
        preConfirm: async () => {
            try {
                // Send the request to your Laravel backend to save the data
                const response = await axios.post('/usagers', {
                    role_id: document.getElementById('role_id').value,
                    prenom: document.getElementById('prenom').value,
                    nom: document.getElementById('nom').value,
                    courriel: document.getElementById('courriel').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById(
                        'confirmationPassword'
                    ).value
                });

                // If the user is created successfully, show the success message
                if (response.data.success) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: 'success',
                        title: Lang.get('strings.inscriptionMessage'),
                        customClass: {
                            title: 'text-c1 font-bold',
                            timerProgressBar: 'color-c1'
                        }
                    }).then(() => {
                        
                        window.location.reload();
                    });
                } else {
                    
                    Swal.fire(
                        Lang.get('strings.erreur'),
                        Lang.get('strings.messageErreurInscription'),
                        'error'
                    ).then(() => {
                        AfficherModalConnexion(); 
                    });
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;

                    document
                        .querySelectorAll('.erreur-message')
                        .forEach((el) => {
                            el.innerText = '';
                            el.classList.add('hidden');
                        });

                    if (errors.prenom) {
                        const errorElement =
                            document.getElementById('erreurPrenom');
                        errorElement.innerText = errors.prenom[0];
                        errorElement.classList.remove('hidden');
                    }
                    if (errors.nom) {
                        const errorElement =
                            document.getElementById('erreurNom');
                        errorElement.innerText = errors.nom[0];
                        errorElement.classList.remove('hidden');
                    }
                    if (errors.courriel) {
                        const errorElement =
                            document.getElementById('erreurCourriel');
                        errorElement.innerText = errors.courriel[0];
                        errorElement.classList.remove('hidden');
                    }
                    if (errors.password) {
                        const errorElement =
                            document.getElementById('erreurPassword');
                        errorElement.innerText = errors.password[0];
                        errorElement.classList.remove('hidden');
                    }

                    return false;
                } else {
                    Swal.fire(
                        Lang.get('strings.erreur'),
                        Lang.get('strings.messageErreurInscription'),
                        'error'
                    );
                    return false;
                }
            }
        },

        didClose: () => {
            document.querySelectorAll('.erreur-message').forEach((el) => {
                el.innerText = '';
                el.classList.add('hidden');
            });
        }
    });

    if (!modal.isConfirmed) {
        return;
    }
}
