let filtreQuartier;
let filtreVille;
let rechercheNomLieu;
let boutonFiltreActif;
let filtreForm;
let actif;
let texteActifRechercheAdmin;
let lieuxParPages;
let selectParPage;
let pageActuelle = 1;

document.addEventListener('DOMContentLoaded', function () {
    ObtenirElementsRechercheLieux();
    filtreVille.value = '';
    boutonFiltreActif.checked = true;
    actif = boutonFiltreActif.checked ? 1 : 0;
    lieuxParPages = selectParPage.value;
    rechercheNomLieu.value = '';
    FiltrerLieux(1,false);
    RechercheLieuxListeners();
});

function ObtenirElementsRechercheLieux() {
    filtreQuartier = document.getElementById('filtreQuartier');
    filtreVille = document.getElementById('filtreVille');
    rechercheNomLieu = document.getElementById('rechercheNomLieu');
    boutonFiltreActif = document.getElementById('boutonFiltreActif');
    texteActifRechercheAdmin = document.getElementById(
        'texteActifRechercheAdmin'
    );
    selectParPage = document.getElementById("lieuxParPage");
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
    boutonFiltreActif.addEventListener('change', function () {
        actif = boutonFiltreActif.checked ? 1 : 0;
        MettreAjourTexteActif(actif);
        boutonFiltreActif.checked = actif;
        FiltrerLieux();
    });

    selectParPage.addEventListener("change", function () {
        lieuxParPages = parseInt(this.value);
        FiltrerLieux(1)
    })
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

function MettreAjourTexteActif(estActif) {
    texteActifRechercheAdmin.textContent =
        estActif === 1
            ? Lang.get('strings.actif')
            : Lang.get('strings.inactif');
}

function FiltrerLieux(page = 1, majStatut = true) {
    pageActuelle = page;
    const villeId = filtreVille.value;
    const quartierId = filtreQuartier.value;
    const rechercheNom = rechercheNomLieu.value.trim();

    const params = {
        page: page,
        parPage: lieuxParPages
    };
    if (villeId) params.villeId = villeId;
    if (quartierId) params.quartierId = quartierId;
    if (rechercheNom) params.rechercheNom = rechercheNom;
    params.actif = actif;
    axios
        .get('/admin/recherche/lieux', { params })
        .then((response) => {
            if (response.data.lieux) {
                AfficherLieux(response.data.lieux, majStatut);
                document.getElementById('pagination').innerHTML = PaginationLieux(response.data.pagination, "FiltrerLieux");
            } else {
                AfficherMessage(response.data.message);
            }
        })
        .catch((error) => {
            console.error('Erreur lors du filtrage des lieux', error);
        });
}

function AfficherMessage(message) {
    const containerLieux = document.getElementById('affichageDesLieux');
    containerLieux.innerHTML = `<p class="text-lg font-semibold text-c1 uppercase">${message}</p>`;
}

function AfficherLieux(lieux, majStatut) {
    const containerLieux = document.getElementById('affichageDesLieux');
    containerLieux.innerHTML = '';

    if (lieux.length === 0) {
        containerLieux.innerHTML =
            '<p>Aucun lieu trouvé pour les critères de recherche.</p>';
        return;
    }

    lieux.forEach((lieu) => {
        // Carte mobile
        const carteMobile = `
            <div class="sm:hidden flex flex-row flex-wrap gap-4 items-center text-c1 rounded-lg ">
                <div class="carteLieuxMobile relative w-full h-96 mb-4 rounded-lg shadow-xl transition-transform duration-500 [transform-style:preserve-3d] hover:shadow-2xl">
                    <div class="absolute bg-c3 inset-0 rounded-lg shadow-lg flex flex-col items-center p-4 [backface-visibility:hidden] ${!lieu.actif ? 'bg-[#B0B7B7]' : ''}">
                        <img class="object-cover w-full h-72 rounded-t-lg" src="${lieu.photoLieu}" alt="${lieu.nomEtablissement}">
                        <h5 class="text-xl font-bold uppercase p-2 text-center h-full flex items-center">${lieu.nomEtablissement}</h5>
                    </div>
                    <div class="carteLieuxMobileDerriere absolute inset-0 bg-c3 rounded-lg shadow-lg p-4 [transform:rotateY(180deg)] [backface-visibility:hidden]">
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
                            ${lieu.siteWeb
                ? `<p class="truncate"><strong>${Lang.get('strings.siteWeb')} :</strong> 
                                    <a href="${lieu.siteWeb}" class="text-blue-500 underline" target="_blank">${lieu.siteWeb}</a>
                                </p>`
                : ''
            }
                            <p><strong>${Lang.get('strings.telephone')} :</strong> ${lieu.numeroTelephone}</p>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3 mt-3">
                                <button class="boutonSupprimer text-[#B20101]" data-lieuId="${lieu.id}"
                                    data-nomLieu="${lieu.nomEtablissement}" ><span class="iconify size-6"
                                        data-icon="ion:trash-outline" data-inline="false"></span></button>
                                <button class="boutonModifier" data-lieuId="${lieu.id}"
                                    data-villeId="${lieu.ville.id}"
                                    data-typeLieuId="${lieu.typeLieu.id}" ><span class="iconify size-6"
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
                    <img class="object-cover w-full h-full rounded" src="${lieu.photoLieu}" alt="${lieu.nomEtablissement}">
                </div>
                <div class="w-full sm:w-1/2 p-4 flex flex-col h-full gap-y-4 relative">
                    <div class="flex justify-end gap-2">
                        <span class="text-lg font-semibold text-c1 uppercase texteActif"
                         data-lieuId="${lieu.id}" data-actif="${lieu.actif}">
                        ${lieu.actif === 1 ? Lang.get('strings.actif') : Lang.get('strings.inactif')}
                        </span>
                          <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="actif" class="boutonBascule sr-only peer"
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
                            ${lieu.siteWeb
                ? `<p class="truncate"><strong>${Lang.get('strings.siteWeb')} :</strong> 
                                    <a href="${lieu.siteWeb}" class="text-blue-500 underline" target="_blank">${lieu.siteWeb}</a>
                                </p>`
                : ''
            }
                            <p><strong>${Lang.get('strings.telephone')} :</strong> ${lieu.numeroTelephone}</p>
                        </div>
                    </div>
                     <div class="flex justify-end space-x-4 mt-auto">

                        <button
                            class="boutonSupprimer transform transition duration-300 hover:scale-110 text-[#B20101] hover:text-[#B50000]"
                            data-lieuId="${lieu.id}" data-nomLieu="${lieu.nomEtablissement}">
                            <span class="iconify size-8" data-icon="ion:trash-outline" data-inline="false"></span>
                        </button>
                        <button
                            class="boutonModifier transform transition duration-300 hover:scale-110 text-c1-500 hover:text-c1-700"
                            data-lieuId="${lieu.id}" data-villeId="${lieu.ville.id}"
                            data-typeLieuId="${lieu.typeLieu.id}">
                            <span class="iconify size-8" data-icon="ep:edit" data-inline="false"></span>
                        </button>
                    </div>
                </div>
            </div>
        `;

        containerLieux.innerHTML += carteMobile + carteWeb;
    });
    //Fonctions dans public/js/usagers/lieux/SupprimerLieu.js
    ObtenirElementsSupprimer();
    AjouterSupprimerListeners();
    ObtenirElementsModifier();
    //Fonctions dans public/js/usagers/lieux/ModifierLieu.js
    AjouterModifierListeners();
    if (selectVilleLieuModifie.value) {
        ObtenirQuartiersParVille(selectVilleLieuModifie.value);
    }
  
    if (majStatut) {
        //Fonctions dans public/js/usagers/lieux/ChangerEtatLieu.js
        ObtenirElementsDesactiver();
        AjouterDesactiverListeners();
        MiseAJourStatutLieu();
        //Fonctions dans public/js/usagers/lieux/GestionAffichageSectionsLieux.js
        ObtenirElementsLieux();
        AjouterGestionAffichageListeners();
    }
}

function PaginationLieux(donnees, fonction) {
    return `
    <div class="flex gap-2 mt-4">
        <!-- Bouton Première Page -->
        <button type="button"
            class="bg-c1 hover:bg-c3 h-12 hover:text-c1 text-white font-bold py-2 px-4 rounded-l flex items-center justify-center transition 
            ${!donnees.prev_page_url ? 'cursor-not-allowed opacity-50' : ''}"
            onclick="${fonction}(1)" ${!donnees.prev_page_url ? 'disabled' : ''}>
            <span class="iconify text-xl" data-icon="mdi-chevron-double-left"></span>
        </button>

        <!-- Bouton Page Précédente -->
        <button type="button"
            class="bg-c1 hover:bg-c3 h-12 hover:text-c1 text-white font-bold py-2 px-4 flex items-center justify-center transition 
            ${!donnees.prev_page_url ? 'cursor-not-allowed opacity-50' : ''}"
            onclick="${fonction}(${donnees.current_page - 1})" ${!donnees.prev_page_url ? 'disabled' : ''}>
            <span class="iconify text-xl" data-icon="mdi-chevron-left"></span>
        </button>

        <!-- Page Actuelle -->
        <span class="bg-c3 text-c1 h-12 text-xs lg:text-lg  font-bold py-2 px-4 rounded flex items-center justify-center">
             ${donnees.current_page}/${donnees.last_page}
        </span>

        <!-- Bouton Page Suivante -->
        <button type="button"
            class="bg-c1 hover:bg-c3 h-12 hover:text-c1  text-white font-bold py-2 px-4 flex items-center justify-center transition 
            ${!donnees.next_page_url ? 'cursor-not-allowed opacity-50' : ''}"
            onclick="${fonction}(${donnees.current_page + 1})" ${!donnees.next_page_url ? 'disabled' : ''}>
            <span class="iconify text-xl" data-icon="mdi-chevron-right"></span>
        </button>

        <!-- Bouton Dernière Page -->
        <button type="button"   
            class="bg-c1 hover:bg-c3 h-12 hover:text-c1 text-white font-bold py-2 px-4 rounded-r flex items-center justify-center transition 
            ${!donnees.next_page_url ? 'cursor-not-allowed opacity-50' : ''}"
            onclick="${fonction}(${donnees.last_page})" ${!donnees.next_page_url ? 'disabled' : ''}>
            <span class="iconify text-xl" data-icon="mdi-chevron-double-right"></span>
        </button>
    </div>`;
}

