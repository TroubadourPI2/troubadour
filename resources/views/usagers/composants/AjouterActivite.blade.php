<div>
    <button id="boutonRetourAfficherActivite"
        class="flex items-center text-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-32 w-[80px] text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-5 size-4 sm:mr-2 sm:ml-2 mr-1" data-icon="ion:arrow-back-outline"
            data-inline="false"></span>
        Retour
    </button>


    <form class="mt-2 text-c1" action="{{ route('usagerLieux.ajouterLieu') }}" method="POST" enctype="multipart/form-data">
        @csrf
      
    </form>
</div>




@if (session('erreurAjouterActivite'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("compte").classList.add("hidden");
            const boutonCompte = document.getElementById("boutonCompte");
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonActivites = document.getElementById("boutonActivites");
            boutonActivites.classList.add("bg-c1", "text-c3");
            boutonActivites.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            document.getElementById("ajouterActivite").classList.remove("hidden");
            const activites = document.getElementById("activites");
            activites.classList.remove("hidden");

            document.getElementById("afficherActivites").classList.add("hidden");
        });
    </script>
    @php
        session()->forget('erreurAjouterActivite');
    @endphp
@endif
