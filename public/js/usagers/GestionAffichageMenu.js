let boutonsMenuCompte;
let sectionsMenuCompte;

document.addEventListener("DOMContentLoaded", function () {
    ObtenirElements();
    AjouterMenuListeners();
});

function ObtenirElements() {
    boutonsMenuCompte = document.querySelectorAll(".BoutonMenuCompte");
    sectionsMenuCompte = document.querySelectorAll(".SectionMenu");
}

function AjouterMenuListeners() {
    boutonsMenuCompte.forEach((boutonMenu) => {
        boutonMenu.addEventListener("click", function () {
            boutonsMenuCompte.forEach((btn) => {
                btn.classList.remove("sm:bg-c1", "sm:text-c3");
                btn.classList.add("sm:hover:bg-c1", "sm:hover:text-c3"); 
            });
            boutonMenu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3"); 
            boutonMenu.classList.add("sm:bg-c1", "sm:text-c3"); 

            sectionsMenuCompte.forEach((section) => section.classList.add("hidden"));

            const sectionId = boutonMenu.getAttribute("data-section");
            document.getElementById(sectionId).classList.remove("hidden");
        });
    });
}
