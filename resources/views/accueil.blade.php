@extends('layouts.app')

@section('title', 'Accueil')

@section('contenu')

    <div class="flex w-full h-screen flex-col  ">

        <div class="relative flex flex-col justify-start w-full  h-full font-barlow overflow-hidden">

            <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
                <source src="{{ asset('videos/activites.mp4') }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo.
            </video>

            <div class="absolute top-0 left-0 w-full h-full bg-black opacity-70 z-5"></div>

            <div class="relative z-10 w-full h-full flex flex-col ">

                <navbar class="w-full flex justify-between  p-8 ">
                    <div class="flex gap-x-8  ">
                        <a
                            class="text-c3  hidden lg:flex lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                            ACCUEIL
                        </a>
                        <a
                            class="text-c3 text-xl lg:text-2xl font-barlow cursor-pointer hover:bg-c3 px-4 hover:text-c1 rounded-full transition-transform duration-500 ease-out">
                            À PROPOS
                        </a>
                    </div>
                    <div>
                        <a
                            class="text-xl lg:text-2xl  bg-c2 rounded-full p-1.5 px-4 hover:bg-c3 cursor-pointer text-c1 font-barlow">CONNEXION</a>
                    </div>
                </navbar>
                <div class="text-c3 border mx-4 "></div>

                <div class="w-full h-full flex  justify-evenly items-center flex-col">
                    <div class="flex flex-col   w-full items-center">
                        <span class="text-c3 font-barlow  text-5xl lg:text-9xl">TROUBADOUR</span>
                        <span class="text-c3 text-xl lg:text-5xl uppercase">Explorez sans limite</span>

                    </div>
                    <div>
                        <button id="ActiverSection"
                            class="group items-center flex-col text-4xl flex p-1.5  text-c1 font-barlow hover:scale-110 transition-transform duration-500 ease-out">
                            <span class="bg-c2 shadow-lg px-6  rounded-full ">VILLES</span>
                            <span
                                class="iconify text-c3 size-12  transform transition-all duration-1000 ease-out group-hover:translate-y-3"
                                data-icon="fluent:arrow-down-24-regular" data-inline="false"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="sectionCacher" class="flex w-full h-screen   justify-center bg-c1 text-c2 font-barlow text-5xl hidden">
        <span id="villeSpan" class="pt-4 font-bold animate-pulse uppercase">Chargement... </span>
        
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttonVilles = document.getElementById("ActiverSection");
            const villeSpan = document.getElementById("villeSpan");
            const sectionCacher = document.getElementById("sectionCacher");
            buttonVilles.addEventListener("click", function() {
                axios.get('/geolocalisation/ville')
                    .then(response => {
                        const donnee = response.data;
                        if (donnee.ville) {
                            localStorage.setItem('usagerVilleAccueil', donnee.ville);
                            setTimeout(() => {
                                villeSpan.innerText = `${donnee.ville}`;
                                villeSpan.classList.remove("animate-pulse")
                            }, 600);

                        }
                    })
                    .catch(error => console.error('Erreur de géolocalisation', error));


                sectionCacher.classList.remove("hidden");
                sectionCacher.scrollIntoView({
                    behavior: "smooth"
                });
            });
        });
    </script>

@endsection
