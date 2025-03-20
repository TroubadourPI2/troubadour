let selectVille;
let selectVilleModifier;
let affichageQuartiers;


document.addEventListener('DOMContentLoaded', function () {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsAjouterQuartiers();
    ObtenirElementsAfficherQuartiers();
    ObtenirVille();
    ObtenirQuartier();

    document.querySelector("#formulaireQuartierAjout").addEventListener("submit", function (e) {
        e.preventDefault();
    
        Swal.fire({
            text:`${Lang.get('strings.confirmationAjoutQuartier')}`, // a changer pour l'ajout sur prod
            title: Lang.get('strings.attention'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: Lang.get('strings.confirmer'),
            cancelButtonText: Lang.get('strings.annuler'),
            reverseButtons: true,
            customClass: {
                popup: 'font-barlow text-xl text-c1 bg-c2',
                title: 'text-3xl uppercase underline',
                confirmButton: 'bg-c1 text-white font-semibold px-4 py-2 uppercase rounded-full transition',
                cancelButton: 'text-c1 uppercase bg-c2 font-semibold rounded-full px-4 py-2 hover:bg-white transition',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                if(document.getElementById('nomQuartierAjout').value == '' || document.getElementById('nomQuartierAjout').value.length < 3)
                    {
                        Swal.fire({
                            icon: 'error',
                            title: Lang.get('strings.attention'),
                            text: Lang.get('strings.nomInvalide')// a changer pour l'ajout sur prod
                        })
                    }
                else if (document.getElementById('selectVilleAjoutQuartier').selectedIndex == 0)
                    {
                    Swal.fire({
                        icon: 'error',
                        title: Lang.get('strings.attention'),
                        text: Lang.get('strings.villeInvalide')// a changer pour l'ajout sur prod
                    })
                    }
                else {
                    document.querySelector("#formulaireQuartierAjout").submit();
                }
            }
        })
    });


});

function ObtenirElementsAjouterQuartiers() {
    selectVille = document.getElementById('selectVilleAjoutQuartier');
    selectVilleModifier = document.getElementById('selectVilleModifierQuartier');
}

function ObtenirElementsAfficherQuartiers() {
    affichageQuartiers = document.getElementById('affichageQuartiers');
}

async function ObtenirVille() {
    try {
        const response = await fetch(
            `/admin/villes`,
            {
                method: 'GET',
                headers: {
                    Accept: 'application/json'
                }
            }
        );

        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }

        const villes = await response.json();

        if (selectVille) MettreAJourSelectVilles(villes);

        if (selectVilleModifier) MettreAJourSelectVillesModifier(villes)

        

    } catch (error) {
        console.error(error);
    }
}



function MettreAJourSelectVilles(villes) {
    selectVille.innerHTML = '';

    const optionDefaut = document.createElement('option');
    optionDefaut.value = '';
    optionDefaut.textContent = Lang.get('strings.choisirVille');
    optionDefaut.disabled = true;
    optionDefaut.selected = true;
    selectVille.appendChild(optionDefaut);

    villes.forEach((ville) => {
        const option = document.createElement('option');
        option.value = ville.id;
        option.textContent = ville.nom;
        selectVille.appendChild(option);

    });

    selectVille.removeAttribute('disabled');
}

function MettreAJourSelectVillesModifier(villes) {
    selectVilleModifier.innerHTML = '';

    villes.forEach((ville) => {
        const option = document.createElement('option');
        option.value = ville.id;
        option.textContent = ville.nom;

        selectVilleModifier.appendChild(option);
    });

    selectVilleModifier.removeAttribute('disabled');
}

async function ObtenirQuartier() {
    try {
        const response = await fetch(
            `/admin/quartiers`,
            {
                method: 'GET',
                headers: {
                    Accept: 'application/json'
                }
            }
        );

        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }

        const quartiers = await response.json();

        if (affichageQuartiers) CartesQuartier(quartiers);


    } catch (error) {
        console.error(error);
    }
}

function CartesQuartier(quartiers) {

    quartiers.forEach((quartier) => {
       
        const card = document.createElement('div');
        card.classList.add('quartier-carte', 'bg-white', 'shadow-md', 'rounded-lg', 'p-4', 'w-60', 'flex', 'items-center', 'my-2', 'justify-center', 'md:w-fit', 'sm:w-full',);

        const pill = document.createElement('span');
        pill.classList.add('bg-blue-500', 'text-c1', 'text-sm', 'truncate', 'font-semibold', 'px-3', 'py-1', 'rounded-full');

        pill.textContent = quartier.nom;

        card.appendChild(pill);

        const boutonSupprimer = document.createElement('button');
        boutonSupprimer.type = 'button';
        boutonSupprimer.id = quartier.id;
        boutonSupprimer.nom = quartier.nom;
        boutonSupprimer.className =
            'boutonSupprimerQuartier bg-red-500 p-1 rounded';
            boutonSupprimer.innerHTML = `
            <span class=" iconify text-c5 size-6" data-icon="ion:trash-outline" data-inline="true"></span>
        `;
        card.appendChild(boutonSupprimer);

        const boutonModifier = document.createElement('button');
        boutonModifier.type = 'button';
        boutonModifier.setAttribute('data-id', quartier.id);
        boutonModifier.id = "boutonModifierQuartier";
        boutonModifier.nom = quartier.nom;
        boutonModifier.className =
            'boutonModifierQuartier bg-red-500 p-1 rounded';
            boutonModifier.innerHTML = `
            <span class=" iconify text-c1 size-6" data-icon="ep:edit" data-inline="true"></span>
        `;
        card.appendChild(boutonModifier);

        affichageQuartiers.appendChild(card);

    });
}



