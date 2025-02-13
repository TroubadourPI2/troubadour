
function CreerCarte(lieu) {
    const carte = document.createElement("div");
    carte.className = "transition-all duration-700 w-40 h-56 sm:w-48 sm:h-64 bg-c3 rounded-lg flex flex-col items-center hover:border hover:scale-110 hover:border-c1 cursor-pointer carteLieu opacity-0";

    const image = document.createElement("img");
    image.src = lieu.photoLieu || "images/Logos/logoC1.svg";
    image.alt = lieu.nomEtablissement || "Image du lieu";
    image.className = "rounded-md h-32 sm:h-40 m-2";
    carte.appendChild(image);

    const titre = document.createElement("span");
    titre.textContent = lieu.nomEtablissement || "Nom inconnu";
    titre.className = "text-c1 font-barlow text-2xl m-2 carteTitre";
    carte.appendChild(titre);

    const description = document.createElement("span");
    description.textContent = lieu.description || "Insérer une description";
    description.className = "text-black font-barlow text-sm text-center";
    carte.appendChild(description);

    carte.addEventListener("click", function() {
        window.location.href = `/lieu/${lieu.id}`;
    });

    return carte;
}

function CreerCarteDerniere(type) {
    const carte = document.createElement("div");
    
    if (type === "voirPlus") {
        carte.className = 
            "w-40 h-56 sm:w-48 sm:h-64 bg-c3 rounded-lg flex flex-col items-center p-3  hover:border-c1 hover:border cursor-pointer rounded-md shadow-lg opacity-0 hover:scale-110 transition-all duration-700 lg:mb-2 xl:mb-0";
    } else {
    
        carte.className = 
            "col-span-full justify-self-center  w-40 h-56 sm:w-48 sm:h-64 bg-c3 rounded-lg flex flex-col items-center p-3 hover:border-c1 hover:border cursor-pointer rounded-md shadow-lg  opacity-0 hover:scale-110 transition-all duration-700 lg:mb-2 xl:mb-0";
    }

    const image = document.createElement("img");
    image.src = "images/Logos/logoC1.svg";
    image.alt = (type === "voirPlus") ? "Voir plus" : "Voir d'autres villes";
    image.className = "rounded-md h-32 sm:h-40 m-2";
    carte.appendChild(image);

    const titre = document.createElement("span");
    titre.textContent = (type === "voirPlus") ? "VOIR PLUS ..." : "VOIR D'AUTRES VILLES";
    titre.className = "text-c1 font-barlow text-xl my-2 carteTitre";
    carte.appendChild(titre);

    const description = document.createElement("span");
    description.textContent = (type === "voirPlus") ? "Insérer une description" : "";
    description.className = "text-black font-barlow text-sm text-center";
    carte.appendChild(description);

    carte.addEventListener("click", function() {
        if (type === "voirPlus") {
            window.location.href = "/recherche";
        } else {
            window.location.href = "/villes";
        }
    });

    return carte;
}


document.addEventListener("DOMContentLoaded", function() {
    const boutonVilles = document.getElementById("activerSection");
    const villeSpan = document.getElementById("villeSpan");
    const sectionCacher = document.getElementById("sectionCacher");
    const conteneurCarte = document.getElementById("conteneurCarte");

    boutonVilles.addEventListener("click", function() {
        axios.get('/geolocalisation/ville')
            .then(function(response) {
                const donnee = response.data;
        
                if (donnee.ville) {
                    localStorage.setItem("usagerVilleAccueil", donnee.ville);
                    villeSpan.textContent = donnee.ville;
                    villeSpan.classList.remove("animate-pulse");
                    console.log(donnee.ville);
                } else {
                    villeSpan.textContent = "Lieux à découvrir";
                    villeSpan.classList.remove("animate-pulse");
                }
                if (donnee.lieux && Array.isArray(donnee.lieux) && donnee.lieux.length > 0) {
              
                    conteneurCarte.innerHTML = "";
          
                    donnee.lieux.forEach(function(lieu, index) {
                        const carte = CreerCarte(lieu);
                        conteneurCarte.appendChild(carte);
                        setTimeout(function() {
                            carte.classList.remove("opacity-0");
                        }, index * 300);
                    });
          
                    const carteVoirPlus = CreerCarteDerniere("voirPlus");
                    conteneurCarte.appendChild(carteVoirPlus);
                    setTimeout(function() {
                        carteVoirPlus.classList.remove("opacity-0");
                    }, donnee.lieux.length * 300);
                } else {
                 
                    villeSpan.textContent = "Bientôt disponible dans votre ville";
                    conteneurCarte.innerHTML = "";
                    const carteVoirDautres = CreerCarteDerniere("voirDautresVilles");
                    conteneurCarte.appendChild(carteVoirDautres);
                    setTimeout(function() {
                        carteVoirDautres.classList.remove("opacity-0");
                    }, 300);
                }
             
                sectionCacher.classList.remove("hidden", "opacity-0");
                setTimeout(function() {
                    sectionCacher.classList.add("opacity-100");
                }, 100);
                sectionCacher.scrollIntoView({
                    behavior: "smooth"
                });
            })
            .catch(function(error) {
                console.error("Erreur de géolocalisation", error);
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
