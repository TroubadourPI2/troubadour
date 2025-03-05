
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

        <div class="flex w-full h-3/4 overflow-y-auto flex-col space-y-10 overflow-x-hidden m-3 snap-y">
            @if (isset($lieux))
                @if (count($lieux))
                    <div
                        class="2xl:grid-cols-5 xl:grid-cols-4  lg:grid-cols-4  md:grid-cols-2 grid-cols-1 grid gap-y-5 place-items-center snap-center">
                        @foreach ($lieux as $lieu)
                            <a href="/lieu/zoom/{{ $lieu->id }}"
                                class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu ">
                                <img src="{{ asset($lieu->photoLieu) }}" alt="{!! __('Image de l\'établissement') !!}"
                                    class="rounded-md h-52">
                                <h3 class="text-c1 font-barlow text-md my-2 carteTitre">{{ $lieu->nomEtablissement }}</h3>
                                <span class="text-blackfont-barlow text-sm text-center">{{ $lieu->description }}</span>
                            </a>
                        @endforeach
                    </div>
                    <div class="w-full flex-justify-center items-center">
                        {{ $lieux->links() }}
                    </div>
                @else
                    <div class="w-full h-full place-content-center">
                        <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>
                    </div>
                @endif
            @else
                <div class="w-full h-full place-content-center">
                    <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>
                </div>
            @endif
        </div>
    </div>