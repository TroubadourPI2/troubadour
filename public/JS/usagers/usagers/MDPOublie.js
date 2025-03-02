async function showMDPOublie() {
    const MDPO = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    MDPO.fire({
        icon: "info",
        title: "Vérifiez vos courriels!",
        customClass: {
            title: "text-c1 font-bold",
        }

    });
}