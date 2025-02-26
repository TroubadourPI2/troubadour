
document.addEventListener("DOMContentLoaded", function() {
    const btnAjouter = document.getElementById("boutonAjouterActivite");
    btnAjouter.addEventListener("click", function() {

        document.getElementById("afficherActivites").classList.add("hidden");
 
        document.getElementById("ajouterActivite").classList.remove("hidden");
    });

    const btnRetourAjout = document.getElementById("boutonRetourAfficherActivite");
    btnRetourAjout .addEventListener("click", function() {
 
        document.getElementById("ajouterActivite").classList.add("hidden");
    
        document.getElementById("afficherActivites").classList.remove("hidden");
    });
});

