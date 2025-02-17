@extends('layouts.app')

@section('title', 'Zoom')

@section('contenu')

    <div class="@container flex flex-col w-full h-3/4 bg-c2">

        <div class="flex flex-row w-full">

            <div class="w-full sm:w-3/4 flex flex-row mt-4">
                <div
                    class="my-1 ml-12 w-3/4 p-4 lg:w-2/5 rounded-full py-1 text-lg font-bold text-center uppercase leading-tight text-white bg-c1 truncate">
                    {{ $lieuActuel->nomEtablissement }}
                </div>
                <div class=" my-1 ml-4 rounded border-c1 hidden md:block border"></div>
            </div>

            <div class="w-1/2 mt-4 flex flex-row justify-end md:items-start">
                <div class=" my-1 mr-4 h-3/4 rounded border-c1 border hidden md:flex"></div>
                <span class="iconify size-10 md:ml-0 lg:ml-0 mr-20 text-c1 sm:ml-0 sm:mr-0 md:mr-20" data-icon="f7:heart"
                    data-inline="false"></span>
            </div>

        </div>

        <div class="w-full flex">
            <div class="h-0.5 w-full flex flex-row rounded ml-12 mr-12 bg-c1"></div>
        </div>

        <div class="h-full w-full md:flex md:flex-col lg:flex-row sm:flex sm:flex-col">

            <!--        Card pour Image      -->

            <div class="text-c1 align-middle md:flex text-center sm:w-full sm:order-0 lg:order-2 lg:w-1/2 mt-8 mb-8 ">

                <div class="mt-8 lg:h-2/3 2xl:h-full hidden lg:block rounded border-c1 border"></div>

                <div class="w-full flex flex-col items-center px-6">

                    <div
                        class="lg:h-2/3 2xl:h-full mt-10 bg-white p-2 pb-8 rounded-lg overflow-hidden shadow-lg md:mx-12 lg:mx-0">
                        <img class="md:w-full h-3/4 rounded" src="{{ asset($lieuActuel->photoLieu) }}" alt="Musée Boréalis">
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 md:w-full truncate"> {{ $lieuActuel->nomEtablissement }}
                            </div>
                        </div>
                        <div class="px-6 pb-2 hidden md:block">
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Histoire</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Voyage</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#Musée</span>
                        </div>
                    </div>

                </div>
            </div>

            <!--        Card pour Localisation      -->

            <div class="text-c1 align-middle flex text-center lg:w-1/4 sm:w-full sm:order-1 lg:order-0 mt-8 mb-8">
                <div class="w-full flex flex-col items-center">

                    <div class="flex text-center mb-2">
                        <span class="iconify size-8  text-c1" data-icon="bx:map" data-inline="false"></span>
                        <span class="font-sm text-2xl underline"> Localisation </span>
                    </div>

                    <div class=" w-3/4 lg:h-2/3 2xl:h-full 2xl:mt-6 bg-white p-2 rounded-lg overflow-hidden shadow-lg">
                        <div class="px-6 py-4 text-left">

                            <p class="text-c1 text-base underline truncate my-5">{{ $quartier->nom }}</p>

                            <p class="text-c1 text-base underline truncate my-5"> {{ $lieuActuel->noCivic }},
                                {{ $lieuActuel->rue }} </p>
                            <p class="text-c1 text-base underline truncate my-5"> {{ $lieuActuel->codePostal }}</p>
                            <p class="text-c1 text-base underline truncate my-5"> {{ $lieuActuel->numeroTelephone }}</p>
                            <p class="text-c1 text-base underline truncate my-5"> {{ $lieuActuel->siteWeb }}</p>

                        </div>
                    </div>

                </div>
            </div>

            <!--        Card pour Activité      -->

            <div class="text-c1 align-middle flex flex-row text-center lg:w-1/4 sm:w-full sm:order-2 lg:order-1 mt-8 mb-8">

                <div class="mt-8 lg:h-2/3 2xl:h-full hidden lg:block rounded border-c1 border"></div>

                <div class="w-full flex flex-col items-center">

                    <div class="flex text-center mb-2">
                        <span class="iconify size-8 text-c1" data-icon="material-symbols:map-outline"
                            data-inline="false"></span>
                        <span class="font-sm text-2xl underline"> Activité </span>
                    </div>

                    <div class=" w-3/4 lg:h-2/3 2xl:h-full 2xl:mt-6 bg-white p-2 rounded-lg overflow-hidden shadow-lg">
                        <div class="px-6 py-4 text-left">

                            <p class="text-c1 text-base underline truncate"> MAJ la BD les informations d'activités </p>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
