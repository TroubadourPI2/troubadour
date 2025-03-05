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
        <div id="pagination" class="mt-4 flex justify-center items-center gap-x-2  py-2"> </div>
        <div class=" border-2 bg-c3 border-c1 flex max-w-7xl w-full  h-14  justify-center items-center z-10 sticky  text-c1  top-0"
            id="labelTableau">
            <div class="flex w-1/4 justify-center font-bold text-xl uppercase items-center"><span
                    class="iconify size-8" data-icon="mdi-people-outline"></span>Rôle </div>
            <div class="flex w-1/6 justify-center font-bold text-xl uppercase  items-center"><span
                    class="iconify size-8" data-icon="mdi-list-status"></span>Statut </div>
            <div class="flex w-2/4 justify-center font-bold text-xl uppercase items-center"><span
                    class="iconify size-8" data-icon="mdi-email"></span>Courriel</div>
            <div class="flex w-1/4 justify-center font-bold text-xl uppercase  items-center"><span
                    class="iconify size-8" data-icon="mdi-pen"></span>Actions</div>
        </div>
        <div id="usagersContainer" class="flex justify-center flex-col w-full items-center gap-y-4 "></div>


    </div>
</div>
<script>
    let usagersParPages = 10;
    let pageActuelle = 1;

    function Recherche(page = 1) {
        pageActuelle = page;
        const rechercheTexte = document.getElementById('rechercheTexte').value.trim();
        const rechercheRole = document.getElementById('rechercheRole').value;
        const rechercheStatut = document.getElementById('rechercheStatut').value;

        const hasFilter = rechercheTexte || rechercheRole || rechercheStatut;

        axios.get('/admin/rechercheUsagers', {
                params: hasFilter ? {
                    recherche: rechercheTexte,
                    rechercheRole: rechercheRole,
                    rechercheStatut: rechercheStatut,
                    page: page
                } : {
                    page: page
                }
            })
            .then(response => {
                const usagersData = response.data;
                let html = '';
                usagersData.data.forEach(function(usager) {
                    html += `<div class=" bg-c3 border-2 shadow-md flex max-w-7xl w-full h-24  justify-center items-center">  (Role: ${usager.role_id}, Statut: ${usager.statut_id})
                        - ${usager.courriel}
                     <button class=" border-2"> <span> Modifier Role</span> </button>
                          <button class="border-2 "> <span> Desactiver </span> </button>
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
        <button type="button"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 md:px-4 rounded-l
            ${!data.prev_page_url ? 'cursor-not-allowed' : ''}"
            onclick="${functionName}(1)" ${!data.prev_page_url ? 'disabled' : ''}>
            &lt;&lt;
        </button>
        <button type="button"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 md:px-4 
            ${!data.prev_page_url ? 'cursor-not-allowed' : ''}"
            onclick="${functionName}(${data.current_page - 1})" ${!data.prev_page_url ? 'disabled' : ''}>
            <span class="md:hidden">&lt;</span>
            <span class="hidden md:inline">Précédente</span>
        </button>
        <span class="text-xs font-bold mx-2">Page ${data.current_page} sur ${data.last_page}</span>
        <button type="button"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 md:px-4
            ${!data.next_page_url ? 'cursor-not-allowed' : ''}"
            onclick="${functionName}(${data.current_page + 1})" ${!data.next_page_url ? 'disabled' : ''}>
            <span class="md:hidden">&gt;</span>
            <span class="hidden md:inline">Suivante</span>
        </button>
        <button type="button"
            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 md:px-4 rounded-r
            ${!data.next_page_url ? 'cursor-not-allowed' : ''}"
            onclick="${functionName}(${data.last_page})" ${!data.next_page_url ? 'disabled' : ''}>
            &gt;&gt;
        </button>
    `;
    }
</script>
