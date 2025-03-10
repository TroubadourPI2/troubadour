let selectVille;
let affichageQuartiers;

document.addEventListener('DOMContentLoaded', function () {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsAjouterQuartiers();
    ObtenirElementsAfficherQuartiers();
    ObtenirVille();
    ObtenirQuartier();
});

function ObtenirElementsAjouterQuartiers() {
    selectVille = document.getElementById('selectVilleAjoutQuartier');
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

        console.log(villes);

    } catch (error) {
        console.error(error);
    }
}

function MettreAJourSelectVilles(villes) {
    selectVille.innerHTML = '';

    const optionDefaut = document.createElement('option');
    optionDefaut.value = '';
    optionDefaut.textContent = Lang.get('strings.choisirVille');
    selectVille.appendChild(optionDefaut);

    villes.forEach((ville) => {
        const option = document.createElement('option');
        option.value = ville.id;
        option.textContent = ville.nom;
        selectVille.appendChild(option);
        console.log(ville.id);

    });

    selectVille.removeAttribute('disabled');
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

        console.log(quartiers);

    } catch (error) {
        console.error(error);
    }
}

function CartesQuartier(quartiers) {

    quartiers.forEach((quartier) => {
       
        const card = document.createElement('div');
        card.classList.add('quartier-carte');
        card.classList.add('bg-white');
        card.classList.add('shadow-md');
        card.classList.add('rounded-lg');
        card.classList.add('p-4');
        card.classList.add('w-40');
        card.classList.add('flex');
        card.classList.add('items-center');
        card.classList.add('my-2');
        card.classList.add('justify-center');


        const pill = document.createElement('span');
        pill.classList.add('bg-blue-500');
        pill.classList.add('text-c1');
        pill.classList.add('text-sm');
        pill.classList.add('truncate');
        pill.classList.add('font-semibold');
        pill.classList.add('px-3');
        pill.classList.add('py-1');
        pill.classList.add('rounded-full');

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

        affichageQuartiers.appendChild(card);

    });


}