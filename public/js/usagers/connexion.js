function loadCustomCSS() {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "/connexion.css"; // Adjust path if needed
    link.type = "text/css";
    document.head.appendChild(link);
}
// Call this function before showing the modal
loadCustomCSS();

function showLoginModal() {
    // Get CSRF token dynamically
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    Swal.fire({
        title: "Connexion",
        html:
            '<input id="courriel" type="email" class="swal2-input" placeholder="Courriel">' +
            '<input id="password" type="password" class="swal2-input" placeholder="Mot de passe">',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Se connecter",
        cancelButtonText: "Annuler",
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

            fetch("/usagers/connect", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token, 
                },
                body: JSON.stringify({ courriel, password }),
            })
            .then(response => {
                console.log("Response status:", response.status); // Log response status
                return response.json();
            })
            .then(data => {
                console.log("Server Response:", data); // Log server response
                if (data.success) {
                    // Swal.fire("Connexion réussie!", "", "success").then(() => window.location.reload());
                    console.log("User ID:", data.user_id);
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
                    Swal.fire("Erreur", "Courriel ou mot de passe incorrect.", "error");
                }
            })
            .catch((error) => {
                console.error("Fetch Error:", error); // Log the actual fetch error
                Swal.fire("Erreur de connexion", "Une erreur s'est produite. Veuillez réessayer.", "error");
            });
            
        }
    });
}