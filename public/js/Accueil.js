function CreerCarte(lieu) {
 
    const carte = document.createElement("div");
    carte.className = "transition-all duration-700 w-full  max-h-48  bg-c3 rounded-lg flex flex-col justify-between items-center hover:border hover:border-c1 hover:scale-110 cursor-pointer carteLieu opacity-0 p-4";
  

    const containerImage = document.createElement("div");
    containerImage.className = "w-full flex h-52 overflow-hidden rounded-md";
    
    const image = document.createElement("img");
    image.src = lieu.photoLieu || "images/Lieux/image_defaut.png";
    image.alt = lieu.nomEtablissement || "Image du lieu";

    image.className = "w-full h-52 object-cover";
    
    containerImage.appendChild(image);
    carte.appendChild(containerImage);
  

    const containerText = document.createElement("div");
    containerText.className = "w-full flex flex-col items-center justify-start mt-2";
  

    const titreContainer = document.createElement("div");
    titreContainer.className = "w-full flex";
    const titre = document.createElement("span");
    titre.textContent = lieu.nomEtablissement || "Nom inconnu";
    titre.className = "text-c1 font-barlow text-base text-center font-semibold w-full truncate";
    titreContainer.appendChild(titre);
    

    const descriptionContainer = document.createElement("div");
    descriptionContainer.className = "w-full flex ";
    const description = document.createElement("span");
    description.textContent = lieu.description || "Insérer une description";
    description.className = "text-black font-barlow text-sm text-center w-full overflow-hidden truncate";
    descriptionContainer.appendChild(description);
    

    containerText.appendChild(titreContainer);
    containerText.appendChild(descriptionContainer);
    carte.appendChild(containerText);
  

    carte.addEventListener("click", function() {
      window.location.href = `/lieu/${lieu.id}`;
    });
  
    return carte;
  }
  


function CreerCarteDerniere(type) {
    const carte = document.createElement("div");
    carte.className = "transition-all duration-700 w-full  max-h-48  bg-c3 rounded-lg flex flex-col justify-between items-center hover:border hover:border-c1 hover:scale-110 cursor-pointer carteLieu opacity-0 p-4";

    const image = document.createElement("img");
    image.src = "images/Logos/logoC1.svg";
    image.alt = (type === "voirPlus") ? "Voir plus" : "Voir d'autres villes";
    image.className = "w-full h-52 object-cover";
    carte.appendChild(image);

    const titre = document.createElement("span");
    titre.textContent = (type === "voirPlus") ? "VOIR PLUS ..." : "VOIR D'AUTRES VILLES";
    titre.className = "text-c1 font-barlow text-xl text-center font-semibold";
    carte.appendChild(titre);

    carte.addEventListener("click", function() {
        window.location.href = (type === "voirPlus") ? "/recherche" : "/villes";
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
                if (conteneurCarte.children.length === 1) {
                    conteneurCarte.classList.remove("md:grid-cols-2", "xl:grid-cols-5");
                    const derniereCard = conteneurCarte.children[0];
                    derniereCard.classList.remove("w-full", "max-h-48");
                    derniereCard.classList.add("w-64", "h-64", "mx-auto");
                    const img = derniereCard.querySelector("img");
              
                      img.classList.remove("h-52");
                      img.classList.add("h-32");
                    
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
