let boutonsMenuCompte;
let sectionsMenuCompte;

document.addEventListener("DOMContentLoaded", function () {
    InitialiserMenu();
});

function InitialiserMenu() {
    ObtenirElements();
    AjouterMenuListeners();
}

function ObtenirElements() {
    boutonsMenuCompte = document.querySelectorAll(".boutonMenuCompte");
    sectionsMenuCompte = document.querySelectorAll(".sectionMenu");
}

function BasculerClassesBouton(boutonMenu, ajouterClasses, retirerClasses) {
    boutonMenu.classList.remove(...retirerClasses);
    boutonMenu.classList.add(...ajouterClasses);
}

function CacherToutesLesSections() {
    sectionsMenuCompte.forEach((section) => {
        section.classList.add("hidden");
    });
}

function AjouterMenuListeners() {
    boutonsMenuCompte.forEach((boutonMenu) => {
        boutonMenu.addEventListener("click", function () {
            // Réinitialiser l'état des boutons
            boutonsMenuCompte.forEach((btn) => {
                BasculerClassesBouton(btn, ["sm:hover:bg-c1", "sm:hover:text-c3"], ["bg-c1", "text-c3"]);
            });

            // Appliquer les classes actives au bouton cliqué
            BasculerClassesBouton(boutonMenu, ["bg-c1", "text-c3"], ["sm:hover:bg-c1", "sm:hover:text-c3"]);

            // Cacher toutes les sections et afficher celle correspondante
            CacherToutesLesSections();
            const sectionId = boutonMenu.getAttribute("data-section");
            document.getElementById(sectionId).classList.remove("hidden");
        });
    });
}
