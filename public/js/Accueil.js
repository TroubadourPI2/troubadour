document.addEventListener("DOMContentLoaded", function() {
    const buttonVilles = document.getElementById("ActiverSection");
    const villeSpan = document.getElementById("villeSpan");
    const sectionCacher = document.getElementById("sectionCacher");
    const ConteneurCarte = document.getElementById("ConteneurCarte");
    const cartes = ConteneurCarte.children;

    buttonVilles.addEventListener("click", function() {
        axios.get('/geolocalisation/ville')
            .then(response => {
                const donnee = response.data;
                if (donnee.ville) {
                    localStorage.setItem('usagerVilleAccueil', donnee.ville);
                    setTimeout(() => {
                        villeSpan.innerText = `${donnee.ville}`;
                        villeSpan.classList.remove("animate-pulse");
                        setTimeout(() => {
                            ConteneurCarte.classList.add("opacity-100");
                            Array.from(cartes).forEach((carte, index) => {
                                setTimeout(() => {
                                    carte.classList.remove(
                                        "opacity-0",
                                        "scale-90");
                                }, index * 300);
                            });
                        }, 200);

                    }, 300);
                }
            })
            .catch(error => console.error('Erreur de géolocalisation', error));
        sectionCacher.classList.remove("hidden");
        setTimeout(() => {
            sectionCacher.classList.add("opacity-100");
        }, 100);


        sectionCacher.scrollIntoView({
            behavior: "smooth"
        });
    });
});