<div class="flex w-full h-full flex-col gap-y-2 ">
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
    <div id="pagination" class="mt-4 flex justify-center items-center gap-x-2 pb-2"></div>
    <div id="usagersContainer" class="flex justify-center flex-col w-full items-center gap-y-2"></div>



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
                    html += `<div class=" flex w-full h-24 border-2 justify-center items-center">  (Role: ${usager.role_id}, Statut: ${usager.statut_id})
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
