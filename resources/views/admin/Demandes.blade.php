<p>Usagers</p>
<input type="text" id="rechercheTexte" placeholder="Rechercher par nom, prénom ou courriel">
<select id="rechercheRole">
    <option value="">Tous les rôles</option>
    <option value="3">Gestionnaire</option>

</select>
<select id="rechercheStatut">
    <option value="">Tous les statuts</option>
    <option value="3">En attente</option>

</select>


<div id="usagersContainer"></div>


<div id="pagination" class="mt-4 flex justify-center items-center gap-x-2"></div>
<script>
let usagersParPages = 10;
let pageActuelle = 1;

function Recherche(page = 1) {
    pageActuelle = page;
    const rechercheTexte  = document.getElementById('rechercheTexte').value.trim();
    const rechercheRole   = document.getElementById('rechercheRole').value;
    const rechercheStatut = document.getElementById('rechercheStatut').value;
    

    const hasFilter = rechercheTexte || rechercheRole || rechercheStatut;

    axios.get('/admin/rechercheUsagers', {
        params: hasFilter ? { 
            recherche: rechercheTexte,
            rechercheRole: rechercheRole,
            rechercheStatut: rechercheStatut,
            page: page
        } : { page: page } 
    })
    .then(response => {
        const usagersData = response.data;
        
        let html = '';
        usagersData.data.forEach(function(usager) {
            html += `<div>
                        <strong>${usager.nom} ${usager.prenom}</strong> - ${usager.courriel}
                        (Role: ${usager.role_id}, Statut: ${usager.statut_id})
                     </div>`;
        });
        document.getElementById('usagersContainer').innerHTML = html;
        
        let paginationHtml = '';
        for (let i = 1; i <= usagersData.last_page; i++) {
            paginationHtml += `<button onclick="Recherche(${i})" ${i === usagersData.current_page ? 'style="font-weight:bold;"' : ''}>${i}</button>`;
        }
        document.getElementById('pagination').innerHTML = paginationHtml;
    })
    .catch(error => {
        console.error(error);
    });
}



setTimeout(() => Recherche(), 100); 

document.getElementById('rechercheTexte').addEventListener('input', () => Recherche());
document.getElementById('rechercheRole').addEventListener('change', () => Recherche());
document.getElementById('rechercheStatut').addEventListener('change', () => Recherche());
</script>
