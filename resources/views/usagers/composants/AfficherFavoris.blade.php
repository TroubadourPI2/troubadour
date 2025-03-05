<!-- Boutons de filtres -->
<div class="w-full h-12 justify-center items-center space-x-5 my-4 flex-row hidden lg:flex">
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Prix') !!}</h3>
    </div>
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Type') !!}</h3>
    </div>
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Distance') !!}</h3>
    </div>
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Organisme') !!}</h3>
    </div>
    <div class="w-40 rounded-full bg-c2 border-c1 border cursor-pointer hover:bg-c1">
        <h3 class="text-c1 font-barlow text-lg text-center hover:text-c3">{!! __('Avis') !!}</h3>
    </div>
</div>

<div class="flex w-full h-3/4 overflow-y-auto flex-col space-y-10 overflow-x-hidden m-3 snap-y">
    <h2>Activités Favorites</h2>

    <ul>
        @forelse ($usager->activiteFavoris as $favori)
            <li>{{ $favori->activite->nom }}</li>
        @empty
            <li>Aucune activité favorite.</li>
        @endforelse
    </ul>

    <!-- <div class="w-full h-full place-content-center">
            <h3 class="text-center text-c1 text-bold font-barlow text-xl">{!! __('Aucun résultat trouvé') !!}</h3>
        </div> -->

    <h2>Lieux Favoris</h2>

</div>
