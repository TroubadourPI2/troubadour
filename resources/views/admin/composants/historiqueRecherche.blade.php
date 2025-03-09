<div class="flex w-full h-full flex-col mb-4 font-barlow">
    <div class="w-full h-full flex flex-col justify-center items-center">
        <div class="grid grid-cols-1 xl:grid-cols-3 2xl:grid-cols-5 gap-3 h-3/4 w-5/6 bg-c2">
            @if (count($termesRecherche) == 0)
                <div class="grid-cols-subgrid gap-4 col-span-4 hidden xl:grid">
                    <div class="col-start-3 flex w-full h-full justify-between items-center bg-c3 rounded-md p-1 px-3">
                        <h3 class="text-c1 font-barlow text-lg text-center">{{ __('aucuneRechercheEffectuee') }}</h3>
                    </div>
                </div>
                <div class="flex w-full h-full justify-between items-center bg-c3 rounded-md p-1 px-3 xl:hidden">
                    <h3 class="text-c1 font-barlow text-lg text-center">{{ __('aucuneRechercheEffectuee') }}</h3>
                </div>
            @else
                @foreach ($termesRecherche as $recherche)
                    <div class="flex w-full h-full justify-between items-center bg-c3 rounded-md p-1 px-3">
                        <h3 class="text-c1 font-barlow text-lg"><?php if(strlen($recherche->termeRecherche) > 15){echo substr($recherche->termeRecherche, 0, 12) . "...";}else{echo $recherche->termeRecherche;}?></h3>
                        <div class="flex flex-row gap-x-4 items-center justify-center">
                            <div class="flex bg-c1 rounded-full justify-center items-center w-20">
                                <h3 class="text-c3 font-barlow text-md p-1 text-center">{{ $recherche->nbOccurences }}
                                </h3>
                            </div>
                            <button type="button" id="btnSuppTerme" onClick="supprimerTerme('{{ $recherche->id }}')">
                                <span class="iconify size-7 text-c1 cursor-pointer" data-icon="mdi:trash"
                                    data-inline="false"></span>
                            </button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

{{-- <script src="{{ asset('js/admin/SweetAlertSuppTerme.js') }}"></script> --}}

