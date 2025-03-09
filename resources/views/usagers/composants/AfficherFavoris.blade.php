<div class="w-full mb-5">
    @php
        $aLieuxFavoris = isset($usager) && $usager->lieuFavoris->isNotEmpty();
        $aActivitesFavoris = isset($usager) && $usager->activiteFavoris->isNotEmpty();
    @endphp
    @if (!$aLieuxFavoris && !$aActivitesFavoris)
        <h3 class="text-center text-c1 font-bold font-barlow text-xl">{!! __('aucunFavori') !!}</h3>
    @else
        @if ($aLieuxFavoris)
            <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline my-5">{!! __('lieuxFavoris') !!}</h1>

            <div dir="ltr">
                <div class="grid grid-flow-col overflow-x-auto  snap-x space-x-4">
                    @foreach ($usager->lieuFavoris as $favoriL)
                        <a href="/lieu/zoom/{{ $favoriL->lieu->id }}"
                            class="w-[300px] h-96 bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden border border-transparent hover:border-c1 my-2 flex flex-col justify-end">

                            <!-- Display the first image -->
                            <img src="{{ asset($favoriL->lieu->photo_lieu_url) }}"
                                alt="{{ $favoriL->lieu->nomEtablissement }}"
                                class="w-full h-96 object-cover absolute inset-0 transition duration-300 ease-in-out">

                            <div class="w-full flex justify-center items-end">
                                <div class="opacity-90 bg-c1 flex w-full h-16 items-center">
                                    <span class="text-2xl font-bold text-c3 font-barlow w-full truncate px-4">
                                        {{ $favoriL->lieu->nomEtablissement }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        @endif
        @if ($aActivitesFavoris)
            <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline my-5">{!! __('activitesFavorites') !!}</h1>
            <div dir="ltr">
                <!-- Make the container scrollable horizontally and hide overflow vertically -->

                <!-- Use flex to align items horizontally and prevent wrapping -->
                <div class="grid grid-flow-col overflow-x-auto snap-x space-x-4">

                    @foreach ($usager->activiteFavoris as $favoriA)
                        <a href="/activite/zoom/{{ $favoriA->activite->id }}/{{ $favoriL->lieu->id }}"
                            class="activite-carte w-[300px]  h-96 bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden border border-transparent hover:border-c1 my-2 flex flex-col justify-end"
                            data-nom="{{ strtolower($favoriA->activite->nom) }}" data-lieu-ids="{{ $favoriA->activite->lieu_ids }}"
                            data-type="{{ $favoriA->activite->typeActivite->id }}" data-actif="{{ $favoriA->activite->actif }}"
                            x-data='{
                                        current: 0,
                                        images: {!! $favoriA->activite->photos_json !!},
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
                                    x-init="startCarousel()" @mouseenter="stopCarousel()" @mouseleave="startCarousel()">
                                    <template x-for="(img, index) in images" :key="index">
                                        <img x-show="current === index" :src="img" alt="Photo de l'activité"
                                            class="w-full h-96 object-cover absolute inset-0 transition duration-300 ease-in-out"
                                            x-transition:enter="transition transform duration-300"
                                            x-transition:enter-start="opacity-0 scale-90"
                                            x-transition:enter-end="opacity-100 scale-100" />
                                    </template>

                            <div class="w-full flex justify-center items-end">
                                <div class="opacity-90 bg-c1 flex w-full h-16 items-center">
                                    <span
                                        class="text-2xl font-bold text-c3 font-barlow w-full truncate justify-start px-4 items-center">
                                        {{ $favoriA->activite->nom }}
                                    </span>

                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>

