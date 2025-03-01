document.addEventListener("DOMContentLoaded", function() {
    Lang.setLocale(document.body.getAttribute('data-locale'));
});

const champPhotos = document.getElementById('photos');
const conteneurPositions = document.getElementById('positionInputs');

champPhotos.addEventListener('change', function() {
    conteneurPositions.innerHTML = '';
    const fichiers = champPhotos.files;

    for (let i = 0; i < fichiers.length; i++) {
        const fichier = fichiers[i];
        const div = document.createElement('div');
        div.className = 'mb-2';

        const label = document.createElement('label');
        label.setAttribute('for', 'photos_' + i);
        label.className = 'block text-sm';
        label.innerText = Lang.get('strings.positionPour') + " " + fichier.name;

        const input = document.createElement('input');
        input.type = 'number';
        input.id = 'photos_' + i;
        input.name = 'photos[' + i + '][position]';
        input.min = 1;
        input.max = fichiers.length;

        // Ajout d'une classe pour la validation
        input.classList.add('position-input', 'p-2', 'font-medium', 'rounded-lg', 'bg-c3');

        div.appendChild(label);
        div.appendChild(input);
        conteneurPositions.appendChild(div);
    }
});

document.getElementById('activiteForm').addEventListener('submit', function(e) {
    const positionInputs = document.querySelectorAll('.position-input');
    let tousRemplis = true;
    let positions = [];

    positionInputs.forEach(function(input) {
        const value = input.value.trim();
        if (value === '') {
            tousRemplis = false;
            input.classList.add('border-c5');
        } else {
            input.classList.remove('border-c5');
            positions.push(parseInt(value, 10));
        }
    });

    const uniquePositions = new Set(positions);
    const positionsDupliquees = (uniquePositions.size !== positions.length);

    // Vérification de l'ordre séquentiel (1,2,3,... sans trou)
    positions.sort((a, b) => a - b);
    let estSequentiel = true;
    for (let i = 0; i < positions.length; i++) {
        if (positions[i] !== i + 1) {
            estSequentiel = false;
            break;
        }
    }

    if (!tousRemplis || positionsDupliquees || !estSequentiel) {
        e.preventDefault();
        let message = Lang.get('validations.photoPositionRequise');

        if (positionsDupliquees) {
            message = Lang.get('validations.photoPositionDistinct');
        } else if (!estSequentiel) {
            message = Lang.get('validations.positionsSequentielle');
        }

        Swal.fire({
            icon: 'error',
            title: Lang.get('strings.attention'),
            text: message
        });
    }
});
