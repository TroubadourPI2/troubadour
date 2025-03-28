<div class="flex w-full h-full flex-col  " id="afficherActivites">

    <div class="flex flex-col sm:flex-row w-full gap-4 items-center mb-4">
        <div class="flex w-full lg:flex-row flex-col gap-x-4 gap-y-4 lg:gap-y-0 items-center">
            <button id="boutonAjouterActivite"
                class="flex items-center text-c1 font-barlow text-sm sm:text-xl border-c1 border-2 rounded-full w-fit max-w-64 text-c1my-3 px-4 uppercase  sm:hover:bg-c3 sm:hover:border-c3 transition">
                <span class="iconify text-c1 sm:size-8 size-4 sm:mr-2 font-semibold" data-icon="ion:add"
                    data-inline="false"></span>
                {{ __('ajouter') }}
            </button>
            <select id="filtreLieu" class="rounded-full border-2 w-full lg:w-1/2 border-c1 p-2">
                <option value=""> {{ __('tousLesLieux') }}</option>
                @foreach ($lieuxUsager as $lieu)
                    <option value="{{ $lieu->id }}">{{ $lieu->nomEtablissement }}</option>
                @endforeach
            </select>
            <select id="filtreType" class="rounded-full border-2  w-full lg:w-1/2 border-c1 p-2">
                <option value="">{{ __('tousLesTypesActivites') }}</option>
                @foreach ($typesActivite as $type)
                    <option value="{{ $type->id }}">{{ $type->nom }}</option>
                @endforeach
            </select>
            <input type="text" id="recherche" placeholder= "{{ __('rechercherNom') }}"
                class="w-full rounded-full border-2 justify-end border-c1 p-2" />
            <div class="flex items-center gap-x-1.5">
                <label for="actif" id="labelActif" class="cursor-pointer">ACTIF</label>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="actifFiltre" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-c3 rounded-full peer peer-checked:after:translate-x-5 peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-c1 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-c1 peer-checked:after:bg-white">
                    </div>
                </label>
            </div>
        </div>
    </div>

    <div id="activitesGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 w-full mt-2 mb-2">
        @foreach ($activites as $activite)
            <div class="activite-carte w-full h-96 flex bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden scale-90 ease-in-out duration-300 border hover:border-2 hover:scale-100 hover:border-c1"
                data-nom="{{ strtolower($activite->nom) }}" data-lieu-ids="{{ $activite->lieu_ids }}"
                data-type="{{ $activite->typeActivite->id }}" data-actif="{{ $activite->actif }}"
                x-data='{
                     current: 0,
                     images: {!! $activite->photos_json !!},
                     interval: null,
                     next() {
                         this.current = (this.current < this.images.length - 1) ? this.current + 1 : 0;
                     },
                     startCarousel() {
                         if (this.images.length > 1) {
                             this.interval = setInterval(() => { this.next(); }, 3000);
                         }
                     },
                     stopCarousel() {
                         clearInterval(this.interval);
                     }
                 }'
                x-on:mouseenter="startCarousel()" x-on:mouseleave="stopCarousel()">
                <template x-for="(img, index) in images" :key="index">
                    <img x-show="current === index" :src="img" alt="Photo de l'activité"
                        class="w-full h-96 object-cover absolute inset-0 transition duration-300 ease-in-out"
                        x-transition:enter="transition transform duration-300"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" />
                </template>
                <div class="w-full flex  justify-center items-end">
                    <div class="opacity-90 bg-c1 flex  w-full h-16 items-center">
                        <span
                            class="  text-2xl font-bold text-c3 font-barlow w-full truncate justify-start px-4 items-center">
                            {{ $activite->nom }}
                        </span>
                        <div class="flex gap-x-2 px-4  ">
                            <label for="actifCheck-{{ $activite->id }}" id="labelActifModif-{{ $activite->id }}"
                                class="cursor-pointer text-c3">
                                {{ $activite->actif == 1 ? __('actif') : __('inactif') }}</label>
                            <label class="relative inline-flex items-center cursor-pointer">

                                <input type="hidden" id="actifHidden-{{ $activite->id }}"
                                    name="activites[{{ $activite->id }}][actif]" value="{{ $activite->actif }}">

                                <input type="checkbox" id="actifCheck-{{ $activite->id }}" class="sr-only peer"
                                    {{ $activite->actif == 1 ? 'checked' : '' }}
                                    data-nom="{{ strtolower($activite->nom) }}">
                                <div
                                    class="w-11 h-6 bg-c3 rounded-full peer 
                                            peer-checked:after:translate-x-5 peer-checked:after:border-white 
                                            after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                            after:bg-c1 after:border-gray-300 after:border after:rounded-full 
                                            after:h-5 after:w-5 after:transition-all 
                                            peer-checked:bg-c2 peer-checked:after:bg-white">
                                </div>
                            </label>
                            <button
                                class="boutonSupprimerActivite text-red-500 transform transition duration-300 hover:scale-110"
                                data-activite-id="{{ $activite->id }}" data-nomActivite="{{ $activite->nom }}"><span
                                    class="iconify size-6" data-icon="ion:trash-outline"
                                    data-inline="false"></span></button>
                            <button
                                class="boutonModifierActivite text-c3  transform transition duration-300 hover:scale-110"
                                data-activite-id="{{ $activite->id }}"><span class="iconify size-6 "
                                    data-icon="ep:edit" data-inline="false"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="pasResultat" class="hidden text-center text-lg text-c1 mt-4">
        {{ __('pasResultatFiltreActivites') }}
    </div>
</div>

<div id="ajouterActivite" class="hidden">@include('usagers.composants.AjouterActivite')</div>
<div id="modifierActivite" class="hidden">@include('usagers.composants.ModifierActivite')</div>

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
@if (session('erreurModifierActivite'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("compte").classList.add("hidden");
            const boutonCompte = document.getElementById("boutonCompte");
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonActivites = document.getElementById("boutonActivites");
            boutonActivites.classList.add("bg-c1", "text-c3");
            boutonActivites.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            document.getElementById("modifierActivite").classList.remove("hidden");
            const activites = document.getElementById("activites");
            activites.classList.remove("hidden");

            document.getElementById("afficherActivites").classList.add("hidden");
            const idActiviteErreur = "{{ session('idActiviteErreur') }}";


            if (idActiviteErreur) {
                axios.get(`/compte/obtenirActivite/${idActiviteErreur}`)
                    .then(reponse => {
                        const activite = reponse.data.data;
                        MettreAJourSectionPhotos(activite);
                        document.getElementById('formulaireActiviteModif').setAttribute('action',
                            `/compte/modifierActivites/${idActiviteErreur}`);


                    })
                    .catch(erreur => {
                        console.error("Erreur lors du rafraîchissement des photos actuelles :", erreur);
                    });
            }
        });
    </script>
    @php
        session()->forget('erreurModifierActivite');
    @endphp
@endif

<script src="{{ asset('js/usagers/Activites/SupprimerActivite.js') }}"></script>
<script src="{{ asset('js/usagers/Activites/recherche.js') }}" defer></script>
<script src="{{ asset('js/usagers/Activites/GestionAffichageSectionsActivites.js') }}" defer></script>
<script src="{{ asset('js/usagers/Activites/AjouterActivite.js') }}" defer></script>
<script src="{{ asset('js/usagers/Activites/ModifierActivite.js') }}" defer></script>
<script src="{{ asset('js/usagers/Activites/statutActivite.js') }}" defer></script>
