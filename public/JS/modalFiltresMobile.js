var mbBtnFiltres = document.getElementById("mbBtnFiltres")
var mbBtnVilles = document.getElementById("mbBtnVilles")

mbBtnFiltres.addEventListener('click', function(){
    Swal.fire({
        // title: "<strong>Sélection des filtres</strong>",
        icon: "none",
        html: `
        <div class="w-full h-2/3">
            <form action="" class="flex w-full flex-col overflow-auto">
                <h3 class="w-full px-2 text-c1 font-barlow uppercase font-bold">Sélection des filtres</h3>
                <div class="w-full flex justify-center items-center h-8">
                    <hr class="w-full bg-c1 h-px">
                </div>
                <div class="w-full px-2 flex justify-between">
                    <h6 class="w-full text-left px-2 text-c1 uppercase font-bold font-barlow">Prix</h6>
                    <span
                        class="iconify size-6 text-red-500"
                        data-icon="lucide:filter-x" data-inline="false"></span>
                </div>
                <div class="flex flex-col w-full">
                    <div class="flex flex-row w-full gap-x-2 mb-2">
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full flex items-center justify-center">
                            <span class="iconify" data-icon="bx:dollar" data-inline="false"></span>
                        </span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full flex items-center justify-center flex-row">
                            <span class="iconify" data-icon="bx:dollar" data-inline="false"></span>
                            <span class="iconify" data-icon="bx:dollar" data-inline="false"></span>
                        </span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full flex items-center justify-center flex-row">
                            <span class="iconify" data-icon="bx:dollar" data-inline="false"></span>
                            <span class="iconify" data-icon="bx:dollar" data-inline="false"></span>
                            <span class="iconify" data-icon="bx:dollar" data-inline="false"></span>
                        </span>
                    </div>
                </div>
                <div class="w-full flex justify-center items-center h-8">
                    <hr class="w-full bg-c1 h-px">
                </div>
                <div class="w-full px-2 flex justify-between">
                    <h6 class="w-full text-left px-2 text-c1 uppercase font-bold font-barlow">Avis</h6>
                    <span
                        class="iconify size-6 text-red-500"
                        data-icon="lucide:filter-x" data-inline="false"></span>
                </div>
                <div class="flex flex-col w-full">
                    <div class="flex flex-row w-full gap-x-2 mb-2">
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full flex flex-row justify-center items-center">
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                        </span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full flex flex-row justify-center items-center">
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                        </span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full flex flex-row justify-center items-center">
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                        </span>
                    </div>
                    <div class="flex flex-row w-full gap-x-2">
                        <span class="w-1/2 border border-c1 text-c1 font-barlow rounded-full flex flex-row justify-center items-center">
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                        </span>
                        <span class="w-1/2 border border-c1 text-c1 font-barlow rounded-full flex flex-row justify-center items-center">
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                            <span class="iconify" data-icon="bi:star" data-inline="false"></span>
                        </span>
                    </div>
                    <div class="flex flex-row w-full gap-x-2">
                    </div>
                </div>
                <div class="w-full flex justify-center items-center h-8">
                    <hr class="w-full bg-c1 h-px">
                </div>
                <div class="w-full px-2 flex justify-between">
                    <h6 class="w-full text-left px-2 text-c1 uppercase font-bold font-barlow">Type</h6>
                    <span
                    class="iconify size-6 text-red-500"
                    data-icon="lucide:filter-x" data-inline="false"></span>
                </div>
                <div class="flex flex-col w-full">
                    <div class="flex flex-row w-full gap-x-2 mb-2">
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">Musées</span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">Art visuels</span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">Spectacles</span>
                    </div>
                    <div class="flex flex-row w-full gap-x-2">
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">Restaurants</span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">Bars</span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">Églises</span>
                    </div>
                </div>
                <div class="w-full flex justify-center items-center h-8">
                    <hr class="w-full bg-c1 h-px">
                </div>
                <div class="w-full px-2 flex justify-between">
                    <h6 class="w-full text-left px-2 text-c1 uppercase font-bold font-barlow">Distance</h6>
                    <span
                    class="iconify size-6 text-red-500"
                    data-icon="lucide:filter-x" data-inline="false"></span>
                </div>
                <div class="flex flex-col w-full">
                    <div class="flex flex-row w-full gap-x-2 mb-2">
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">± 5 km</span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">± 15 km</span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">± 30 km</span>
                    </div>
                </div>
                <div class="w-full flex justify-center items-center h-8">
                    <hr class="w-full bg-c1 h-px">
                </div>
                <div class="w-full px-2 flex justify-between">
                    <h6 class="w-full text-left px-2 text-c1 uppercase font-bold font-barlow">Organisme</h6>
                    <span
                    class="iconify size-6 text-red-500"
                    data-icon="lucide:filter-x" data-inline="false"></span>
                </div>
                <div class="flex flex-col w-full">
                    <div class="flex flex-row w-full gap-x-2 mb-2">
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">Culture3R</span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">CE3R</span>
                        <span class="w-full border border-c1 text-c1 font-barlow rounded-full">V3R</span>
                    </div>
                </div>
                <button type="submit" class="bg-c1 text-c3 p-2 font-barlow rounded-full w-full mt-2">
                    Appliquer les filtres
                </button>
            </form>
        </div>
            
        `,
        showCloseButton: true,
        showCancelButton: false,
        showConfirmButton: false,
        focusConfirm: false,
        confirmButtonText: `
          <i class="fa fa-thumbs-up"></i> Great!
        `,
        confirmButtonAriaLabel: "Thumbs up, great!",
        cancelButtonText: `
          <i class="fa fa-thumbs-down"></i>
        `,
        cancelButtonAriaLabel: "Thumbs down",
        background: "#fbfbfb",
      });
});