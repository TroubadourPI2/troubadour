
function triNom(){
    if(document.getElementById('triNom').value == 'az'){
        console.log('tri az');
        var cards = Array.from(document.getElementsByClassName('carteLieu'));

        // Extract the names and sort the cards based on the names
        cards.sort(function(a, b) {
            var nomA = a.getElementsByClassName('carteTitre')[0].innerHTML.toLowerCase();
            var nomB = b.getElementsByClassName('carteTitre')[0].innerHTML.toLowerCase();
            if (nomA < nomB) return -1;
            if (nomA > nomB) return 1;
            return 0;
        });

        // Append the sorted cards back to the parent container
        var parent = cards[0].parentNode;
        parent.innerHTML = '';
        cards.forEach(function(card) {
            parent.appendChild(card);
        });
    }
}