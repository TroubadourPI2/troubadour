@extends('layouts.app')

@section('title', 'Accueil')

@section('header')

@endsection

@section('contenu')

    <div class="bg-c2 flex w-full h-full flex-col items-center">
        <!-- Titre de la section de recherche -->
        <h2 class="w-full text-center text-c1 font-bold text-2xl font-barlow">Recherche</h2>

        <div class="flex w-5/6 bg-c3 rounded-full justify-evenly items-center mt-4 h-10 lg:h-12">
            <div class="lg:ml-1 lg:mr-0 mx-1 p-1 lg:pr-0 flex rounded-full justify-evenly flex-row w-full h-8 items-center">

                <select
                    class="border border-c3 hidden lg:flex bg-c1 hover:bg-c2 justify-center items-center h-full lg:h-8 w-1/2 lg:w-1/5 me-px rounded-l-full font-barlow text-c3 text-center hover:text-c1 text-xs md:text-md lg:text-lg hover:border hover:border-c1"
                    id="selectVille">
                    <option value="default" disabled selected>Choisir la ville</option>
                    <option value="TR">Trois-Rivières</option>
                    <option value="QC">Québec</option>
                </select>

                <button type="button"
                    class="flex lg:hidden me-px w-1/2 cursor-pointer hover:bg-c2 bg-c1 rounded-l-full font-barlow text-c3 hover:text-c1 text-center border items-center justify-center border-c3">Choisir
                    la ville</button>
                <button type="button"
                    class="flex lg:hidden w-1/2 cursor-pointer hover:bg-c2 bg-c1 rounded-r-full font-barlow text-c3 hover:text-c1 text-center border items-center justify-center border-c3">Choisir
                    le quartier</button>

                <select
                    class="border border-c3 hidden lg:flex bg-c1 justify-center items-center h-full lg:h-8 w-1/2 lg:w-1/5 rounded-r-full font-barlow text-c3 text-center hover:bg-c2 hover:text-c1 text-xs md:text-md lg:text-lg hover:border hover:border-c1"
                    id="selectQuartier">
                </select>

                <input type="text"
                    class="lg:flex hidden w-4/5 h-8 bg-transparent text-c1 font-barlow text-md p-2 mx-1 text-center rounded-full focus:border focus:border-0.5 focus:border-c1 hover:bg-c2 hover:border hover:border-c1"
                    placeholder="Rechercher un lieu" id="barreRecherche">
                <span
                    class="lg:flex lg:mr-2 hidden iconify size-6 text-c3 w-1/4 lg:w-1/6 p-2 h-8 cursor-pointer hover:text-c1 hover:bg-c2 rounded-full bg-c1 hover:border hover:border-c1"
                    data-icon="mdi:search" data-inline="false"></span>
            </div>
        </div>

        <div class="flex lg:hidden w-5/6 bg-c3 rounded-full justify-evenly items-center mt-2 h-10 lg:h-12">
            <div class="lg:ml-1 lg:mr-0 mx-1 p-1 lg:pr-0 flex rounded-full justify-evenly flex-row w-full h-8 items-center">
                <input type="text"
                    class="w-4/5 h-6 bg-transparent text-c1 font-barlow text-md p-2 mx-1 text-center rounded-full focus:border focus:border-0.5 focus:border-c1 hover:bg-c2 hover:border hover:border-c1"
                    placeholder="Rechercher un lieu" id="barreRecherche">
                <span
                    class="lg:mr-2 iconify size-6 text-c3 w-1/4 lg:w-1/6 p-1 h-6 cursor-pointer hover:text-c1 hover:bg-c2 rounded-full bg-c1 hover:border hover:border-c1"
                    data-icon="mdi:search" data-inline="false"></span>
            </div>
        </div>

        <!-- Séparateur -->
        <div class="w-full flex justify-center items-center h-8">
            <hr class="w-3/4 bg-c1 h-1">
        </div>

        <!-- Boutons de filtres -->
        <div class="w-5/6 h-12 justify-center items-center space-x-5 my-4 flex-row hidden lg:flex">
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Prix</h3>
            </div>
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Type</h3>
            </div>
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Distance</h3>
            </div>
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Organisme</h3>
            </div>
            <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
                <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Avis</h3>
            </div>
        </div>
        <div class="w-3/5 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1 lg:hidden">
            <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">Filtres</h3>
        </div>

        <!-- ?  Section des cartes (avec scroll seulement ici) [RESPONSIVE]-->
        <div class="flex w-5/6 h-3/4 overflow-y-auto flex-col space-y-10 overflow-x-hidden m-3 snap-y">
            <div class="lg:grid-cols-5 grid-col-1 grid gap-y-5 place-items-center snap-center">
                <!-- Carte 1 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu ">
                    <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Boréalis</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 2 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu">
                    <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Amphithéâtre Cogéco</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 3 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu">
                    <img src="{{ asset('images/Lieux/thompson3.jpg') }}" alt="Image de la Salle J.-Anthonio-Thompson"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Salle J.-A.-Thompson</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 4 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu">
                    <img src="{{ asset('images/Lieux/bgl.jpg') }}" alt="Image de la maison de la culture"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Centre Raymond Lasnier</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 5 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu">
                    <img src="{{ asset('images/Lieux/ssj.jpg') }}" alt="Image du séminaire Saint-Joseph"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Musée Pierre-Boucher</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 1 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu ">
                    <img src="{{ asset('images/Lieux/borealis.jpg') }}" alt="Image du musée boréalis"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Boréalis</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 2 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu">
                    <img src="{{ asset('images/Lieux/amphitheatre.jpg') }}" alt="Image de l'amphithéâtre cogéco"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Amphithéâtre Cogéco</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 3 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu">
                    <img src="{{ asset('images/Lieux/thompson3.jpg') }}" alt="Image de la Salle J.-Anthonio-Thompson"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Salle J.-A.-Thompson</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 4 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu">
                    <img src="{{ asset('images/Lieux/bgl.jpg') }}" alt="Image de la maison de la culture"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Centre Raymond Lasnier</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>

                <!-- Carte 5 -->
                <div
                    class="snap-start lg:w-3/4 w-2/3 bg-c3 h-full  rounded-lg flex flex-col items-center p-3 border-2 border-c3 hover:border-2 hover:border-c1 cursor-pointer carteLieu">
                    <img src="{{ asset('images/Lieux/ssj.jpg') }}" alt="Image du séminaire Saint-Joseph"
                        class="rounded-md h-52">
                    <h3 class="text-c1 font-barlow text-md my-2 carteTitre">Musée Pierre-Boucher</h3>
                    <span class="text-black font-barlow text-sm text-center">Insérer une description</span>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/filtreRecherche.js') }}"></script>
    <script src="{{ asset('js/JSrechercheTexte.js') }}"></script>

@endsection
