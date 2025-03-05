let filtreQuartier;
let filtreVille;
let rechercheNomLieu;
let boutonFiltreActif;
let filtreForm;
let actif;
let texteActifRechercheAdmin;

document.addEventListener('DOMContentLoaded', function () {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsRechercheLieux();
    filtreVille.value = "";
    boutonFiltreActif.checked = true;
    actif = boutonFiltreActif.checked ? 1 : 0 ;
    FiltrerLieux();
    RechercheLieuxListeners();
});

function ObtenirElementsRechercheLieux() {
    filtreQuartier = document.getElementById('filtreQuartier');
    filtreVille = document.getElementById('filtreVille');
    rechercheNomLieu = document.getElementById('rechercheNomLieu');
    boutonFiltreActif = document.getElementById("boutonFiltreActif");
    texteActifRechercheAdmin = document.getElementById("texteActifRechercheAdmin");
}

function RechercheLieuxListeners() {
    filtreVille.addEventListener('change', function () {
        FiltrerLieux();
        if (filtreVille.value != '') {
            ObtenirQuartiersParVille(filtreVille.value);

        } else {
            filtreQuartier.innerHTML = '';
        }
    });

    filtreQuartier.addEventListener('change', FiltrerLieux);
    rechercheNomLieu.addEventListener('input', FiltrerLieux);
    boutonFiltreActif.addEventListener("change", function () {
        actif = boutonFiltreActif.checked ? 1 : 0 ;
        MettreAjourTexteActif(actif);
        boutonFiltreActif.checked = actif;
        FiltrerLieux();
    });
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

function MettreAjourTexteActif(estActif){
    texteActifRechercheAdmin.textContent = estActif === 1 ? Lang.get('strings.actif') : Lang.get('strings.inactif');
}

let pageCourante = 1;
const lieuxParPage = 10;

function FiltrerLieux() {
    const villeId = filtreVille.value;
    const quartierId = filtreQuartier.value;
    const rechercheNom = rechercheNomLieu.value.trim();
    const params = {};
    if (villeId) params.villeId = villeId;
    if (quartierId) params.quartierId = quartierId;
    if (rechercheNom) params.rechercheNom = rechercheNom;
    params.actif = actif;
    axios
        .get('/admin/recherche', { params })
        .then((response) => {
            if (response.data.lieux) {
                AfficherLieux(response.data.lieux);
            } else {
                AfficherMessage(response.data.message);
            }
        })
        .catch((error) => {
            console.error('Erreur lors du filtrage des lieux', error);
        });
    

    ObtenirElementsSupprimer();
    console.log(boutonsSupprimer)
    AjouterSupprimerListeners();
}

function AfficherMessage(message) {
    const container = document.getElementById('affichageDesLieux');
    container.innerHTML = `<p class="text-lg font-semibold text-c1 uppercase">${message}</p>`;
}

function AfficherErreur() {
    const container = document.getElementById('affichageDesLieux');
    container.innerHTML = '<p>Une erreur est survenue lors de la recherche des lieux. Veuillez réessayer.</p>';
}


function AfficherLieux(lieux) {
    const containerLieux = document.getElementById('affichageDesLieux');
    containerLieux.innerHTML = '';

    if (lieux.length === 0) {
        containerLieux.innerHTML = '<p>Aucun lieu trouvé pour les critères de recherche.</p>';
        return;
    }

    lieux.forEach((lieu) => {
        // Carte mobile
        const carteMobile = `
            <div class="sm:hidden flex flex-row flex-wrap gap-4 items-center text-c1 rounded-lg ">
                <div class="carteLieuxMobile relative w-full h-96 mb-4 rounded-lg shadow-xl transition-transform duration-500 [transform-style:preserve-3d] hover:shadow-2xl">
                    <div class="absolute bg-c3 inset-0 rounded-lg shadow-lg flex flex-col items-center p-4 [backface-visibility:hidden] ${!lieu.actif ? 'bg-[#B0B7B7]' : ''}">
                        <img class="object-cover w-full h-72 rounded-t-lg" src="${lieu.photo_lieu_url}" alt="${lieu.nomEtablissement}">
                        <h5 class="text-xl font-bold uppercase p-2 text-center h-full flex items-center">${lieu.nomEtablissement}</h5>
                    </div>
                    <div class="carteLieuxMobileDerriere absolute inset-0 bg-c3 rounded-lg shadow-lg p-4 [transform:rotateY(180deg)] [backface-visibility:hidden]" onClick="TournerCarteLieux(this)">
                        <div class="flex flex-col justify-between h-full">
                           <div class="mb-2">
                                <div class="flex justify-end gap-2">
                                    <span class="text-lg font-semibold text-c1 uppercase texteActif"
                         data-lieuId="${lieu.id}" data-actif="${lieu.actif}">
                        ${lieu.actif === 1 ? Lang.get('strings.actif') : Lang.get('strings.inactif')}
                        </span>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="actif" class="boutonBascule sr-only peer "
                                            data-lieuId="${lieu.id}"
                                            data-nomLieu="${lieu.nomEtablissement}"
                                            ${lieu.actif === 1 ? 'checked' : ''}>

                                        <div
                                            class="w-11 h-6 bg-c2 rounded-full peer peer-checked:bg-c1 peer-checked:after:translate-x-full 
                    rtl:peer-checked:after:-translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] 
                    after:bg-c1 peer-checked:after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all">
                                        </div>
                                    </label>
                                </div>
                                <div class="uppercase underline text-base font-semibold">${Lang.get('strings.description')}
                                </div>
                                <div class="truncate">${lieu.description ?? Lang.get('strings.aucuneDescription')}</div>
                            </div>

                            <div class="mb-4">
                                <div class="uppercase underline text-lg font-semibold">${Lang.get('strings.coordonneesEtInfo')}</div>
                                <div class="text-sm">
                                    <p><strong>${Lang.get('strings.adresse')}:</strong> ${lieu.noCivic}, ${lieu.rue}</p>
                            <p><strong>${Lang.choice('strings.ville', 1)} :</strong> ${lieu.ville.nom}, ${lieu.codePostal}</p>
                            <p><strong>${Lang.get('strings.quartier')} :</strong> ${lieu.quartier.nom}</p>
                            ${lieu.province ? `<p><strong>${Lang.get('strings.province')} :</strong> ${lieu.province.nom}</p>` : ''}
                            ${lieu.region ? `<p><strong>${Lang.get('strings.region')} :</strong> ${lieu.region.nom}</p>` : ''}
                            <p><strong>${Lang.get('strings.pays')} :</strong> ${lieu.pays.nom}</p>
                            <p><strong>${Lang.get('strings.typeLieu')} :</strong> ${lieu.typeLieu}</p>
                            ${lieu.siteWeb ?
                `<p class="truncate"><strong>${Lang.get('strings.siteWeb')} :</strong> 
                                    <a href="${lieu.siteWeb}" class="text-blue-500 underline" target="_blank">${lieu.siteWeb}</a>
                                </p>`
                : ''}
                            <p><strong>${Lang.get('strings.telephone')} :</strong> ${lieu.numeroTelephone}</p>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3 mt-3">
                                <button class="boutonSupprimer text-[#B20101]" data-lieuId="${lieu.id}"
                                    data-nomLieu="${lieu.nomEtablissement}" onclick="AjouterSupprimerListenersTest(this)"><span class="iconify size-6"
                                        data-icon="ion:trash-outline" data-inline="false"></span></button>
                                <button class="boutonModifier" data-lieuId="${lieu.id}"
                                    data-villeId="${lieu.ville.id}"
                                    data-typeLieuId="${lieu.typeLieu.id}" onclick="AfficherPageModifierLieuAdmin(this)"><span class="iconify size-6"
                                        data-icon="ep:edit" data-inline="false"></span></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        `;

        // Carte Web/Tablette
        const carteWeb = `
            <div  class="carteWeb  flex-col sm:flex-row text-c1 rounded-lg shadow-md bg-white w-full max-w-4xl mx-auto my-4 hidden sm:flex h-[68vh] hover:shadow-2xl transition">
                <div class="w-full sm:w-1/2 rounded-l-lg h-full p-4">
                    <img class="object-cover w-full h-full rounded" src="${lieu.photo_lieu_url}" alt="${lieu.nomEtablissement}">
                </div>
                <div class="w-full sm:w-1/2 p-4 flex flex-col h-full gap-y-4 relative">
                    <div class="flex justify-end gap-2">
                        <span class="text-lg font-semibold text-c1 uppercase texteActif"
                         data-lieuId="${lieu.id}" data-actif="${lieu.actif}">
                        ${lieu.actif === 1 ? Lang.get('strings.actif') : Lang.get('strings.inactif')}
                        </span>
                          <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="actif" class="boutonBascule sr-only peer" data-lieuId="${lieu.id}" data-nomLieu="${lieu.nomEtablissement}" ${lieu.actif === 1 ? 'checked' : ''}>
                <div class="w-11 h-6 bg-c2 rounded-full peer peer-checked:bg-c1 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-c1 peer-checked:after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
            </label>   
                    </div>
                    <div class="w-full">
                    <h5 class="text-xl font-bold uppercase w-48 truncate">${lieu.nomEtablissement}</h5>
                    </div>
                    <div>
                        <div class="uppercase underline text-lg font-semibold">${Lang.get('strings.description')}</div>
                        <div class="text-base truncate">${lieu.description ?? Lang.get('strings.aucuneDescription')}</div>
                    </div>
                    <div class="mb-4">
                        <div class="uppercase underline text-lg font-semibold">${Lang.get('strings.coordonneesEtInfo')}</div>
                       <div class="text-base">
                            <p><strong>${Lang.get('strings.adresse')}:</strong> ${lieu.noCivic}, ${lieu.rue}</p>
                            <p><strong>${Lang.choice('strings.ville', 1)} :</strong> ${lieu.ville.nom}, ${lieu.codePostal}</p>
                            <p><strong>${Lang.get('strings.quartier')} :</strong> ${lieu.quartier.nom}</p>
                            ${lieu.province ? `<p><strong>${Lang.get('strings.province')} :</strong> ${lieu.province.nom}</p>` : ''}
                            ${lieu.region ? `<p><strong>${Lang.get('strings.region')} :</strong> ${lieu.region.nom}</p>` : ''}
                            <p><strong>${Lang.get('strings.pays')} :</strong> ${lieu.pays.nom}</p>
                            <p><strong>${Lang.get('strings.typeLieu')} :</strong> ${lieu.typeLieu}</p>
                            ${lieu.siteWeb ?
                `<p class="truncate"><strong>${Lang.get('strings.siteWeb')} :</strong> 
                                    <a href="${lieu.siteWeb}" class="text-blue-500 underline" target="_blank">${lieu.siteWeb}</a>
                                </p>`
                : ''}
                            <p><strong>${Lang.get('strings.telephone')} :</strong> ${lieu.numeroTelephone}</p>
                        </div>
                    </div>
                     <div class="flex justify-end space-x-4 mt-auto">

                        <button
                            class="boutonSupprimer transform transition duration-300 hover:scale-110 text-[#B20101] hover:text-[#B50000]"
                            data-lieuId="${lieu.id}" data-nomLieu="${lieu.nomEtablissement}" onclick="AjouterSupprimerListenersTest(this)">
                            <span class="iconify size-8" data-icon="ion:trash-outline" data-inline="false"></span>
                        </button>
                        <button
                            class="boutonModifier transform transition duration-300 hover:scale-110 text-c1-500 hover:text-c1-700"
                            data-lieuId="${lieu.id}" data-villeId="${lieu.ville.id}"
                            data-typeLieuId="${lieu.typeLieu.id}" onclick="AfficherPageModifierLieuAdmin(this)">
                            <span class="iconify size-8" data-icon="ep:edit" data-inline="false"></span>
                        </button>
                    </div>
                </div>
            </div>
        `;

        // Ajouter directement les cartes dans le conteneur sans wrapper supplémentaire
        containerLieux.innerHTML += carteMobile + carteWeb;
    });
}
