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
        label.innerText = 'Position pour "' + fichier.name + '"';

        const input = document.createElement('input');
        input.type = 'number';
        input.id = 'photos_' + i;
        input.name = 'photos[' + i + '][position]';
        input.min = 1;
        input.max = fichiers.length;
        input.placeholder = 'Position';
        // Ajout d'une classe pour la validation
        input.classList.add('position-input');

        div.appendChild(label);
        div.appendChild(input);
        conteneurPositions.appendChild(div);
    }
});

document.getElementById('activiteForm').addEventListener('submit', function(e) {
    console.log('Validation des positions exécutée');

    const positionInputs = document.querySelectorAll('.position-input');
    let tousRemplis = true;
    const positions = [];

    positionInputs.forEach(function(input) {
        const value = input.value.trim();
        if (value === '') {
            tousRemplis = false;
            input.classList.add('border-c5');
        } else {
            input.classList.remove('border-c5');
            positions.push(value);
        }
    });

    // Vérifier l'unicité des positions
    const uniquePositions = new Set(positions);
    const positionsDupliquees = (uniquePositions.size !== positions.length);

    if (!tousRemplis || positionsDupliquees) {
        e.preventDefault();
        let message = 'Veuillez renseigner la position pour chaque image.';
        if (positionsDupliquees) {
            message = 'Les positions des images doivent être uniques.';
        }
        Swal.fire({
            icon: 'error',
            title: 'Attention',
            text: message
        });
    }
});