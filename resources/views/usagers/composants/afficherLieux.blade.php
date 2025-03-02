<div id="afficherLieux">
    <button id="boutonAjouterLieu"
        class="flex items-center text-sm sm:text-xl border-c1 border-2 rounded-full  {{ App::getLocale() == 'en' ? 'sm:w-24 w-14' : 'sm:w-36 w-24' }}  text-c1 my-3 uppercase sm:hover:bg-c3 sm:hover:border-c3 transition">
        <span class="iconify text-c1 sm:size-6 size-4 sm:mr-2 sm:ml-2 mr-2" data-icon="ion:add-outline"
            data-inline="false"></span>
        {{ __('ajouter') }}
    </button>
    @if ($lieuxUsager->isEmpty())
        <div class="text-c1 text-2xl">{{ __('aucunLieu') }}.</div>
    @else
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            @foreach ($lieuxUsager as $lieu)
                <!-- Carte lieu pour mobile -->
                <div class="sm:hidden flex flex-row flex-wrap gap-4 items-center text-c1 rounded-lg ">
                    <div
                        class="carteLieuxMobile relative w-full min-h-[50vh] mb-4 rounded-lg shadow-xl transition-transform duration-500 [transform-style:preserve-3d] hover:shadow-2xl ">
                        <div
                            class="absolute bg-c3 inset-0 rounded-lg shadow-lg flex flex-col items-center p-4 [backface-visibility:hidden] {{ !$lieu->actif ? 'bg-[#B0B7B7]' : '' }}">
                            <img class="object-cover w-full h-72 rounded-t-lg" src="{{ $lieu->photo_lieu_url }}"
                                alt="{{ $lieu->nomEtablissement }}">
                            <h5 class="text-xl font-bold uppercase p-2 text-center h-full flex items-center">
                                {{ $lieu->nomEtablissement }}
                            </h5>
                        </div>
                        <div
                            class="carteLieuxMobileDerriere absolute inset-0 bg-c3 rounded-lg shadow-lg p-4 [transform:rotateY(180deg)] [backface-visibility:hidden] ">
                            <div class="flex flex-col justify-between h-full">
                                <div class="mb-2">
                                    <div class="uppercase underline text-base font-semibold">{{ __('description') }}
                                    </div>
                                    <div class="truncate">{{ $lieu->description ?? __('aucuneDescription') }}.</div>
                                </div>
                                <div class="mb-4">
                                    <div class="uppercase underline text-lg font-semibold">{{ __('coordonneesEtInfo') }}
                                    </div>
                                    <div class="text-sm">
                                        <p><strong>{{ __('adresse') }} :</strong> {{ $lieu->noCivic }},
                                            {{ $lieu->rue }}</p>
                                        <p><strong>{{ trans_choice('ville', 1) }} :</strong>
                                            {{ $lieu->ville()?->nom }}{{ $lieu->codePostal ? ', ' . $lieu->codePostal : '' }}
                                        </p>
                                        <p><strong>{{ __('pays') }} :</strong> {{ $lieu->pays()?->nom }}</p>
                                        <p><strong>{{ __('quartier') }} :</strong> {{ $lieu->quartier->nom }}</p>
                                        @if ($lieu->province())
                                            <p><strong>{{ __('province') }} :</strong> {{ $lieu->province()->nom }}
                                            </p>
                                        @endif
                                        @if ($lieu->region())
                                            <p><strong>{{ __('region') }} :</strong> {{ $lieu->region()->nom }}</p>
                                        @endif
                                        @if ($lieu->siteWeb)
                                            <p><strong>{{ __('siteWeb') }} :</strong> <a href="{{ $lieu->siteWeb }}"
                                                    class="text-blue-500 underline">{{ $lieu->siteWeb }}</a></p>
                                        @endif
                                        <p><strong>{{ __('telephone') }} :</strong> {{ $lieu->numeroTelephone }}</p>
                                        <p><strong>{{ __('typeLieu') }} :</strong> {{ $lieu->typeLieu->nom }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-3 mt-3">
                                    <button class="boutonSupprimer text-[#B20101]" data-lieuId="{{ $lieu->id }}"
                                        data-nomLieu="{{ $lieu->nomEtablissement }}"><span class="iconify size-6"
                                            data-icon="ion:trash-outline" data-inline="false"></span></button>
                                    <button class="boutonModifier" data-lieuId="{{ $lieu->id }}"
                                        data-villeId="{{ $lieu->ville()?->id }}"
                                        data-typeLieuId="{{ $lieu->typeLieu->id }}"><span class="iconify size-6"
                                            data-icon="ep:edit" data-inline="false"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carte lieu pour web/tablette -->
                <div
                    class="carteWeb flex flex-col sm:flex-row text-c1 rounded-lg shadow-md bg-white w-full max-w-4xl mx-auto my-4 hidden sm:flex h-[65vh] hover:shadow-2xl transition  {{ !$lieu->actif ? 'bg-[#B0B7B7]' : '' }}">
                    <div class="w-full sm:w-1/2 rounded-l-lg h-full p-4">
                        <img class="object-cover w-full h-full rounded" src="{{ $lieu->photo_lieu_url }}"
                            alt="{{ $lieu->nomEtablissement }}">
                    </div>
                    <div class="w-full sm:w-1/2 p-4 flex flex-col h-full gap-y-4">
                        <h5 class="text-xl font-bold uppercase">{{ $lieu->nomEtablissement }}</h5>
                        <div>
                            <div class="uppercase underline text-lg font-semibold">{{ __('description') }}</div>
                            <div class="text-base truncate">{{ $lieu->description ?? __('aucuneDescription') }}.</div>
                        </div>
                        <div class="mb-4">
                            <div class="uppercase underline text-lg font-semibold">{{ __('coordonneesEtInfo') }}</div>
                            <div class="text-base">
                                <p><strong>{{ __('adresse') }} :</strong> {{ $lieu->noCivic }}, {{ $lieu->rue }}
                                </p>
                                <p><strong>{{ trans_choice('ville', 1) }} :</strong>
                                    {{ $lieu->ville()?->nom }}{{ $lieu->codePostal ? ', ' . $lieu->codePostal : '' }}
                                </p>
                                <p><strong>{{ __('pays') }} :</strong> {{ $lieu->pays()?->nom }}</p>
                                <p><strong>{{ __('quartier') }} :</strong> {{ $lieu->quartier->nom }}</p>
                                @if ($lieu->province())
                                    <p><strong>{{ __('province') }} :</strong> {{ $lieu->province()->nom }}</p>
                                @endif
                                @if ($lieu->region())
                                    <p><strong>{{ __('region') }} :</strong> {{ $lieu->region()->nom }}</p>
                                @endif
                                @if ($lieu->siteWeb)
                                    <p class="truncate"><strong>{{ __('siteWeb') }} :</strong> <a
                                            href="{{ $lieu->siteWeb }}"
                                            class="text-blue-500 underline">{{ $lieu->siteWeb }}</a></p>
                                @endif
                                <p><strong>{{ __('telephone') }} :</strong> {{ $lieu->numeroTelephone }}</p>
                                <p><strong>{{ __('typeLieu') }} :</strong> {{ $lieu->typeLieu->nom }}</p>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-4 mt-auto">
                            <button
                                class="boutonSupprimer transform transition duration-300 hover:scale-110 text-[#B20101] hover:text-[#B50000]"
                                data-lieuId="{{ $lieu->id }}" data-nomLieu="{{ $lieu->nomEtablissement }}">
                                <span class="iconify size-8" data-icon="ion:trash-outline" data-inline="false"></span>
                            </button>
                            <button
                                class="boutonModifier transform transition duration-300 hover:scale-110 text-c1-500 hover:text-c1-700"
                                data-lieuId="{{ $lieu->id }}" data-villeId="{{ $lieu->ville()?->id }}"
                                data-typeLieuId="{{ $lieu->typeLieu->id }}">
                                <span class="iconify size-8" data-icon="ep:edit" data-inline="false"></span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<div id="ajouterLieu" class="hidden">@include('usagers.composants.AjouterLieu')</div>
<div id="modifierLieu" class="hidden">@include('usagers.composants.ModifierLieu')</div>

@if (session('erreurAjouterLieu'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("compte").classList.add("hidden");
            const boutonCompte = document.getElementById("boutonCompte");
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonLieu = document.getElementById("boutonLieu");
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            document.getElementById("ajouterLieu").classList.remove("hidden");
            const lieux = document.getElementById("lieux");
            lieux.classList.remove("hidden");

            document.getElementById("afficherLieux").classList.add("hidden");
        });
    </script>
    @php
        session()->forget('erreurAjouterLieu');
    @endphp
@endif

@if (session('erreurModifierLieu'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("compte").classList.add("hidden");
            const boutonCompte = document.getElementById("boutonCompte");
            boutonCompte.classList.remove("bg-c1", "text-c3");
            boutonCompte.classList.add("sm:hover:bg-c1", "sm:hover:text-c3");

            const boutonLieu = document.getElementById("boutonLieu");
            boutonLieu.classList.add("bg-c1", "text-c3");
            boutonLieu.classList.remove("sm:hover:bg-c1", "sm:hover:text-c3");

            document.getElementById("modifierLieu").classList.remove("hidden");
            const lieux = document.getElementById("lieux");
            lieux.classList.remove("hidden");

            document.getElementById("afficherLieux").classList.add("hidden");

            const texteActif = document.getElementById("texteActif");
        });
    </script>
    @php
        session()->forget('erreurModifierLieu');
    @endphp
@endif
