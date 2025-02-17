var mbBtnFiltres = document.getElementById("mbBtnFiltres")
var mbBtnVilles = document.getElementById("mbBtnVilles")

mbBtnFiltres.addEventListener('click', function(){
    Swal.fire({
        // title: "<strong>Sélection des filtres</strong>",
        icon: "none",
        html: `
        <div class="w-full h-full flex">
            <form action="" class="flex w-full flex-col overflow-x-auto">
                <h3 class="w-full px-2 text-c1 font-barlow uppercase font-bold">sélection des filtres</h3>
                <div class="w-full flex justify-center items-center h-8">
                    <hr class="w-full bg-c1 h-px">
                </div>
                <div class="w-full px-2 flex justify-between">
                    <h6 class="w-full text-left px-2 text-c1 uppercase font-bold font-barlow">Prix</h6>
                    <span
                        class="iconify size-6 text-red-500"
                        data-icon="lucide:filter-x" data-inline="false"></span>
                </div>
                <div class="w-full flex justify-left gap-x-4 overflow-x-auto">
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full">$</button>
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full">$$</button>
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full">$$$</button>
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full">$$$$</button>
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
                <div class="w-full flex justify-left gap-x-4 overflow-x-auto">
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full flex flex-row justify-center items-center gap-x-2">
                        1
                        <span
                        class="iconify size-5 text-c1"
                        data-icon="mdi:star" data-inline="false"></span>
                    </button>
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full flex flex-row justify-center items-center gap-x-2">
                        2
                        <span
                        class="iconify size-5 text-c1"
                        data-icon="mdi:star" data-inline="false"></span>
                    </button>
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full flex flex-row justify-center items-center gap-x-2">
                        3
                        <span
                        class="iconify size-5 text-c1"
                        data-icon="mdi:star" data-inline="false"></span>
                    </button>
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full flex flex-row justify-center items-center gap-x-2">
                        4
                        <span
                        class="iconify size-5 text-c1"
                        data-icon="mdi:star" data-inline="false"></span>
                    </button>
                    <button class="w-1/4 bg-c3 text-c1 border border-c1 font-barlow rounded-full flex flex-row justify-center items-center gap-x-2">
                        5
                        <span
                        class="iconify size-5 text-c1"
                        data-icon="mdi:star" data-inline="false"></span>
                    </button>
                </div>
                <div class="w-full flex justify-center items-center h-8">
                    <hr class="w-full bg-c1 h-px">
                </div>
                <div class="w-full px-2 flex justify-between">
                    <h6 class="w-full text-left px-2 text-c1 uppercase font-bold font-barlow">Clientèle cible</h6>
                    <span
                        class="iconify size-6 text-red-500"
                        data-icon="lucide:filter-x" data-inline="false"></span>
                </div>
                <div class="flex flex-nowrap gap-x-3">
                    <button class="w-3/4 px-2 bg-c3 text-c1 border border-c1 font-barlow rounded-full text-md">
                        Familles
                    </button>
                    <button class="w-3/4 px-2 bg-c3 text-c1 border border-c1 font-barlow rounded-full text-md">
                        Jeunes
                    </button>
                    <button class="w-3/4 px-2 bg-c3 text-c1 border border-c1 font-barlow rounded-full text-md">
                        Adultes
                    </button>
                </div>
                <div class="w-full flex justify-center items-center h-8">
                    <hr class="w-full bg-c1 h-px">
                </div>
                <button type="submit" class="bg-c1 text-c3 p-2 font-barlow rounded-full w-full">
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