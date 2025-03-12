var selectQuartierPC = document.getElementById('selectQuartier');

selectQuartierPC.addEventListener('change', function() {
    var quartier = selectQuartierPC.value;
    var url = "/recherche/" + quartier;
    window.location = url;
});