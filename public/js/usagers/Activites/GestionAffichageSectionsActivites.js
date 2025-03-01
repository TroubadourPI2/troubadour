document.addEventListener('DOMContentLoaded', function () {
    const btnAjouter = document.getElementById('boutonAjouterActivite');
    btnAjouter.addEventListener('click', function () {
        document.getElementById('afficherActivites').classList.add('hidden');

        document.getElementById('ajouterActivite').classList.remove('hidden');
    });

    const btnRetourAjout = document.querySelectorAll( '.boutonRetourAfficherActivite');
    btnRetourAjout.forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('ajouterActivite').classList.add('hidden');

            document
                .getElementById('afficherActivites')
                .classList.remove('hidden');
            document
                .querySelectorAll('.erreurAjouterActiviteMessages')
                .forEach(function (container) {
                    container.remove();
                });
        });
    });
});
