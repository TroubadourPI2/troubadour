document.getElementById('recherche').addEventListener('keyup', function() {
    let query = this.value.toLowerCase();
    let cards = document.querySelectorAll('.activite-carte');
    cards.forEach(function(card) {
        let nom = card.getAttribute('data-nom');
        card.style.display = (nom.indexOf(query) !== -1) ? '' : 'none';
    });
});