@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-full bg-white">
        Troubadour
        <span class="iconify" data-icon="mdi:home" data-inline="false"></span>
    </div>

    <button onclick="showLoginPrompt()" class="px-4 py-2 bg-blue-500 text-white rounded">Login</button>

@endsection

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

<script src="{{ asset('js/validationConnexion.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    async function handleLogin() {
        const email = document.getElementById("email").value;
        const mdp = document.getElementById("mdp").value;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                email,
                mdp
            })
        });

        const data = await response.json();

        if (data.success) {
            Swal.fire("Succès", data.message, "success").then(() => {
                window.location.href = "/dashboard"; // Redirect after login
            });
        } else {
            Swal.fire("Erreur", data.message, "error");
        }
    }


    async function showLoginPrompt() {
        document.addEventListener("input", function(event) {
            if (event.target.id === "email") {
                validerCourriel(event.target.value);
            } else if (event.target.id === "mdp") {
                validerMDP(event.target.value);
            }
        });

        const result = await Swal.fire({
            title: "Connexion",
            html: `
            <form id="connexionForm">
                <div class="flex flex-col items-center space-y-2">
                    <input type="email" id="email" name="email" class="swal-input w-full p-3 border rounded-lg" placeholder="Courriel" required>
                    <span class="messagesErreur"><span id="errEmail" class="text-c4"></span></span>
                    
                    <input type="password" id="mdp" name="mdp" class="swal-input w-full p-3 border rounded-lg" placeholder="Mot de passe" required>
                    <span class="messagesErreur"><span id="errMdp" class="text-c4"></span></span>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <a href="#" onclick="showMDPOublie()" class="underline text-c1 italic font-medium mt-3">Mot de passe oublié?</a>
                </div>
            </form>
        `,
            showCancelButton: false,
            showDenyButton: true,
            confirmButtonText: "Se connecter",
            denyButtonText: "S'inscrire",
            didOpen: () => {
                document.getElementById("email").addEventListener("input", (event) => validerCourriel(
                    event.target.value));
                document.getElementById("mdp").addEventListener("input", (event) => validerMDP(event
                    .target.value));
            },
            preConfirm: () => {
                handleLogin(); // Trigger the login process when the user clicks "Se connecter"
            },
            customClass: {
                popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
                title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
                confirmButton: 'bg-c1 hover:bg-c3 text-c3 hover:text-c1 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
                denyButton: 'bg-c3 hover:bg-c1 text-c1 hover:text-c3 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
            },

            preConfirm: async () => {
                const form = document.getElementById("connexionForm");
                const formData = new FormData(form);

                const response = await fetch("{{ route('connexion') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                            .content
                    }
                });

                const data = await response.json();

                if (!response.ok) {
                    Swal.showValidationMessage(data.message || "Erreur de connexion.");
                    return false;
                }

                return data;
            }
        });

        // Handle button actions
        if (result.isConfirmed) {
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

            // Swal.fire(`Entered Email: ${formValues.email}\nEntered Password: ${formValues.password}`);

        } else if (result.isDenied) {
            showRegisterPrompt(); // Call registration modal function
        }
    }

    async function showRegisterPrompt() {
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
            // preConfirm: () => {
            //     return {
            //         name: document.getElementById("swal-input-name").value,
            //         email: document.getElementById("swal-input-email").value,
            //         password: document.getElementById("swal-input-password").value
            //     };
            // }
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
            // Swal.fire(`Entered Email: ${formValues.email}\nEntered Password: ${formValues.password}`);
        }
    }

    async function showMDPOublie() {
        const MDPO = Swal.mixin({
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
        MDPO.fire({
            icon: "info",
            title: "Vérifiez vos courriels!",
            customClass: {
                title: "text-c1 font-bold",
            }

        });
    }
</script>
<style>
    .swal2-actions {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .swal2-timer-progress-bar {
        background-color: #154C51 !important;
    }

    .swal2-icon {
        border-color: #154C51 !important;
        color: #154C51 !important;
    }
</style>

