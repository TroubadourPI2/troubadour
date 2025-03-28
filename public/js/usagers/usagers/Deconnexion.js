
function ChargerCSSPersonnalise() {
    let link = document.createElement("link");
    link.rel = "stylesheet";
    link.href = "/connexion.css"; 
    link.type = "text/css";
    document.head.appendChild(link);
}


ChargerCSSPersonnalise();
Lang.setLocale(document.body.getAttribute('data-locale'));

function AfficherModalDeconnexion() {

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
       
    });

    Toast.fire({
        icon: "success",
        title: Lang.get('strings.deconnexionMessage'),
        customClass: {
            title: "text-c1 font-bold",
            timerProgressBar: "color-c5",
        }
    }).then(() => {
        if (window.location.pathname.startsWith('/compte')) {
            window.location.href = '/';
        } else {
            window.location.reload(); 
        }
    });

}
AfficherModalDeconnexion()