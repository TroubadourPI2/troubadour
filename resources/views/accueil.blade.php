@extends('layouts.Accueil')

@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-screen flex-col">

        <div class="relative flex flex-col justify-start w-full h-full font-barlow overflow-hidden">

            <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
                <source src="{{ asset('videos/activites.mp4') }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo.
            </video>

            <div class="absolute top-0 left-0 w-full h-full bg-black opacity-70 z-5"></div>

            <div class="relative z-10 w-full h-full flex flex-col">

                <navbar class="w-full flex justify-between p-8">
                    {{-- Bouton ouverture Menu Mobile --}}
                    <div class="md:hidden flex justify-end w-full items-center text-c3 gap-2">

                        <div>
                            <button id="boutonOuvrirMenu">
                                <span class="iconify size-10" data-icon="mdi:menu" data-inline="false"></span>
                            </button>
                        </div>

                    </div>
                    <div class="hidden md:flex gap-x-8 items-center">
                        <a
                            class="text-c3 text-xl lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                            ACCUEIL
                        </a>
                        <a
                            class="text-c3 text-xl lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                            À PROPOS
                        </a>
                    </div>
                    <div class="hidden md:flex ">
                        <a
                            class="text-xl lg:text-2xl rounded-full p-1.5 px-4 hover:bg-c3 hover:text-c1 cursor-pointer text-c3 font-barlow">
                            CONNEXION
                        </a>
                    </div>
                </navbar>
                <div class="text-c3 border mx-4"></div>

                <div class="w-full h-full flex justify-evenly items-center flex-col">
                    <div class="flex flex-col w-full items-center">
                        <span class="text-c3 font-barlow text-5xl lg:text-9xl">TROUBADOUR</span>
                        <span class="text-c3 text-xl lg:text-5xl uppercase">Explorez sans limites</span>
                    </div>
                    <div>
                        <button id="activerSection"
                            class="group items-center flex-col text-4xl flex p-1.5 text-c1 font-barlow hover:scale-110 transition-transform duration-500 ease-out">
                            <span class="bg-c2 shadow-lg px-6 rounded-full">VILLES</span>
                            <span
                                class="iconify text-c3 size-12 transform transition-all duration-1000 ease-out group-hover:translate-y-3"
                                data-icon="fluent:arrow-down-24-regular" data-inline="false"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div id="menuMobile"
            class="fixed inset-0 z-50 bg-c3 transform -translate-x-full transition-transform duration-300 md:hidden ">
            <div class="p-4 flex w-full h-full flex-col">

                <div class="flex items-center w-full">
                    <!-- Bouton pour fermer le menu mobile -->
                    <div class="flex justify-end w-full">
                        <button id="boutonFermerMenu" class="text-c1 justify-end  ">
                            <span class="iconify size-10 hover:bg-c1 hover:text-c3" data-icon="mdi:close"
                                data-inline="false"></span>
                        </button>
                    </div>
                </div>
                <!-- Liens de navigation pour mobile -->

                <nav class="space-y-8 mt-4 text-c1 font-bold font-barlow text-4xl flex flex-col h-full">
                    <a href="/"
                        class=" hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"><span
                            class="iconify size-10 " data-icon="mdi:home" data-inline="false"></span>ACCUEIL</a>
                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                            class="iconify size-10 " data-icon="mdi:about" data-inline="false"></span>À PROPOS</a>
                    <a href=""
                        class="hover:opacity-80 hover:bg-c2 p-2 transition duration-300 flex items-center w-full"> <span
                            class="iconify size-10 " data-icon="mdi:user" data-inline="false"></span>CONNEXION</a>

                    {{-- <!-- TODO Bouton deconnexion pour mobile -->
                <form action="" method="POST">
                    @csrf
                    <button class="  hover:bg-c4 p-2 transition duration-300 flex items-center w-full">
                        <span class="iconify size-10" data-icon="mdi:logout" data-inline="false"></span> DÉCONNEXION
                    </button>
                </form> --}}
                </nav>

            </div>
        </div>
    </div>

    <div id="sectionCacher"
        class="flex flex-col w-full h-screen  gap-y-8 sm:gap-y-16 bg-c2 text-c2 font-barlow text-5xl opacity-0 transition-opacity hidden duration-1000 ease-out">

        <div class="pt-4 flex justify-center">
            <span id="villeSpan"
                class="font-bold animate-pulse uppercase text-xl md:text-2xl lg:text-4xl xl:text-7xl text-c1">Chargement...</span>
        </div>
        <div class=" border-c1 border rounded mx-16"></div>

        <div id="conteneurCarte"
            class="grid gap-y-2 gap-x-0.5  overflow-x-hidden   grid-cols-2 md:grid-cols-3   xl:grid-cols-5 shadow-lg place-items-center w-full h-full overflow-y-auto xl:overflow-hidden py-8 lg:py-0  ">

        </div>
    </div>
    </div>

    <script src="{{ asset('js/Accueil.js') }}"></script>

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

