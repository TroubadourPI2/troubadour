document.addEventListener("DOMContentLoaded", function() {
    const buttonVilles = document.getElementById("activerSection");
    const villeSpan = document.getElementById("villeSpan");
    const sectionCacher = document.getElementById("sectionCacher");
    const conteneurCarte = document.getElementById("conteneurCarte");
    const cartes = conteneurCarte.children;

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
                            conteneurCarte.classList.add("opacity-100");
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
        sectionCacher.classList.remove("opacity-0");
        setTimeout(() => {
            sectionCacher.classList.add("opacity-100");
        }, 100);


        sectionCacher.scrollIntoView({
            behavior: "smooth"
        });
    });
});

document.getElementById('boutonOuvrirMenu').addEventListener('click', function() {
    const menuMobile = document.getElementById('menuMobile');
    menuMobile.classList.remove('-translate-x-full');
    document.body.classList.add('overflow-hidden');
});

document.getElementById('boutonFermerMenu').addEventListener('click', function() {
    const menuMobile = document.getElementById('menuMobile');
    menuMobile.classList.add('-translate-x-full');
    document.body.classList.remove('overflow-hidden'); 
});
