<div class="flex w-full h-full flex-col mb-4 font-barlow">
    <div class="flex gap-x-2 w-full flex-col md:flex-row gap-y-2 md:gap-y-0">

        <select id="rechercheRole" class="rounded-full border-2 w-full lg:w-1/2 border-c1 p-2">
            <option value="">Tous les rôles</option>
            <option value="3">Gestionnaire</option>

        </select>
        <select id="rechercheStatut" class="rounded-full border-2 w-full lg:w-1/2 border-c1 p-2">
            <option value="">Tous les statuts</option>
            <option value="3">En attente</option>

        </select>
        <input type="text" id="rechercheTexte" class="rounded-full border-2 w-full lg:w-1/2 border-c1 p-2"
            placeholder="Rechercher par nom, prénom ou courriel">

    </div>

    <div class="flex w-full flex-col justify-center items-center">
        <div id="pagination" class="mt-4  max-w-7xl w-full  flex justify-center items-center gap-x-2  "> </div>
        <div class="flex justify-end w-full max-w-7xl mb-4">
            <label for="usagersParPage" class="mr-2 font-bold text-lg">Afficher</label>
            <select id="usagersParPage" class="rounded border-2 p-1">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
     
        </div>
        <div class=" border-2 bg-c3 border-c1 flex max-w-7xl w-full  h-14  justify-center items-center z-10 sticky  text-c1  top-0"
            id="labelTableau">
            <div class="flex w-1/4 pl-12 justify-center font-bold text-xl uppercase items-center"></span>Rôle </div>
            <div class="flex w-1/6 justify-center font-bold text-xl uppercase  items-center"></span>Statut </div>
            <div class="flex w-2/4 justify-center font-bold text-xl uppercase items-center"></span>Courriel</div>
            <div class="flex w-1/4 justify-center font-bold text-xl uppercase  items-center"></span>Actions</div>
        </div>
        
        <div id="usagersContainer" class="flex justify-center flex-col w-full items-center gap-y-4 "></div>


    </div>
</div>
<script>
     const roles = {
                    1: {
                        name: "Admin",
                        icon: "mdi-shield-account"
                    },
                    2: {
                        name: "Utilisateur",
                        icon: "mdi-account"
                    },
                    3: {
                        name: "Gestionnaire",
                        icon: "mdi-account-tie"
                    }
                };

                const statuts = {
                    1: {
                        name: "Actif",
                        icon: "mdi-check-circle",
                        color: "text-green-500"
                    },
                    2: {
                        name: "Inactif",
                        icon: "mdi-close-circle",
                        color: "text-red-500"
                    },
                    3: {
                        name: "En Attente",
                        icon: "mdi-timer-sand",
                        color: "text-yellow-500"
                    }
                };
                let usagersParPages = 10;
let pageActuelle = 1;

document.getElementById('usagersParPage').addEventListener('change', function() {
    usagersParPages = parseInt(this.value);
    Recherche(1); 
});

