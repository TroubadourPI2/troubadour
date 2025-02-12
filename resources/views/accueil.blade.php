@extends('layouts.app')

@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-full bg-white">
        Troubadour
        <span class="iconify" data-icon="mdi:home" data-inline="false"></span>
    </div>
    

    <button onclick="showLoginPrompt()" class="px-4 py-2 bg-blue-500 text-white rounded">Login</button>

@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/connexion.js') }}"></script>

<script>
    async function showLoginPrompt() {
        const result = await Swal.fire({
            title: "Connexion",
            html: `
            <div class="flex flex-col items-center space-y-6"> 
                <input type="email" id="email" class="swal-input w-full p-3 border rounded-lg" placeholder="Courriel">
                
                <input type="password" id="mdp" class="swal-input w-full p-3 border rounded-lg" placeholder="Mot de passe">
                <a href="#" onclick="showMDPOublie()" class="underline text-c1 italic font-medium mt-3">Mot de passe oublié?</a>
            </div>
        `,
            showCancelButton: false,
            showDenyButton: true,
            confirmButtonText: "Se connecter",
            denyButtonText: "S'inscrire",
            customClass: {
                popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
                title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
                confirmButton: 'bg-c1 hover:bg-c3 text-c3 hover:text-c1 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
                confirmButtonText: 'text-xxl',
                denyButton: 'bg-c3 hover:bg-c1 text-c1 hover:text-c3 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
            }

            //     preConfirm: () => {
            //     return {
            //         email: document.getElementById("swal-input-email").value,
            //         password: document.getElementById("swal-input-password").value
            //     };
            // }
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
                    // popup: "bg-c3 shadow-lg rounded-lg", 
                }

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
    /* Remove extra top margin from SweetAlert2 buttons */
    .swal2-actions {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .swal2-timer-progress-bar {
        background-color: #154C51 !important;
        /* Green */
    }

    .swal2-icon {
        border-color: #154C51 !important;
        color: #154C51 !important;
        /* Green */
    }
</style>

