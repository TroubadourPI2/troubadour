let selectVille;

document.addEventListener('DOMContentLoaded', function () {
    Lang.setLocale(document.body.getAttribute('data-locale'));
    ObtenirElementsAjouterQuartiers();
    ObtenirVille();
});

function ObtenirElementsAjouterQuartiers() {
    selectVille = document.getElementById('selectVille');
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
        if (selectVille) MettreAJourSelectQuartier(villes);

        console.log(villes);

    } catch (error) {
        console.error(error);
    }
}
