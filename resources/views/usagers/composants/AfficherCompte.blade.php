<div class="mt-2">
    @if (isset($usager))
        <form method="POST" action="{{ route('usagers.modifier', $usager->id) }}">
            @csrf
            @method('PATCH')
            <div id="" class="flex flex-col space-y-5">
                <div class="space-y-5">
                    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Nom</h1>
                    <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0">
                        <div class="w-full sm:w-1/2">
                            <input id="prenom" type="text" class="w-full p-3 border rounded-lg bg-white text-c1"
                                placeholder="Prénom" value="{{ old('prenom', $usager->prenom) }}" name="prenom">
                            @if (session('erreurModifierUsager') && session('erreurModifierUsager')->has('prenom'))
                                <div class="text-c5 font-medium erreur-message">
                                    {{ session('erreurModifierUsager')->first('prenom') }}
                                </div>
                            @endif
                        </div>
                        <div class="w-full sm:w-1/2">
                            <input id="nom" type="text" class="w-full p-3 border rounded-lg bg-white text-c1"
                                placeholder="Nom" value="{{ old('nom', $usager->nom) }}" name="nom">
                            @if (session('erreurModifierUsager') && session('erreurModifierUsager')->has('nom'))
                                <div class="text-c5 font-medium erreur-message">
                                    {{ session('erreurModifierUsager')->first('nom') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-5">
                    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">Courriel & Mot de passe</h1>
                    <input id="courriel" type="email" class="w-full p-3 border rounded-lg bg-white text-c1"
                        placeholder="Courriel" value="{{ old('courriel', $usager->courriel) }}" name="courriel">
                    @if (session('erreurModifierUsager') && session('erreurModifierUsager')->has('courriel'))
                        <div class="text-c5 font-medium erreur-message">
                            {{ session('erreurModifierUsager')->first('courriel') }}
                        </div>
                    @endif
                    <div class="flex justify-end">
                        <button type="button" id="togglePasswordBtn" class="text-lg hover:White text-c1 font-barlow">
                            Modifier votre mot de passe
                        </button>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0">
                        <input id="password" type="password" class="w-full p-3 border rounded-lg bg-light-grey text-c1"
                            placeholder="Mot de passe" name="password" value="{{ old('password') }}" disabled>
                        <input id="passwordV" type="password" class="w-full p-3 border rounded-lg bg-light-grey text-c1"
                            placeholder="Confirmation du mot de passe" name="password_confirmation"
                            value="{{ old('password_confirmation') }}" disabled>
                    </div>

                    @if (session('erreurModifierUsager') && session('erreurModifierUsager')->has('password'))
                        <div class="text-c5 font-medium erreur-message">
                            {{ session('erreurModifierUsager')->first('password') }}
                        </div>
                    @endif
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

                <div
                    class="flex flex-col sm:flex-row justify-start items-end h-full sm:space-x-3 space-y-3 sm:space-y-0">
                    <button type=""
                        class="w-full text-xl lg:text-2xl rounded-full p-3 px-6 hover:bg-c3 cursor-pointer text-c5 border-2 border-c5 font-barlow">
                        Supprimer le compte
                    </button>
                    <button type="submit"
                        class="w-full text-xl lg:text-2xl rounded-full p-3 px-6 hover:bg-c3 cursor-pointer border-2 bg-white text-c1 font-barlow">
                        Enregistrer
                    </button>
                </div>
            </div>
        </form>
    @else
        <p>Utilisateur introuvable.</p>
    @endif
</div>

<script>
    document.getElementById('togglePasswordBtn').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const passwordVField = document.getElementById('passwordV');
        passwordField.style.backgroundColor = '#f0f0f0';
        passwordVField.style.backgroundColor = '#f0f0f0';

        const isDisabled = passwordField.disabled;
        passwordField.disabled = !isDisabled;
        passwordVField.disabled = !isDisabled;

        if (isDisabled) {
            this.textContent = 'Annuler';
            passwordField.value = '';
            passwordVField.value = '';
            passwordField.style.backgroundColor = '#fff';
            passwordVField.style.backgroundColor = '#fff';
        } else {
            this.textContent = 'Modifier votre mot de passe';
            passwordField.style.backgroundColor = '#f0f0f0';
            passwordVField.style.backgroundColor = '#f0f0f0';
        }
    });
</script>

