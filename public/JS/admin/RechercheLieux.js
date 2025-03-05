let filtreQuartier;
let filtreVille;
let rechercheNomLieu;
let filtreForm;

document.addEventListener('DOMContentLoaded', function () {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsRechercheLieux();
    RechercheLieuxListeners();
});

function ObtenirElementsRechercheLieux() {
    filtreQuartier = document.getElementById('filtreQuartier');
    filtreVille = document.getElementById('filtreVille');
    rechercheNomLieu = document.getElementById('rechercheNomLieu');
}

function RechercheLieuxListeners() {
    filtreVille.addEventListener('change', function () {
        if (filtreVille.value != '') {
            ObtenirQuartiersParVille(filtreVille.value);
            FiltrerLieux();
        } else {
            filtreQuartier.innerHTML = '';
        }
    });

    filtreQuartier.addEventListener('change', FiltrerLieux);
    rechercheNomLieu.addEventListener('input', FiltrerLieux);
}

function MettreAJourRechercheQuartier(quartiers) {
    filtreQuartier.innerHTML = '';
    const optionDefaut = document.createElement('option');
    optionDefaut.value = '';
    optionDefaut.textContent = Lang.get('strings.choisirQuartier');
    filtreQuartier.appendChild(optionDefaut);

    quartiers.forEach((quartier) => {
        const option = document.createElement('option');
        option.value = quartier.id;
        option.textContent = quartier.nom;
        filtreQuartier.appendChild(option);
    });
}

function FiltrerLieux() {
    const villeId = filtreVille.value;
    const quartierId = filtreQuartier.value;
    const rechercheNom = rechercheNomLieu.value.trim();
    const params = {};
    if (villeId) params.villeId = villeId;
    if (quartierId) params.quartierId = quartierId;
    if (rechercheNom) params.rechercheNom = rechercheNom;

    axios
        .get('/admin/recherche', { params })
        .then((response) => {
            if (response.data) {
                console.log("test");
                console.log(response.data);
                AfficherLieux(response.data);
            } else {
                AfficherAucunResultat();
            }
        })
        .catch((error) => {
            console.error('Erreur lors du filtrage des lieux', error);
            AfficherErreur();
        });
}

function AfficherAucunResultat() {
    const container = document.getElementById('affichageDesLieux');
    container.innerHTML = '<p>Aucun lieu trouvé pour les critères de recherche.</p>';
}

function AfficherErreur() {
    const container = document.getElementById('affichageDesLieux');
    container.innerHTML = '<p>Une erreur est survenue lors de la recherche des lieux. Veuillez réessayer.</p>';
}

function AfficherLieux(lieux) {
    const container = document.getElementById('affichageDesLieux');
    container.innerHTML = ''; // Reset the container

    if (lieux.length === 0) {
        container.innerHTML = '<p>Aucun lieu trouvé pour les critères de recherche.</p>';
        return;
    }

    lieux.forEach((lieu) => {
        console.log(lieu.typeLieu)
        const div = document.createElement('div');
        div.classList.add('lieu');
        // Carte mobile
        const carteMobile = `
            <div class="sm:hidden flex flex-row flex-wrap gap-4 items-center text-c1 rounded-lg">
                <div class="carteLieuxMobile relative w-full min-h-[50vh] mb-4 rounded-lg shadow-xl transition-transform duration-500 [transform-style:preserve-3d] hover:shadow-2xl">
                    <div class="absolute bg-c3 inset-0 rounded-lg shadow-lg flex flex-col items-center p-4 [backface-visibility:hidden] ${!lieu.actif ? 'bg-[#B0B7B7]' : ''}">
                        <img class="object-cover w-full h-72 rounded-t-lg" src="${lieu.photo_lieu_url}" alt="${lieu.nomEtablissement}">
                        <h5 class="text-xl font-bold uppercase p-2 text-center h-full flex items-center">${lieu.nomEtablissement}</h5>
                    </div>
                    <div class="carteLieuxMobileDerriere absolute inset-0 bg-c3 rounded-lg shadow-lg p-4 [transform:rotateY(180deg)] [backface-visibility:hidden]">
                        <div class="flex flex-col justify-between h-full">
                            <div class="mb-2">
                                <div class="flex justify-end gap-2">
                                    <span class="text-lg font-semibold text-c1 uppercase texteActif">${lieu.actif === 1 ? 'Actif' : 'Inactif'}</span>
                                </div>
                                <div class="uppercase underline text-base font-semibold">Description</div>
                                <div class="truncate">${lieu.description ?? 'Aucune description'}</div>
                            </div>
                            <div class="mb-4">
                                <div class="uppercase underline text-lg font-semibold">Coordonnées et Info</div>
                                <div class="text-sm">
                                    <p><strong>Adresse :</strong> ${lieu.noCivic}, ${lieu.rue}</p>
                             
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Carte Web/Tablette
        const carteWeb = `
            <div class="carteWeb flex flex-col sm:flex-row text-c1 rounded-lg shadow-md bg-white w-full max-w-4xl mx-auto my-4 hidden sm:flex h-[65vh] hover:shadow-2xl transition">
                <div class="w-full sm:w-1/2 rounded-l-lg h-full p-4">
                    <img class="object-cover w-full h-full rounded" src="${lieu.photo_lieu_url}" alt="${lieu.nomEtablissement}">
                </div>
                <div class="w-full sm:w-1/2 p-4 flex flex-col h-full gap-y-4 relative">
                    <div class="flex justify-end gap-2">
                        <span class="text-lg font-semibold text-c1 uppercase texteActif">${lieu.actif === 1 ? 'Actif' : 'Inactif'}</span>
                    </div>
                    <h5 class="text-xl font-bold uppercase truncate">${lieu.nomEtablissement}</h5>
                    <div>
                        <div class="uppercase underline text-lg font-semibold">Description</div>
                        <div class="text-base truncate">${lieu.description ?? 'Aucune description'}</div>
                    </div>
                    <div class="mb-4">
                        <div class="uppercase underline text-lg font-semibold">Coordonnées et Info</div>
                        <div class="text-base">
                            <p><strong>Adresse :</strong> ${lieu.noCivic}, ${lieu.rue}</p>
                    
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Ajout des cartes (mobile et web) dans le container
        div.innerHTML = carteMobile + carteWeb;
        container.appendChild(div);
    });
}
