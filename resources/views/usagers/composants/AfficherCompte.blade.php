<div class=" mt-2">
    <div id="" class="flex w-2/5 flex-col space-y-5">
        <div class="space-y-5">
            <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Nom</h1>
            <div class="flex flex-row space-x-2">
                <input id="prenom" type="text" class="basis-1/2  w-full p-3 border rounded-lg bg-white text-c1" placeholder="Prénom">
                <input id="nom" type="text" class=" basis-1/2 w-full p-3 border rounded-lg bg-white text-c1" placeholder="Nom">
            </div>
            
        </div>
        <div class="space-y-5">
            <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Courriel & Mot de passe</h1>
            <div class="flex flex-row space-x-2">
                <input id="courriel" type="email" class="w-full p-3 border rounded-lg bg-white text-c1" placeholder="Courriel">
                <input id="password" type="password" class="w-full p-3 border rounded-lg bg-white text-c1" placeholder="Mot de passe">
            </div>
            
        </div>
        
        <div class="space-y-2">
            <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Rôle</h1>
            <div class="flex flex-row space-x-3">
                <label for="role_id" class="text-xl">Gestionnaire</label>
                <input id="role_id" name="role_id" type="checkbox" class="w-5 p-3 border rounded-lg bg-white text-c1" placeholder="Mot de passe">
            </div>
        </div>
        
        <div class="flex justify-start items-end h-full">
            <button class="text-xl lg:text-2xl rounded-full p-1 px-4 hover:bg-c3  cursor-pointer text-c5 border-2 border-c5  font-barlow">
                Supprimer le compte
            </button>
        </div>
    </div>
</div>