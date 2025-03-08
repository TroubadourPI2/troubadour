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
    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline my-5">{!! __('LieuxFavoris') !!}</h1>

    <div dir="ltr">

        <div class="grid grid-flow-col overflow-x-auto  snap-x space-x-4">
            @if (isset($usager) && $usager->lieuFavoris->isNotEmpty())
                @foreach ($usager->lieuFavoris as $favoriL)
                    <a href="/lieu/zoom/{{ $favoriL->lieu->id }}"
                        class="w-[300px] h-96 bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden border border-transparent hover:border-c1 my-2 flex flex-col justify-end" >

                        <!-- Display the first image -->
                        <img src="{{ asset($favoriL->lieu->photoLieu) }}" alt="Photo de l'activité"
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
            @else
                <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>
            @endif
        </div>
    </div>

    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline my-5">{!! __('ActivitesFavorites') !!}</h1>
    <div dir="ltr">
        <!-- Make the container scrollable horizontally and hide overflow vertically -->
   
            <!-- Use flex to align items horizontally and prevent wrapping -->
            <div class="grid grid-flow-col overflow-x-auto snap-x space-x-4">
                @if (isset($usager) && $usager->activiteFavoris->isNotEmpty())
                    @foreach ($usager->activiteFavoris as $favoriA)
                        <a href="/activite/zoom/{{ $favoriA->activite->id }}/{{ $favoriL->lieu->id }}"
                            class="activite-carte w-[300px]  h-96 bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden border border-transparent hover:border-c1 my-2 flex flex-col justify-end">

                            <img src="{{ asset('images/activites/1.jpg') }}" alt="Photo de l'activité"
                                class="w-full h-96 object-cover absolute inset-0 transition duration-300 ease-in-out">

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
                @else
                    <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>
                @endif
            </div>
        
    </div>

</div>
