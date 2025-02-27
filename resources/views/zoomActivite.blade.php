@extends('layouts.app')

@section('title', $activite->nom)

@section('contenu')

    <div class="@container flex flex-col w-full h-3/4 bg-c2">

        <div class="flex flex-row w-full">

            <div class="w-full sm:w-3/4 flex flex-row mt-4">
                <div
                    class="my-1 ml-12 w-3/4 p-4 lg:w-2/5 rounded-full py-1 text-lg font-bold text-center uppercase leading-tight text-white bg-c1">
                    {{ $activite->nom ?? '' }}
                </div>
                <div class=" my-1 ml-4 rounded border-c1 hidden md:block border"></div>
            </div>

            <div class="w-1/2 mt-4 flex flex-row justify-end items-center">

                <div class=" my-1 mr-1 h-3/4 rounded border-c1 border hidden md:flex"></div>

                <p class="text-c1 text-xl px-4 md:px-20 lg:pr-12 lg:pl-4">
                    {{ !empty($lieu->nomEtablissement) ? $lieu->nomEtablissement : 'Aucune description' }}
                </p>

            </div>

        </div>

        <div class="w-full flex">
            <div class="h-0.5 w-full flex flex-row rounded ml-12 mr-12 bg-c1"></div>
        </div>

        <div class="h-full w-full md:flex md:flex-col lg:flex-row sm:flex sm:flex-col">

            <!--        Card pour Images      -->

            <div class="text-c1 align-middle md:flex text-center sm:w-full sm:order-0 lg:order-2 lg:w-2/3 mt-10 mb-8 ">

                <div class="mt-8 lg:h-5/6 2xl:h-5/6 hidden lg:block rounded border-c1 border"></div>

                <div class="w-full flex flex-col items-center px-6 ">

                    <div
                        class="h-[30rem] w-[20rem] mt-10 2xl:mt-16 bg-white mx-6 p-2 mb-8 pb-8 rounded-lg overflow-hidden shadow-lg md:mx-12 lg:mx-0 xl:mx-12 justify-items-center">

                        <img class="w-96 h-52 md:w-100 md:h-[18rem] lg:w-[40rem] rounded"
                            src="{{ asset($photo) }}" alt="{{ $activite->nom ?? '' }}">

                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 md:w-full truncate">
                                {{ !empty($activite->nom) ? $activite->nom : 'Inconnu' }}

                            </div>
                        </div>

                        <p class="text-c1 text-base mb-5 px-4 line-clamp-3 md:px-20 lg:px-12">
                            {{ !empty($activite->description) ? $activite->description : 'Aucune description' }}
                        </p>

                    </div>

                </div>
            </div>

            <!--        Card pour les informations de l'Activite      -->

            <div class="text-c1 align-middle flex text-center lg:w-1/3 xl:w-1/3 sm:w-full sm:order-1 lg:order-0 mt-8 mb-8">
                <div class="w-full flex flex-col items-center">

                    <div class="flex text-center mb-2">
                        <span class="iconify size-8  text-c1" data-icon="cil:description" data-inline="false"></span>
                        <span class="font-sm text-2xl underline"> Informations </span>
                    </div>

                    <div class="card w-[20rem] h-[30rem] rounded-lg overflow-hidden shadow-lg bg-white mt-2 mx-2 lg:w-[20rem]">
                        <div class="bg-c3 text-c2 text-base p-4 flex items-center h-4">
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-white">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:event-available" data-inline="false"></span><span class="mr-2"> Début: </span></div>
                            <div class="text"> {{ $activite->dateDebut ?? '' }} </div>
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-white">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:event-busy" data-inline="false"></span><span class="mr-6"> Fin: </span></div>
                            <div class="text"> {{ $activite->dateFin ?? '' }} </div>
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-white">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:local-activity" data-inline="false"></span><span class="mr-3"> Type: </span></div>
                            <div class="text"> {{ $lieu->typeLieu->nom ?? '' }} </div>
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-white">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:link" data-inline="false"></span><span class="mr-4"> Site: </span></div>
                            <div class="text">
                                @if ($lieu->siteWeb)
                                    <a href="{{ $lieu->siteWeb ?? '' }}">
                                        {{ !empty($lieu->siteWeb) ? $lieu->siteWeb : 'Aucun site web' }}</a>
                                @else
                                    {{ !empty($lieu->siteWeb) ? $lieu->siteWeb : 'Aucun site web' }}
                                @endif
                            </div>
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="bg-c3 text-c2 text-base p-4 flex items-center h-4">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