function Recherche(page = 1) {
    pageActuelle = page;
    const rechercheTexte = document.getElementById('rechercheTexte').value.trim();
    const rechercheRole = document.getElementById('rechercheRole').value;
    const rechercheStatut = document.getElementById('rechercheStatut').value;

    const hasFilter = rechercheTexte || rechercheRole || rechercheStatut;

    axios.get('/admin/rechercheUsagers', {
            params: {
                recherche: rechercheTexte,
                rechercheRole: rechercheRole,
                rechercheStatut: rechercheStatut,
                page: page,
                per_page: usagersParPages 
            }
        })
        .then(response => {
            const usagersData = response.data;
            let html = '';

            usagersData.data.forEach(function(usager) {
                const roleData = roles[usager.role_id] || { name: "Inconnu", icon: "mdi-help-circle" };
                const statutData = statuts[usager.statut_id] || { name: "Inconnu", icon: "mdi-help-circle", color: "text-gray-500" };

                html += `
                <div class="bg-c3 border-2 shadow-md flex max-w-7xl w-full h-24 justify-center items-center p-4">
                    <!-- Rôle -->
                    <div class="flex w-1/4 justify-start pl-16 font-bold text-xl uppercase items-center">
                        <span class="iconify text-2xl text-c1" data-icon="${roleData.icon}"></span>
                        <span class="ml-2">${roleData.name}</span>
                    </div>
                    
                    <!-- Statut -->
                    <div class="flex w-1/4 justify-start font-bold text-xl uppercase items-center ${statutData.color}">
                        <span class="iconify text-2xl" data-icon="${statutData.icon}"></span>
                        <span class="ml-2">${statutData.name}</span>
                    </div>
                    
                    <!-- Courriel -->
                    <div class="flex w-1/4 justify-center pl-8 font-bold text-xl uppercase items-center">
                        <span class="w-full text-left">${usager.courriel}</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex w-1/4 justify-center pl-16 font-bold text-xl uppercase items-center">
                        <button class="border-2 p-1 rounded"> <span>Modifier Rôle</span> </button>
                        <button class="border-2 p-1 rounded"> <span>Désactiver</span> </button>
                    </div>
                </div>`;
            });

            document.getElementById('usagersContainer').innerHTML = html;
            document.getElementById('pagination').innerHTML = paginationButtons(usagersData, "Recherche");
        })
        .catch(error => {
            console.error(error);
        });
}



    setTimeout(() => Recherche(), 100);

    document.getElementById('rechercheTexte').addEventListener('input', () => Recherche());
    document.getElementById('rechercheRole').addEventListener('change', () => Recherche());
    document.getElementById('rechercheStatut').addEventListener('change', () => Recherche());


    function paginationButtons(data, functionName) {
    return `
    <div class="flex gap-2 mt-4">
        <!-- Bouton Première Page -->
        <button type="button"
            class="bg-c1 hover:bg-c3 hover:text-c1 text-white font-bold py-2 px-4 rounded-l flex items-center justify-center 
            ${!data.prev_page_url ? 'cursor-not-allowed opacity-50' : ''}"
            onclick="${functionName}(1)" ${!data.prev_page_url ? 'disabled' : ''}>
            <span class="iconify text-xl" data-icon="mdi-chevron-double-left"></span>
        </button>

        <!-- Bouton Page Précédente -->
        <button type="button"
            class="bg-c1 hover:bg-c3 hover:text-c1 text-white font-bold py-2 px-4 flex items-center justify-center
            ${!data.prev_page_url ? 'cursor-not-allowed opacity-50' : ''}"
            onclick="${functionName}(${data.current_page - 1})" ${!data.prev_page_url ? 'disabled' : ''}>
            <span class="iconify text-xl" data-icon="mdi-chevron-left"></span>
        </button>

        <!-- Page Actuelle -->
        <span class="bg-c3 text-c1  font-bold py-2 px-4 rounded flex items-center justify-center">
            Page ${data.current_page} sur ${data.last_page}
        </span>

        <!-- Bouton Page Suivante -->
        <button type="button"
            class="bg-c1 hover:bg-c3 hover:text-c1  text-white font-bold py-2 px-4 flex items-center justify-center
            ${!data.next_page_url ? 'cursor-not-allowed opacity-50' : ''}"
            onclick="${functionName}(${data.current_page + 1})" ${!data.next_page_url ? 'disabled' : ''}>
            <span class="iconify text-xl" data-icon="mdi-chevron-right"></span>
        </button>

        <!-- Bouton Dernière Page -->
        <button type="button"
            class="bg-c1 hover:bg-c3 hover:text-c1 text-white font-bold py-2 px-4 rounded-r flex items-center justify-center
            ${!data.next_page_url ? 'cursor-not-allowed opacity-50' : ''}"
            onclick="${functionName}(${data.last_page})" ${!data.next_page_url ? 'disabled' : ''}>
            <span class="iconify text-xl" data-icon="mdi-chevron-double-right"></span>
        </button>
    </div>`;
}

</script>
