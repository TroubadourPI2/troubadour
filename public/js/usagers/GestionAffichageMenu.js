let boutonsMenu;
let sectionsMenu;

document.addEventListener("DOMContentLoaded", function () {
    InitialiserMenu();
});

function InitialiserMenu() {
    ObtenirElements();
    AjouterMenuListeners();
}

function ObtenirElements() {
    boutonsMenu = document.querySelectorAll(".boutonMenu");
    console.log(boutonsMenu);
    sectionsMenu = document.querySelectorAll(".sectionMenu");
}

function BasculerClassesBouton(boutonMenu, ajouterClasses, retirerClasses) {
    boutonMenu.classList.remove(...retirerClasses);
    boutonMenu.classList.add(...ajouterClasses);
}

function CacherToutesLesSections() {
    sectionsMenu.forEach((section) => {
        section.classList.add("hidden");
    });
}

function AjouterMenuListeners() {
    boutonsMenu.forEach((boutonMenu) => {
        boutonMenu.addEventListener("click", function () {
            boutonsMenu.forEach((btn) => {
                BasculerClassesBouton(btn, ["sm:hover:bg-c1", "sm:hover:text-c3"], ["bg-c1", "text-c3"]);
            });

            BasculerClassesBouton(boutonMenu, ["bg-c1", "text-c3"], ["sm:hover:bg-c1", "sm:hover:text-c3"]);

            CacherToutesLesSections();
            const sectionId = boutonMenu.getAttribute("data-section");
            document.getElementById(sectionId).classList.remove("hidden");
        });
    });
}
