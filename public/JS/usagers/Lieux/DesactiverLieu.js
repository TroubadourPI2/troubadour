let boutonBascule;
let texteActif;

document.addEventListener("DOMContentLoaded", function () {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsDesactiver();
    AjouterDesactiverListeners();
    // Vérifier l'état initial du bouton au démarrage
    VerifierEtatInitial();
});

function ObtenirElementsDesactiver() {
    boutonBascule = document.getElementById("boutonBascule");
    texteActif = document.getElementById("texteActif");
}

function AjouterDesactiverListeners() {
    boutonBascule.addEventListener('change', function () {
        // Message de confirmation avant de changer le toggle
        const action = boutonBascule.checked ? "désactiver" : "activer";
        
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: `Voulez-vous vraiment ${action} ce lieu ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: `Oui, ${action}`,
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si l'utilisateur confirme, on peut changer l'état du toggle
                console.log(`Le lieu a été ${action} avec succès.`);
                
                // Logique pour activer ou désactiver le lieu dans ta base de données
                // Par exemple, envoyer une requête à ton serveur pour changer l'état du lieu
                
                // Si l'action est de désactiver, le toggle doit être décoché
                // Si l'action est d'activer, le toggle doit être coché
                boutonBascule.checked = !boutonBascule.checked;

                // Mise à jour du texte associé à l'état
                texteActif.textContent = boutonBascule.checked ? "Actif" : "Inactif";
            } else {
                // Si l'utilisateur annule, réinitialise l'état du toggle à son état initial
                console.log("L'utilisateur a annulé l'action.");
                boutonBascule.checked = !boutonBascule.checked;
            }
        });
    });
}

function VerifierEtatInitial() {
    // Vérifie l'état initial du toggle au chargement de la page
    if (boutonBascule.checked) {
        console.log("Le lieu est actuellement actif.");
        texteActif.textContent = "Actif";  // Mettre à jour le texte
    } else {
        console.log("Le lieu est actuellement inactif.");
        texteActif.textContent = "Inactif";  // Mettre à jour le texte
    }
}
