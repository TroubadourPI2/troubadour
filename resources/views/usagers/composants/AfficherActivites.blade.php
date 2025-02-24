<div class="flex w-full h-full flex-col hidden" id="afficherActivites">

    <div class="flex flex-col sm:flex-row w-full gap-4 items-center mb-4">
        <div class="flex w-full lg:flex-row flex-col gap-x-4 gap-y-4 lg:gap-y-0 items-center">
            <button
                class="flex items-center text-sm sm:text-xl border-c1 border-2 rounded-full w-fit max-w-64 text-c1 font-semibold my-3 px-4">
                <span class="iconify text-c1 sm:size-8 size-4 sm:mr-2 font-semibold" data-icon="ion:add"
                    data-inline="false"></span>
                AJOUTER
            </button>
            <select id="filtreLieu" class="rounded-full border-2 w-full lg:w-1/2 border-c1 p-2">
                <option value="">Tous les lieux</option>
                @foreach ($lieuxUsager as $lieu)
                    <option value="{{ $lieu->id }}">{{ $lieu->nomEtablissement }}</option>
                @endforeach
            </select>
            <select id="filtreType" class="rounded-full border-2  w-full lg:w-1/2 border-c1 p-2">
                <option value="">Tous les types d'activités</option>
                @foreach ($typesActivite as $type)
                    <option value="{{ $type->id }}">{{ $type->nom }}</option>
                @endforeach
            </select>
            <input type="text" id="recherche" placeholder="Rechercher par nom"
                class="w-full rounded-full border-2 justify-end border-c1 p-2" />
        </div>

    </div>

    <div id="activitesGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 w-full mt-2 mb-2">
        @foreach ($activites as $activite)
            <div class="activite-carte w-full h-96 flex bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden scale-90 ease-in-out duration-300 border hover:border-2 hover:scale-100 hover:border-c1"
                data-nom="{{ strtolower($activite->nom) }}" data-lieu-ids="{{ $activite->lieu_ids }}"
                data-type="{{ $activite->typeActivite->id }}"
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
                <div class="w-full flex justify-center items-end">
                    <span
                        class="bg-c1 opacity-90 flex h-16 text-2xl font-bold text-c3 font-barlow w-full justify-center items-center">
                        {{ $activite->nom }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
    <div id="pasResultat" class="hidden text-center text-lg text-c1 mt-4">
        Aucune activité n'a été trouvée pour ce lieu.
    </div>
</div>


<div id="ajouterActivite" class="">@include('usagers.composants.AjouterActivite')</div>
<script src="//unpkg.com/alpinejs" defer></script>
<script src="{{ asset('js/usagers/Activites/Recherche.js') }}" defer></script>
