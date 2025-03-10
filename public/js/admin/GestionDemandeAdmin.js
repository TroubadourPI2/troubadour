document.addEventListener('DOMContentLoaded', function() {

    const rolesIcons = {
        1: { icon: "mdi-shield-account" },
        2: { icon: "mdi-account" },
        3: { icon: "mdi-account-tie" }
    };

    const statutsIcons = {
        1: { icon: "mdi-check-circle", color: "text-c1" },
        2: { icon: "mdi-close-circle", color: "text-red-500" },
        3: { icon: "mdi-timer-sand", color: "text-yellow-500" }
    };


    let rolesData = [];
    let statutsData = [];
    let usagersParPage = 10;
    let pageActuelle = 1;


    function TraduireRole(nom) {
        if(nom === 'Admin') {
            return Lang.get('strings.admin');
        } else if(nom === 'Utilisateur') {
            return Lang.get('strings.utilisateur');
        } else if(nom === 'Gestionnaire') {
            return Lang.get('strings.gestion');
        } else {
            return nom;
        }
    }


    function TraduireStatut(statut) {
        if(statut === 'Actif') {
            return Lang.get('strings.actif');
        } else if(statut === 'Inactif') {
            return Lang.get('strings.inactif');
        } else if(statut === 'En Attente') {
            return Lang.get('strings.enAttente');
        } else {
            return statut;
        }
    }

  
    function ChargerRolesEtStatuts() {
        return axios.get('/admin/obtenirRoleStatut')
            .then(response => response.data)
            .catch(error => {
                console.error("Erreur lors du chargement des rôles et statuts :", error);
                return { roles: [], statuts: [] };
            });
    }


    function RemplirSelect(idElement, donnees, texteDefaut, isRole) {
        const selectElement = document.getElementById(idElement);
        let html = `<option value="">${texteDefaut}</option>`;
        donnees.forEach(item => {
            const libelle = isRole ? TraduireRole(item.nom) : TraduireStatut(item.statut);
            html += `<option value="${item.id}">${libelle}</option>`;
        });
        selectElement.innerHTML = html;
    }

   
    function InitialiserInterface() {
        ChargerRolesEtStatuts().then(data => {
            rolesData = data.roles;
            statutsData = data.statuts;
            RemplirSelect('rechercheRole', rolesData, Lang.get('strings.tousLesRoles'), true);
            RemplirSelect('rechercheStatut', statutsData, Lang.get('strings.tousLesStatus'), false);
            RechercheUsagerAdmin(1);
        });
    }

  
    function RechercheUsagerAdmin(page = 1) {
        pageActuelle = page;
        const rechercheTexte = document.getElementById('rechercheTexte').value.trim();
        if (rechercheTexte !== "" && rechercheTexte.length < 3) {
            return;
        }
        const rechercheRole = document.getElementById('rechercheRole').value;
        const rechercheStatut = document.getElementById('rechercheStatut').value;

        axios.get('/admin/rechercheUsagers', {
            params: {
                recherche: rechercheTexte,
                rechercheRole: rechercheRole,
                rechercheStatut: rechercheStatut,
                page: page,
                per_page: usagersParPage
            }
        })
        .then(response => {
            const donneesUsagers = response.data;
            let contenuHtml = '';
            if (donneesUsagers.data.length === 0) {
                contenuHtml = `<div class="py-4 text-center font-bold">${Lang.get('strings.pasResultatFiltreUsagers')}</div>`;
            } else {
                donneesUsagers.data.forEach(usager => {
                    const roleDetail = rolesData.find(r => r.id == usager.role_id) || { nom: Lang.get('strings.inconnu') };
                    const roleIcon = rolesIcons[usager.role_id] ? rolesIcons[usager.role_id].icon : "mdi-help-circle";
                    const statutDetail = statutsData.find(s => s.id == usager.statut_id) || { statut: Lang.get('strings.inconnu') };
                    const statutIcon = statutsIcons[usager.statut_id] ? statutsIcons[usager.statut_id].icon : "mdi-help-circle";
                    const statutColor = statutsIcons[usager.statut_id] ? statutsIcons[usager.statut_id].color : "";
                    console.log(statutColor)
                    contenuHtml += `
                    <div class="bg-c3 border-2 shadow-md flex max-w-7xl w-full h-28 justify-center items-center p-2 lg:p-4">
                        <!-- Rôle -->
                        <div class="flex w-1/4 justify-start md:pl-8 lg:pl-16 font-bold text-base lg:text-xl uppercase items-center">
                            <span class="iconify size-10 lg:size-8 text-c1" data-icon="${roleIcon}"></span>
                            <span class="ml-2 hidden lg:block">${TraduireRole(roleDetail.nom)}</span>
                        </div>
                        <!-- Statut -->
                        <div class="flex w-1/4 justify-start font-bold text-base lg:text-xl uppercase items-center ">
                            <span class="iconify size-10 lg:size-8  ${statutColor}" data-icon="${statutIcon}"   ></span>
                            <span class="ml-2 hidden lg:block ${statutColor}">${TraduireStatut(statutDetail.statut)}</span>
                        </div>
                        <!-- Courriel -->
                        <div class="flex w-1/4 justify-center lg:pl-8 font-bold text-sm lg:text-xl uppercase items-center">
                            <span class="w-full text-left truncate">${usager.courriel}</span>
                        </div>
                        <!-- Actions -->
                        <div class="flex w-1/4 justify-center pl-4 lg:pl-16 font-bold text-lg gap-x-1 uppercase items-center flex-col md:flex-row">
                            <button class="modifier-btn items-center border-2 p-1 lg:p-2 rounded flex hover:text-c3 hover:bg-c1 transition text-c1"
                                data-id="${usager.id}"
                                data-role="${usager.role_id}"
                                data-statut="${usager.statut_id}"
                                data-email="${usager.courriel}">
                                <span class="hidden lg:block text-xl">${Lang.get('strings.modifier')}</span>
                                <span class="iconify size-6 " data-icon="mingcute-edit-line"></span>
                            </button>
                        </div>
                    </div>`;
                });
            }
            document.getElementById('usagersContainer').innerHTML = contenuHtml;
            document.getElementById('paginationUsagers').innerHTML = GenererPagination(donneesUsagers);
        })
        .catch(error => {
            console.error(error);
        });
    }


    function GenererPagination(donnees) {
        return `
        <div class="flex gap-2 mt-4">
            <button type="button"
                class="page-btn bg-c1 hover:bg-c3 h-12 hover:text-c1 text-white font-bold py-2 px-4 rounded-l flex items-center justify-center transition ${!donnees.prev_page_url ? 'cursor-not-allowed opacity-50' : ''}"
                ${donnees.prev_page_url ? `data-page="1"` : 'disabled'}>
                <span class="iconify text-xl" data-icon="mdi-chevron-double-left"></span>
            </button>
            <button type="button"
                class="page-btn bg-c1 hover:bg-c3 h-12 hover:text-c1 text-white font-bold py-2 px-4 flex items-center justify-center transition ${!donnees.prev_page_url ? 'cursor-not-allowed opacity-50' : ''}"
                ${donnees.prev_page_url ? `data-page="${donnees.current_page - 1}"` : 'disabled'}>
                <span class="iconify text-xl" data-icon="mdi-chevron-left"></span>
            </button>
            <span class="bg-c3 text-c1 h-12 text-xs lg:text-lg font-bold py-2 px-4 rounded flex items-center justify-center">
                ${donnees.current_page}/${donnees.last_page}
            </span>
            <button type="button"
                class="page-btn bg-c1 hover:bg-c3 h-12 hover:text-c1 text-white font-bold py-2 px-4 flex items-center justify-center transition ${!donnees.next_page_url ? 'cursor-not-allowed opacity-50' : ''}"
                ${donnees.next_page_url ? `data-page="${donnees.current_page + 1}"` : 'disabled'}>
                <span class="iconify text-xl" data-icon="mdi-chevron-right"></span>
            </button>
            <button type="button"
                class="page-btn bg-c1 hover:bg-c3 h-12 hover:text-c1 text-white font-bold py-2 px-4 rounded-r flex items-center justify-center transition ${!donnees.next_page_url ? 'cursor-not-allowed opacity-50' : ''}"
                ${donnees.next_page_url ? `data-page="${donnees.last_page}"` : 'disabled'}>
                <span class="iconify text-xl" data-icon="mdi-chevron-double-right"></span>
            </button>
        </div>`;
    }


    document.getElementById('paginationUsagers').addEventListener('click', function(e) {
        const pageBtn = e.target.closest('.page-btn');
        if (pageBtn && pageBtn.hasAttribute('data-page')) {
            const page = parseInt(pageBtn.getAttribute('data-page'));
            RechercheUsagerAdmin(page);
        }
    });

  
    document.getElementById('usagersContainer').addEventListener('click', function(e) {
        const btn = e.target.closest('.modifier-btn');
        if (btn) {
            const id = btn.getAttribute('data-id');
            const roleActuel = btn.getAttribute('data-role');
            const statutActuel = btn.getAttribute('data-statut');
            const email = btn.getAttribute('data-email');
            ModifierUtilisateur(id, roleActuel, statutActuel, email);
        }
    });

  
    function ModifierUtilisateur(id, roleActuel, statutActuel, email) {
        const optionsRoles = rolesData.map(role => {
            return `<option value="${role.id}" ${roleActuel == role.id ? 'selected' : ''}>${TraduireRole(role.nom)}</option>`;
        }).join('');
        const optionsStatuts = statutsData.map(statut => {
            return `<option value="${statut.id}" ${statutActuel == statut.id ? 'selected' : ''}>${TraduireStatut(statut.statut)}</option>`;
        }).join('');

        const toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });

        Swal.fire({
            title: Lang.get('strings.modifier'),
            html: `<div class="flex flex-col w-full gap-y-4">
                        <strong class="uppercase">${email}</strong>
                        <div class="flex gap-x-2 items-center justify-center px-2">
                            <label class="block text-left font-bold text-c1 mb-1 w-1/4">${Lang.get('strings.role')}</label>
                            <select id="role_id" class="rounded-full border-2 justify-center w-1/2 border-c1 p-2">
                                ${optionsRoles}
                            </select>
                        </div>
                        <div class="flex gap-x-2 items-center justify-center px-2">
                            <label class="block text-left font-bold text-c1 mb-1 w-1/4 mt-3">${Lang.get('strings.statut')}</label>
                            <select id="statut_id" class="rounded-full border-2 w-1/2 border-c1 p-2">
                                ${optionsStatuts}
                            </select>
                        </div>
                    </div>`,
            showCancelButton: true,
            confirmButtonText: Lang.get('strings.modifier'),
            cancelButtonText: Lang.get('strings.annuler'),
            reverseButtons: true,
            customClass: {
                popup: 'font-barlow text-xl text-c1 bg-c2',
                title: 'text-3xl uppercase underline',
                confirmButton: 'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
                cancelButton: 'text-c1 uppercase bg-c2 font-semibold rounded-full px-4 py-2 hover:bg-white transition'
            },
            focusConfirm: false,
            preConfirm: () => {
                return {
                    role_id: document.getElementById("role_id").value,
                    statut_id: document.getElementById("statut_id").value
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post(`/admin/usagers/modifier/${id}`, result.value)
                    .then(response => {
                        toast.fire({
                            icon: "success",
                            title: Lang.get('strings.succesModifier')
                        });
                        RechercheUsagerAdmin(pageActuelle);
                    })
                    .catch(error => {
                        console.error("Erreur Axios :", error);

                        
                        let message = Lang.get('strings.erreurGenerale'); 


                         if (error.response && error.response.data && error.response.data.message) {
                             message = error.response.data.message;
                            }
                        Swal.fire({
                            icon: "error",
                            title: Lang.get('strings.erreur'),
                            text: message,
                        });
                    });
            }
        });
    }

    document.getElementById('usagersParPage').addEventListener('change', function() {
        usagersParPage = parseInt(this.value);
        RechercheUsagerAdmin(1);
    });


    document.getElementById('rechercheTexte').addEventListener('input', () => RechercheUsagerAdmin());
    document.getElementById('rechercheRole').addEventListener('change', () => RechercheUsagerAdmin());
    document.getElementById('rechercheStatut').addEventListener('change', () => RechercheUsagerAdmin());


    InitialiserInterface();
});