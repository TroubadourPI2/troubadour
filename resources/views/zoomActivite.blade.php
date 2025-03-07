@extends('layouts.app')

@section('title', $activite->nom)

@section('contenu')

    <div class="@container flex flex-col w-full h-3/4 bg-c2">

        <div class="md:flex md:flex-row grid w-full">

            <div class="w-full md:w-3/4 flex flex-row mt-4">
                <div
                    class="my-1 ml-10 md:ml-12 w-3/4 p-4 lg:w-2/5 rounded-full py-1 text-lg font-bold text-center uppercase leading-tight text-white bg-c1">
                    {{ $activite->nom }}
                </div>
                <div class=" my-1 ml-4 rounded border-c1 hidden md:block border"></div>
            </div>

            <div class="w-full md:mt-4 md:w-1/2 flex flex-row md:justify-end justify-center items-center">

                <div class=" my-1 mr-1 h-3/4 rounded border-c1 border hidden md:flex"></div>

                <p class="text-c1 text-lg lg:text-xl md:px-20 lg:pr-12 lg:pl-4">
                    {{ $lieu->nomEtablissement }}
                </p>

                @if (empty($favoris) && !empty($usager))
                    <form action="{{ route('ajouter.favoris.activite') }}" method="POST">
                        @csrf

                        <input type="hidden" name="idActivite" value="{{ $activite->id }}">
                        <input type="hidden" name="idUsager" value="{{ $usager->id }}">

                        <button type="submit" style="background: none; border: none;">
                            <span class="iconify size-10 md:ml-0 lg:ml-0 ml-5 text-c1 sm:ml-0 sm:mr-0 md:mr-20"
                                data-icon="f7:heart" data-inline="false"></span>
                        </button>

                    </form>
                @elseif (!empty($favoris) && !empty($usager))
                    <form action="{{ route('delete.favoris.activite', ['id' => $favoris->id]) }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{{ $favoris->id }}">

                        <button type="submit" style="background: none; border: none;">
                            <span class="iconify size-10 md:ml-0 lg:ml-0 ml-5 text-c1 sm:ml-0 sm:mr-0 md:mr-20"
                                data-icon="line-md:heart-filled" data-inline="false"></span>
                        </button>
                    </form>
                @else
                    <span class="iconify size-10 md:ml-0 lg:ml-0 ml-5 text-c1 sm:ml-0 sm:mr-0 md:mr-20" data-icon="f7:heart"
                        data-inline="false"></span>
                @endif
            </div>

        </div>

    </div>

    <div class="w-full flex">
        <div class="h-0.5 w-full flex flex-row rounded ml-12 mr-12 bg-c1"></div>
    </div>

    <div class="h-full w-full md:flex md:flex-col lg:flex-row sm:flex sm:flex-col">

        <!--        Carte pour Images      -->

        <div class="text-c1 align-middle md:flex text-center sm:w-full sm:order-0 lg:order-2 lg:w-2/3 mt-5 mb-8 ">

            <div class="mt-8 lg:h-5/6 2xl:h-5/6 hidden lg:block rounded border-c1 border"></div>

            <div class="w-full flex flex-col items-center px-6 ">

                <div
                    class="h-[30rem] w-[20rem] sm:w-[40rem] lg:w-[30rem] xl:w-[40rem] mt-10 2xl:mt-16 bg-white mx-6 p-2 mb-8 pb-8 rounded-lg overflow-hidden shadow-lg md:mx-12 lg:mx-0 xl:mx-12 justify-items-center">

                    <div class="activite-carte w-full h-96 flex bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden ease-in-out duration-300 border hover:border-2 hover:border-c1 "
                        data-nom="{{ strtolower($activite->nom) }}" data-lieu-ids="{{ $activite->lieu_ids }}"
                        data-type="{{ $activite->typeActivite->id }}" data-actif="{{ $activite->actif }}"
                        x-data='{
                     current: 0,
                     images: {!! $activite->photos_json !!},
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
                    </div>

                    <div class="px-6 py-1">
                        <div class="font-bold text-xl mb-2 md:w-full truncate">
                            {{ $activite->nom }}

                        </div>
                    </div>

                    <p class="text-c1 text-base mb-5 px-4 md:px-20 lg:px-12 line-clamp-3 overflow-hidden text-ellipsis">
                        {{ $activite->description ?? __('aucuneDescription') }}
                    </p>

                </div>
            </div>
        </div>

        <!--        Carte pour les informations de l'Activite      -->

        <div class="text-c1 align-middle flex text-center lg:w-1/3 xl:w-1/3 sm:w-full sm:order-1 lg:order-0 mt-8 mb-8">
            <div class="w-full flex flex-col items-center">

                <div class="flex text-center mb-2">
                    <span class="iconify size-8  text-c1" data-icon="cil:description" data-inline="false"></span>
                    <span class="font-sm text-2xl underline"> {{ __('informations') }} </span>
                </div>

                <div
                    class="card w-[20rem] h-[30rem] rounded-lg overflow-hidden shadow-lg bg-c3 mt-2 mx-2 lg:w-[17rem] xl:w-[20rem]">
                    <div class="bg-c3 text-c2 text-base p-4 flex items-center h-4">
                    </div>

                    <div> {{ __('debut') }}:</div>

                    <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                    <div class="text-c1 text-base p-4 flex items-center bg-c3">
                        <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                data-icon="mdi:event-available" data-inline="false"></span></div>
                        <div class="text"> {{ $activite->dateDebut }} </div>
                    </div>

                    <div class=" my-1 mx-3"></div>

                    <div> {{ __('fin') }}: </div>

                    <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                    <div class="text-c1 text-base p-4 flex items-center bg-c3">
                        <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                data-icon="mdi:event-busy" data-inline="false"></span>
                        </div>
                        <div class="text"> {{ $activite->dateFin }} </div>
                    </div>

                    <div class=" my-1 mx-3"></div>

                    <div> {{ __('type') }}: </div>

                    <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                    <div class="text-c1 text-base p-4 flex items-center bg-c3">
                        <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                data-icon="mdi:local-activity" data-inline="false"></span></div>
                        <div class="text"> {{ $lieu->typeLieu->nom }} </div>
                    </div>

                    <div class=" my-1 mx-3"></div>

                    <div class=""> {{ __('siteWeb') }}: </div>

                    <div class=" my-1 mx-3 rounded border-c1 bg-c3 border flex"></div>

                    <div class="text-c1 text-base p-4 flex items-center bg-c3">
                        <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                data-icon="mdi:link" data-inline="false"></span>
                        </div>
                        <div class="text">
                            @if ($lieu->siteWeb)
                                <a href="{{ $lieu->siteWeb ?? '' }}">
                                    {{ $lieuActuel->siteWeb ?? __('aucunSiteWeb') }}
                                @else
                                    {{ $lieuActuel->siteWeb ?? __('aucunSiteWeb') }}
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
    </div>
    </div>

@endsection
