<button
    class="flex items-center text-sm sm:text-xl border-c1 border-2 rounded-full sm:w-36 w-[80px] text-c1 font-semibold my-3">
    <span class="iconify text-c1 sm:size-8 size-4 sm:mr-2 font-semibold" data-icon="ion:add" data-inline="false"></span>
    AJOUTER
</button>
@if ($lieuxUsager->isEmpty())
    <div class="text-c1 text-2xl">Aucun lieu d'enregistré.</div>
@else
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
        @foreach ($lieuxUsager as $lieu)
            <!-- Carte lieu pour mobile -->
            <div class="sm:hidden flex flex-row flex-wrap gap-4 items-center text-c1 rounded-lg">
                <div id="carteLieuxMobile"
                    class="carteLieuxMobile relative w-full min-h-[44vh] mb-4 rounded-lg shadow-lg transition-transform duration-500 [transform-style:preserve-3d]">
                    <div id="carteLieuxMobileDevant"
                        class="absolute bg-c3 inset-0 rounded-lg shadow-lg  [backface-visibility:hidden]">
                        <img class="object-cover w-full h-72 md:h-auto md:w-48 rounded-t-lg"
                            src="{{ asset($lieu->photoLieu) }}" alt="{{ $lieu->nomEtablissement }}">
                        <h5 class="mb-2 text-xl font-semibold uppercase p-2 text-center">{{ $lieu->nomEtablissement }}
                        </h5>
                    </div>
                    <div id="carteLieuxMobileDerriere"
                        class="carteLieuxMobileDerriere absolute inset-0 bg-c3 rounded-lg shadow-lg [transform:rotateY(180deg)] [backface-visibility:hidden]">
                        <div class="p-4 flex flex-col justify-between h-full">
                            <div class="mb-2">
                                <div class="uppercase underline text-lg font-semibold">Description</div>
                                <div>{{ $lieu->description }}.</div>
                            </div>
                            <div>
                                <div class="uppercase underline text-lg font-semibold">Coordonnées</div>
                                <div class="flex flex-col">
                                    <span>{{ $lieu->noCivic }}, {{ $lieu->rue }}</span>
                                    <span>{{ $lieu->ville()?->nom }}, {{ $lieu->codePostal }}
                                        @if ($lieu->province())
                                            , {{ $lieu->province()->nom }}
                                        @endif
                                    </span>
                                    <span>{{ $lieu->pays()?->nom }}</span>
                                    <span>{{ $lieu->quartier->nom ?? 'Quartier inconnu' }}</span>
                                    <span>{{ $lieu->typeLieu->nom }}</span>
                                    @if ($lieu->region())
                                        <span>{{ $lieu->region()->nom }}</span>
                                    @endif
                                    <span>{{ $lieu->siteWeb }}</span>
                                    <span>{{ $lieu->numeroTelephone }} À formater?</span>
                                </div>
                            </div>
                            <div class="flex justify-end space-x-3 mt-3">
                                <button><span class="iconify text-ci size-6" data-icon="ion:trash-outline"
                                        data-inline="false"></span></button>
                                <button><span class="iconify text-ci size-6 modifier" data-icon="ep:edit"
                                        data-inline="false"></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carte lieu pour web/tablette -->
            <div
                class="flex flex-col sm:flex-row text-c1 rounded-lg shadow-sm bg-white w-full max-w-4xl mx-auto my-4 hidden sm:flex h-[575px]">
                <div class="w-full sm:w-1/2 rounded-l-lg h-full">
                    <img class="object-cover w-full h-full rounded-l-lg" src="{{ asset($lieu->photoLieu) }}"
                        alt="{{ $lieu->nomEtablissement }}">
                </div>
                <div class="w-full sm:w-1/2 p-4 flex flex-col h-full gap-y-[30px]">
                    <h5 class="text-xl sm:text-3xl font-semibold uppercase mb-2">{{ $lieu->nomEtablissement }}</h5>
                    <div>
                        <div class="uppercase underline text-2xl font-semibold">Description</div>
                        <div class="text-xl">{{ $lieu->description }}</div>
                    </div>
                    <div>
                        <div class="uppercase underline font-semibold text-2xl">Coordonnées & Informations</div>
                        <div class="flex flex-col text-xl">
                            <span>{{ $lieu->noCivic }}, {{ $lieu->rue }}</span>
                            <span>{{ $lieu->ville()?->nom }}, {{ $lieu->codePostal }}
                                @if ($lieu->province())
                                    , {{ $lieu->province()->nom }}
                                @endif
                            </span>
                            <span>{{ $lieu->pays()?->nom }}</span>
                            <span>{{ $lieu->quartier->nom ?? 'Quartier inconnu' }}</span>
                            <span>{{ $lieu->typeLieu->nom }}</span>
                            @if ($lieu->region())
                                <span>{{ $lieu->region()->nom }}</span>
                            @endif
                            <span>{{ $lieu->siteWeb }}</span>
                            <span>{{ $lieu->numeroTelephone }} À formater?</span>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-auto">
                        <button><span class="iconify text-ci size-8" data-icon="ion:trash-outline"
                                data-inline="false"></span></button>
                        <button><span class="iconify text-ci size-8 modifier" data-icon="ep:edit"
                                data-inline="false"></span></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<script>
   const boutonModifier = document.querySelectorAll(".edit");

</script>
