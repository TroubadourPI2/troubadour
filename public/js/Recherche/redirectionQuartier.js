var selectQuartierPC        = document.getElementById('selectQuartier');
var selectVillePC           = document.getElementById('selectVille');

var selectQuartierMobile    = document.getElementById('selectQuartierMobile');
var selectVilleMobile       = document.getElementById('selectVilleMobile');

selectQuartierPC.addEventListener('change', function() {
    var quartier = selectQuartierPC.value;
    var url = "/recherche/" + quartier;
    window.location = url;
});

selectQuartierMobile.addEventListener('change', function() {
    var quartier = selectQuartierMobile.value;
    var url = "/recherche/" + quartier;
    window.location = url;
});
