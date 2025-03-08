<div class="flex w-full h-full flex-col mb-4 font-barlow">
    <div class="flex gap-x-2 w-full flex-col md:flex-row gap-y-2 md:gap-y-0">

        <select id="rechercheRole" class="rounded-full border-2 w-full lg:w-1/2 border-c1 p-2">
            <option value="">{{ __('tousLesRoles') }}</option>
        </select>
        <select id="rechercheStatut" class="rounded-full border-2 w-full lg:w-1/2 border-c1 p-2">
            <option value="">{{ __('tousLesStatuts') }}</option>
        </select>
        <input type="text" id="rechercheTexte" class="rounded-full border-2 w-full lg:w-1/2 border-c1 p-2"
            placeholder="{{ __('rechercheAdminDemande') }}">
    </div>
  
    <div class="flex w-full flex-col justify-center items-center">
        <div id="pagination" class="mt-4 max-w-7xl w-full flex justify-center items-center gap-x-2"></div>
        <div class="flex justify-end w-full max-w-7xl py-4">
            <label for="usagersParPage" class="mr-2 font-bold text-lg">{{ __('afficher') }}</label>
            <select id="usagersParPage" class="rounded border-2 p-1">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div id="labelTableau" class="border-2 bg-c3 border-c1 flex max-w-7xl w-full h-14 justify-center items-center z-10 sticky text-c1 top-0">
            <div class="flex w-1/4 lg:pl-12 justify-center font-bold text-lg lg:text-xl uppercase items-center">{{ __('role') }}</div>
            <div class="flex w-1/6 justify-center font-bold text-lg lg:text-xl uppercase items-center">{{ __('statut') }}</div>
            <div class="flex w-2/4 justify-center font-bold text-lg lg:text-xl uppercase items-center">{{ __('courriel') }}</div>
            <div class="flex w-1/4 justify-center font-bold text-lg lg:text-xl uppercase items-center">{{ __('action') }}</div>
        </div>
        <div id="usagersContainer" class="flex justify-center flex-col w-full items-center gap-y-4"></div>
    </div>
  </div>
  
  <script>

  </script>
  