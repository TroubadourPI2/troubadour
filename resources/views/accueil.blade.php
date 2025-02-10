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
        const { value: formValues } = await Swal.fire({
            title: "Connexion",
            html: `
                <input type="email" id="swal-input-email" class="swal2-input" placeholder="Enter your email">
                <input type="password" id="swal-input-password" class="swal2-input" placeholder="Enter your password">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: "Se Connecter",
            customClass: {
                popup: 'custom-swal-popup'  // Apply custom CSS class
            },
            preConfirm: () => { 

                
                return {
                    email: document.getElementById("swal-input-email").value,
                    password: document.getElementById("swal-input-password").value
                };
            }
        });

        if (formValues) {
            Swal.fire(`Entered Email: ${formValues.email}\nEntered Password: ${formValues.password}`);
        }
    }
</script>


<style>
    /* Custom styling for SweetAlert2 popup */
    .custom-swal-popup {
        background: rgba(200, 227, 223);
        background-size: cover;
        color: white; /* Text color */
        
    }
    
    .swal2-title {
        color: white !important; /* Title text color */
    }

    .swal2-input {
        background: rgba(255, 255, 255, 0.8); /* Semi-transparent input background */
        color: black; /* Input text color */
    }
</style>