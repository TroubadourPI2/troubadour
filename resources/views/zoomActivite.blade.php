@extends('layouts.app')

@section('title', $activite->nom)

@section('contenu')

    <div class="@container flex flex-col w-full h-3/4 bg-c2">

        <div class="md:flex md:flex-row grid w-full">

            <div class="w-full md:w-3/4 flex flex-row mt-4">
                <div
                    class="my-1 ml-10 md:ml-12 w-3/4 p-4 lg:w-2/5 rounded-full py-1 text-lg font-bold text-center uppercase leading-tight text-white bg-c1">
                    {{ $activite->nom ?? '' }}
                </div>
                <div class=" my-1 ml-4 rounded border-c1 hidden md:block border"></div>
            </div>

            <div class="w-full md:mt-4 md:w-1/2 flex flex-row md:justify-end justify-center items-center">

                <div class=" my-1 mr-1 h-3/4 rounded border-c1 border hidden md:flex"></div>

                <p class="text-c1 text-lg lg:text-xl md:px-20 lg:pr-12 lg:pl-4">
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
                        class="h-[30rem] w-[20rem] sm:w-[40rem] lg:w-[30rem] xl:w-[40rem] mt-10 2xl:mt-16 bg-white mx-6 p-2 mb-8 pb-8 rounded-lg overflow-hidden shadow-lg md:mx-12 lg:mx-0 xl:mx-12 justify-items-center">

                        <div x-data="{
                            autoplayIntervalTime: 4000,
                            slides: {{ json_encode(
                                $activite->photos->map(function ($photo) use ($activite) {
                                    return [
                                        'imgSrc' => asset($photo->chemin),
                                        'imgAlt' => $activite->nom ?? '',
                                        'title' => '',
                                        'description' => '',
                                    ];
                                }),
                            ) }},
                            currentSlideIndex: 1,
                            isPaused: false,
                            autoplayInterval: null,
                        
                            next() {
                                if (this.currentSlideIndex < this.slides.length) {
                                    this.currentSlideIndex = this.currentSlideIndex + 1
                                } else {
                                    this.currentSlideIndex = 1
                                }
                            },
                            autoplay() {
                                this.autoplayInterval = setInterval(() => {
                                    if (!this.isPaused) {
                                        this.next()
                                    }
                                }, this.autoplayIntervalTime)
                            },
                            setAutoplayInterval(newIntervalTime) {
                                clearInterval(this.autoplayInterval)
                                this.autoplayIntervalTime = newIntervalTime
                                this.autoplay()
                            },
                        }" x-init="autoplay" class="relative w-full overflow-hidden">

                            <div class="relative min-h-[40svh] w-full">
                                <template x-for="(slide, index) in slides">
                                    <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                                        x-transition.opacity.duration.1000ms>

                                        <div
                                            class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-linear-to-t from-surface-dark/85 to-transparent px-16 py-12 text-center">
                                        </div>

                                        <img class="absolute w-full h-full inset-0 object-cover text-on-surface dark:text-on-surface-dark"
                                            x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
                                    </div>
                                </template>
                            </div>

                        </div>

                        <div class="px-6 py-3">
                            <div class="font-bold text-xl mb-2 md:w-full truncate">
                                {{ !empty($activite->nom) ? $activite->nom : 'Inconnu' }}

                            </div>
                        </div>

                        <p class="text-c1 text-base mb-5 px-4 truncate line-clamp-3 md:px-20 lg:px-12">
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

                    <div
                        class="card w-[20rem] h-[30rem] rounded-lg overflow-hidden shadow-lg bg-white mt-2 mx-2 lg:w-[17rem] xl:w-[20rem]">
                        <div class="bg-c3 text-c2 text-base p-4 flex items-center h-4">
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-white">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:event-available" data-inline="false"></span><span class="mr-2"> Début:
                                </span></div>
                            <div class="text"> {{ $activite->dateDebut ?? '' }} </div>
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-white">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:event-busy" data-inline="false"></span><span class="mr-6"> Fin: </span>
                            </div>
                            <div class="text"> {{ $activite->dateFin ?? '' }} </div>
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-white">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:local-activity" data-inline="false"></span><span class="mr-3"> Type:
                                </span></div>
                            <div class="text"> {{ $lieu->typeLieu->nom ?? '' }} </div>
                        </div>

                        <div class=" my-1 mx-3 rounded border-c1 bg-white border flex"></div>

                        <div class="text-c1 text-base p-4 flex items-center bg-white">
                            <div class="mr-4 border-r-2 border-c1"><span class="iconify size-7 text-c1 cursor-pointer"
                                    data-icon="mdi:link" data-inline="false"></span><span class="mr-4"> Site: </span>
                            </div>
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
