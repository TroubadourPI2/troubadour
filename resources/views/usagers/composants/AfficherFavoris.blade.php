<!-- Boutons de filtres -->
<div class="w-full h-12 justify-center items-center space-x-5 my-4 flex-row hidden lg:flex">
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Prix') !!}</h3>
    </div>
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Type') !!}</h3>
    </div>
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Distance') !!}</h3>
    </div>
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Organisme') !!}</h3>
    </div>
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Avis') !!}</h3>
    </div>
</div>

<div class="w-full mb-5">
    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Lieux Favoris</h1>

    <div dir="ltr">
        <!-- Make the container scrollable horizontally and hide overflow vertically -->
        <div class="overflow-x-auto snap-x">
            <!-- Use flex to align items horizontally and prevent wrapping -->
            <div class="flex flex-nowrap space-x-4">
                @if (isset($usager) && $usager->lieuFavoris->isNotEmpty())
                    @foreach ($usager->lieuFavoris as $favoriL)
                        <a href="/lieu/zoom/{{ $favoriL->lieu->id }}"
                            class="activite-carte w-full h-96 flex bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden scale-90 ease-in-out duration-300 border hover:border-2 hover:scale-100 hover:border-c1"
                            data-nom="{{ strtolower($favoriL->lieu->nomEtablissement) }}"
                            data-lieu-ids="{{ $favoriL->lieu->lieu_ids }}" data-type="{{ $favoriL->lieu->id }}"
                            data-actif="{{ $favoriL->lieu->actif }}">

                            <!-- Display the first image, in case there is only one -->
                            <img src="{{ asset($favoriL->lieu->photoLieu) }}" alt="Photo de l'activité"
                                class="w-full h-96 object-cover absolute inset-0 transition duration-300 ease-in-out">

                            <div class="w-full flex justify-center items-end">
                                <div class="opacity-90 bg-c1 flex w-full h-16 items-center">
                                    <span
                                        class="text-2xl font-bold text-c3 font-barlow w-full truncate justify-start px-4 items-center">
                                        {{ $favoriL->lieu->nomEtablissement }}
                                    </span>
                                    <div class="flex gap-x-2 px-4">
                                        <button
                                            class="boutonSupprimerActivite text-red-500 transform transition duration-300 hover:scale-110"
                                            data-activite-id="{{ $favoriL->lieu->id }}"
                                            data-nomActivite="{{ $favoriL->lieu->nomEtablissement }}">
                                            <span class="iconify size-6" data-icon="ion:trash-outline"
                                                data-inline="false"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>
                @endif

            </div>
        </div>
    </div>

    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Activités Favorites</h1>
    <div
        class="2xl:grid-cols-5 xl:grid-cols-4  lg:grid-cols-4  md:grid-cols-2 grid-cols-1 grid gap-y-5 place-items-center snap-center">
        @if (isset($usager) && $usager->activiteFavoris->isNotEmpty())
            @foreach ($usager->activiteFavoris as $favoriA)
                <a href="/activite/zoom/{{ $favoriA->activite->id }}"
                    class="activite-carte w-full h-96 flex bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden scale-90 ease-in-out duration-300 border hover:border-2 hover:scale-100 hover:border-c1"
                    data-nom="{{ strtolower($favoriA->activite->nomEtablissement) }}"
                    data-lieu-ids="{{ $favoriA->activite->lieu_ids }}" data-type="{{ $favoriA->activite->id }}"
                    data-actif="{{ $favoriA->activite->actif }}">

                    <img src="{{ asset('images/activites/1.jpg') }}" alt="Photo de l'activité"
                        class="w-full h-96 object-cover absolute inset-0 transition duration-300 ease-in-out">

                    <div class="w-full flex justify-center items-end">
                        <div class="opacity-90 bg-c1 flex w-full h-16 items-center">
                            <span
                                class="text-2xl font-bold text-c3 font-barlow w-full truncate justify-start px-4 items-center">
                                {{ $favoriA->activite->nom }}
                            </span>
                            <div class="flex gap-x-2 px-4">
                                <button
                                    class="boutonSupprimerActivite text-red-500 transform transition duration-300 hover:scale-110"
                                    data-activite-id="{{ $favoriA->activite->id }}"
                                    data-nomActivite="{{ $favoriA->activite->nom }}">
                                    <span class="iconify size-6" data-icon="ion:trash-outline"
                                        data-inline="false"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>
        @endif
    </div>

</div>
