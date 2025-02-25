<div class=" mt-2">
    @if (isset($usager))
        <form method="POST" action="{{ route('usagers.modifier', $usager->id) }}">

            @csrf
            @method('PATCH')
            <div id="" class="flex w-2/5 flex-col space-y-5">
                <div class="space-y-5">
                    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Nom</h1>
                    <div class="flex flex-row space-x-2">
                        <input id="prenom" type="text"
                            class="basis-1/2  w-full p-3 border rounded-lg bg-white text-c1" placeholder="Prénom"
                            value="{{ old('prenom', $usager->prenom) }}" name="prenom">
                        <input id="nom" type="text"
                            class=" basis-1/2 w-full p-3 border rounded-lg bg-white text-c1" placeholder="Nom"
                            value="{{ old('nom', $usager->nom) }}" name="nom">
                    </div>

                </div>
                <div class="space-y-5">
                    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Courriel & Mot de passe</h1>
                    <div class="flex flex-row space-x-2">
                        <input id="courriel" type="email" class="w-full p-3 border rounded-lg bg-white text-c1"
                            placeholder="Courriel" value="{{ old('courriel', $usager->courriel) }}" name="courriel">
                        <input id="password" type="password" class="w-full p-3 border rounded-lg bg-white text-c1"
                            placeholder="Mot de passe" name="password" value="{{ old('password', $usager->password) }}">
                    </div>

                </div>

                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Rôle</h1>
                    <div class="flex flex-row space-x-3">
                        @php
                            $roles = [1 => 'Admin', 2 => 'Utilisateur', 3 => 'Gestionnaire'];
                        @endphp

                        <h1 class="text-xl">{{ $roles[$usager->role_id] ?? 'Rôle inconnu' }}</h1>

                    </div>
                </div>

                <div class="flex justify-start items-end h-full  space-x-3">

                    <button type=""
                        class="text-xl lg:text-2xl rounded-full p-1 px-4 hover:bg-c3  cursor-pointer text-c5 border-2 border-c5  font-barlow">
                        Supprimer le compte
                    </button>
                    <button type="submit"
                        class="text-xl lg:text-2xl rounded-full p-1 px-4 hover:bg-c3  cursor-pointer border-2 bg-white text-c1 font-barlow">
                        Modifier le compte
                    </button>
                </div>
            </div>
        </form>
    @else
        <p>Utilisateur introuvable.</p>
    @endif
</div>


