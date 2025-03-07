@extends('layouts.app')

@section('title', $lieuActuel->nomEtablissement)

@section('contenu')

    <div class="@container flex flex-col w-full h-3/4 bg-c2">

        <div class="flex flex-row w-full">

            <div class="w-full sm:w-3/4 flex flex-row mt-4">
                <div
                    class="my-1 ml-12 w-3/4 p-4 lg:w-2/5 rounded-full py-1 text-lg font-bold text-center uppercase leading-tight text-white bg-c1">
                    {{ $lieuActuel->nomEtablissement }}
                </div>
                <div class=" my-1 ml-4 rounded border-c1 hidden md:block border"></div>
            </div>

            <div class="w-1/2 mt-4 flex flex-row justify-end md:items-start">
                <div class=" my-1 mr-4 h-3/4 rounded border-c1 border hidden md:flex"></div>

                @if (empty($favoris) && !empty($usager))
                    <form action="{{ route('ajouter.favoris.lieu') }}" method="POST">
                        @csrf

                        <input type="hidden" name="idLieu" value="{{ $lieuActuel->id }}">
                        <input type="hidden" name="idUsager" value="{{ $usager->id }}">

                        <button type="submit" style="background: none; border: none;">
                            <span class="iconify size-10 md:ml-0 lg:ml-0 mr-20 text-c1 sm:ml-0 sm:mr-0 md:mr-20"
                                data-icon="f7:heart" data-inline="false"></span>
                        </button>

                    </form>
                @elseif (!empty($favoris) && !empty($usager))
                    <form action="{{ route('delete.favoris.lieu', ['id' => $favoris->id]) }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $favoris->id }}">

                        <button type="submit" style="background: none; border: none;">
                            <span class="iconify size-10 md:ml-0 lg:ml-0 mr-20 text-c1 sm:ml-0 sm:mr-0 md:mr-20"
                                data-icon="line-md:heart-filled" data-inline="false"></span>
                        </button>
                    </form>
                @else
                    <span class="iconify size-10 md:ml-0 lg:ml-0 mr-20 text-c1 sm:ml-0 sm:mr-0 md:mr-20"
                        data-icon="f7:heart" data-inline="false"></span>
                @endif
            </div>

        </div>

        <div class="w-full flex">
            <div class="h-0.5 w-full flex flex-row rounded ml-12 mr-12 bg-c1"></div>
        </div>

        <div class="h-full w-full md:flex md:flex-col lg:flex-row sm:flex sm:flex-col">

            <!--        Carte pour Image      -->

            <div class="text-c1 align-middle md:flex text-center sm:w-full sm:order-0 lg:order-2 lg:w-1/2 mt-8 mb-8 ">

                <div class="mt-8 lg:h-2/3 2xl:h-5/6 hidden lg:block rounded border-c1 border"></div>

                <div class="w-full flex flex-col items-center px-6">

                    <div
                        class="lg:h-2/3 2xl:h-3/4 mt-10 2xl:mt-16 bg-white p-2 mb-8 pb-8 rounded-lg overflow-hidden shadow-lg md:mx-12 lg:mx-0 xl:mx-12 justify-items-center">
                        @if ($lieuActuel->photoLieu)
                            <img class="w-96 h-52 md:w-100 md:h-[18rem] lg:w-[40rem] 2xl:h-[24rem] rounded"
                                src="{{ $lieuActuel->photo_lieu_url }}" alt="{{ $lieuActuel->nomEtablissement }}">
                        @else
                            <img class="w-96 h-52 md:w-100 md:h-[18rem] lg:w-[40rem] 2xl:h-[24rem] rounded"
                                src="{{ asset('/Images/Logos/logoC1.svg') }}" alt="Troubadour">
                        @endif
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 md:w-full truncate">
                                {{ $lieuActuel->nomEtablissement }}

                            </div>
                        </div>

                        <p class="text-c1 text-base mb-5 px-4 line-clamp-3 md:px-20 lg:px-12">
                            {{ $lieuActuel->description ?? __('aucuneDescription') }}

                        </p>

                        <div class="px-6 pb-20 sm:pb-4 md:pb-6 lg:pb-32">
                            @if ($lieuActuel->typeLieu->nom)
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $lieuActuel->typeLieu->nom }}</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            <!--        Carte pour Localisation      -->

            <div class="text-c1 align-middle flex text-center lg:w-1/3 xl:w-1/4 sm:w-full sm:order-1 lg:order-0 mt-8 mb-8">
                <div class="w-full flex flex-col items-center">

                    <div class="flex text-center mb-2">
                        <span class="iconify size-8  text-c1" data-icon="bx:map" data-inline="false"></span>
                        <span class="font-sm text-2xl underline"> {{ __('localisation') }} </span>
                    </div>

                    <div
                        class="card w-[20rem] h-[37rem] rounded-lg overflow-hidden shadow-lg bg-c3 mt-6 mx-2 lg:w-[17rem] xl:w-[20rem]">
                        <div class="bg-c3 text-c2 text-base p-4 flex items-center h-4">
                        </div>

                        <div> {{ __('quartier') }}:</div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-c3">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:event-available" data-inline="false"></span></div>
                            <div class="text">{{ $lieuActuel->quartier->nom }}</div>
                        </div>

                        <div class=" my-1 mx-3"></div>

                        <div> {{ __('rue') }}: </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-c3">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:event-busy" data-inline="false"></span>
                            </div>
                            <div class="text"> {{ $lieuActuel->noCivic }} {{ $lieuActuel->rue }} </div>
                        </div>

                        <div class=" my-1 mx-3"></div>

                        <div> {{ __('codePostal') }}: </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-c3">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:local-post-office" data-inline="false"></span></div>
                            <div class="text"> {{ $lieuActuel->codePostal }} </div>
                        </div>

                        <div class=" my-1 mx-3"></div>

                        <div> {{ __('telephone') }}: </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-c3">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:smartphone" data-inline="false"></span></div>
                            <div class="text"> {{ $lieuActuel->numeroTelephone }} </div>
                        </div>

                        <div class=" my-1 mx-3"></div>

                        <div class=""> {{ __('siteWeb') }}: </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-c3">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:link" data-inline="false"></span>
                            </div>
                            <div class="text">
                                @if ($lieuActuel->siteWeb)
                                    <a href="{{ $lieuActuel->siteWeb ?? '' }}">
                                        {{ $lieuActuel->siteWeb ?? __('aucunSiteWeb') }}
                                    </a>
                                @else
                                    <a href="{{ $lieuActuel->siteWeb ?? '' }}">
                                        {{ $lieuActuel->siteWeb ?? __('aucunSiteWeb') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class=" my-1 mx-3"></div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                        <div class="bg-c3 text-c2 text-base p-4 flex items-center h-4">

                        </div>
                    </div>

                </div>
            </div>

            <!--        Carte pour Activité      -->

            <div
                class="text-c1 align-middle flex flex-row text-center lg:w-1/3 xl:w-1/4 sm:w-full sm:order-2 lg:order-1 mt-8 mb-8">

                <div class="mt-8 lg:h-2/3 2xl:h-5/6 hidden lg:block rounded border-c1 border"></div>

                <div class="w-full flex flex-col items-center">

                    <div class="flex text-center mb-2">
                        <span class="iconify size-8 text-c1" data-icon="material-symbols:map-outline"
                            data-inline="false"></span>
                        <span class="font-sm text-2xl underline"> {{ __('activites') }} </span>
                    </div>

                    <div
                        class="card w-[20rem] h-[37rem] rounded-lg overflow-hidden shadow-lg bg-c3 mt-6 mx-2 lg:w-[17rem] xl:w-[20rem]">
                        <div class="bg-c3 text-c2 text-base p-4 flex items-center h-4">
                        </div>
                        <div class=" my-1 mx-3"></div>

                        @foreach ($activites as $activite)
                            <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                            <div class="text-c1 text-base p-4 flex items-center bg-c3">
                                <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                        data-icon="mdi:local-activity" data-inline="false"></span></div>
                                <div class="text"> <a
                                        href="{{ route('Activite.zoom', ['id' => $activite->id, 'idLieu' => $lieuActuel->id]) }}">
                                        <p class="text-c1 text-base underline truncate mb-5">{{ $activite->nom }}</p>
                                    </a>
                                </div>
                            </div>

                            <div class=" my-1 mx-3"></div>
                        @endforeach
                        <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    </div>

@endsection
