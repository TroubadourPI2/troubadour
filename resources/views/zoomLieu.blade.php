@extends('layouts.app')

@section('title', 'Zoom')

@section('contenu')

    <div class="@container flex flex-col w-full h-3/4 bg-c2">

        <div class="flex flex-row w-full">

            <div class="w-1/2 flex flex-row">
                <div
                    class="my-1 ml-12 p-3 w-1/4 rounded-full py-1 text-lg font-bold text-center uppercase leading-tight text-white bg-c1">
                    Musée Boréalis
                </div>
                <div class=" my-1 ml-4 rounded border-c1 border"></div>  
            </div>

            <div class="w-1/2 flex flex-row justify-end">
                <div class=" my-1 mr-12 rounded border-c1 border"></div>  
                <span class="iconify size-10 m-0 mr-24 text-c1" data-icon="f7:heart" data-inline="false"></span>
            </div>

        </div>

        <div class="w-full flex">
            <div class="h-0.5 w-full flex flex-row rounded ml-12 mr-12 bg-c1"></div>
        </div>

        <div class="h-full w-full flex flex-row">

            <div class="text-c1 align-middle flex text-center w-1/4 mt-8">
                <div class="w-full flex flex-col items-center">

                    <div class="flex text-center mb-2">
                        <span class="iconify size-8  text-c1" data-icon="bx:map" data-inline="false"></span>
                        <span class="font-sm text-2xl  underline"> Localisation </span>
                    </div>

                    <div class=" w-3/4 h-2/3 bg-white p-2 rounded-lg overflow-hidden shadow-lg">
                        <div class="px-6 py-4 text-left">

                        <p class="text-c1 text-base underline"> bip </p>

                        </div>
                    </div>

                </div>
            </div>

            <div class="text-c1 align-middle flex flex-row text-center w-1/4 mt-8">

            <div class="mt-8 h-2/3 rounded border-c1 border"></div>  

                <div class="w-full flex flex-col items-center">

                    <div class="flex text-center mb-2">
                        <span class="iconify size-8  text-c1" data-icon="material-symbols:map-outline"
                            data-inline="false"></span>
                        <span class="font-sm text-2xl underline"> Activité </span>
                    </div>

                    <div class=" w-3/4 h-2/3 bg-white p-2 rounded-lg overflow-hidden shadow-lg">
                        <div class="px-6 py-4 text-left">

                            <p class="text-c1 text-base underline"> bop </p>

                        </div>
                    </div>

                </div>
            </div>


            <div class="text-c1 align-middle flex text-center w-1/2 mt-8">

            <div class="mt-8 h-2/3 rounded border-c1 border"></div>  

                <div class="w-full flex justify-center ">

                    <div class=" w-full h-2/3 mt-10 bg-white p-2 rounded-lg overflow-hidden shadow-lg mx-12">
                        <img class="w-full h-3/4 rounded"
                            src="https://www.borealis3r.ca/app/uploads/2021/07/185557013-5924996890851454-6726044064280675408-n.jpeg"
                            alt="Sunset in the mountains">
                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2">Musée Boréalis</div>
                        </div>
                        <div class="px-6 pb-2">
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
