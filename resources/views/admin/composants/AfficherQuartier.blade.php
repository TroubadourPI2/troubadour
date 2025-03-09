<div class="flex w-full h-full flex-col" id="afficherQuartiers">
    
    <bouton id="boutonAjouterQuartier" class="rounded-full w-fit items-center uppercase text-lg flex leading-tight border-c1 border-2 text-c1 bg-c2 hover:bg-c3 pr-4">
        <span class="iconify text-c1 sm:size-8 size-4 sm:ml-2 font-semibold" data-icon="ion:add"
        data-inline="false"></span>
        {{ __('ajouter') }}
    </bouton>

</div>  

<div id="ajouterQuartier" class="">@include('admin.composants.AjouterQuartier')</div>


