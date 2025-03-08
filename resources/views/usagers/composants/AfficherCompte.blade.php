<div class="mt-2">
    @if (isset($usager))
        <form method="POST" action="{{ route('usagers.modifier', $usager->id) }}">
            @csrf
            @method('PATCH')
            <div id="" class="flex flex-col space-y-5">
                <div class="space-y-5">
                    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">{{ __('prenomNom') }}</h1>
                    <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0">
                        <div class="w-full sm:w-1/2">
                            <label for=""
                                class="text-lg font-bold text-c1 uppercase font-barlow">{{ __('prenom') }}</label>
                            <input id="prenom" type="text" class="w-full p-3 border rounded-lg bg-white text-c1"
                                value="{{ old('prenom', $usager->prenom) }}" name="prenom">
                            @if (session('erreurModifierUsager') && session('erreurModifierUsager')->has('prenom'))
                                <div class="text-c5 font-medium erreur-message">
                                    {{ session('erreurModifierUsager')->first('prenom') }}
                                </div>
                            @endif
                        </div>
                        <div class="w-full sm:w-1/2">
                            <label for=""
                                class="text-lg font-bold text-c1 uppercase font-barlow">{{ __('nomF') }}</label>
                            <input id="nom" type="text" class="w-full p-3 border rounded-lg bg-white text-c1"
                                value="{{ old('nom', $usager->nom) }}" name="nom">
                            @if (session('erreurModifierUsager') && session('erreurModifierUsager')->has('nom'))
                                <div class="text-c5 font-medium erreur-message">
                                    {{ session('erreurModifierUsager')->first('nom') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">
                        {{ __('courrielMotDePasse') }}</h1>
                    <div>
                        <label for=""
                            class="text-lg font-bold text-c1 uppercase font-barlow">{{ __('courriel') }}</label>
                        <input id="courriel" type="email" class="w-full p-3 border rounded-lg bg-white text-c1"
                            value="{{ old('courriel', $usager->courriel) }}" name="courriel">
                        @if (session('erreurModifierUsager') && session('erreurModifierUsager')->has('courriel'))
                            <div class="text-c5 font-medium erreur-message">
                                {{ session('erreurModifierUsager')->first('courriel') }}
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <button type="button" id="togglePasswordBtn" class="text-lg hover:White text-c1 font-barlow">
                            {{ __('modifierMotDePasse') }}
                        </button>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0">
                        <div class="w-full">
                            <label for=""
                                class="text-lg font-bold text-c1 uppercase font-barlow">{{ __('motDePasse') }}</label>
                            <input id="password" type="password"
                                class="w-full p-3 border rounded-lg bg-light-grey text-c1" name="password" disabled>
                        </div>
                        <div class="w-full">
                            <label for=""
                                class="text-lg font-bold text-c1 uppercase font-barlow">{{ __('confirmationMotDePasse') }}</label>
                            <input id="passwordV" type="password"
                                class="w-full p-3 border rounded-lg bg-light-grey text-c1" name="passwordConfirmation"
                                disabled>
                        </div>

                    </div>
                    @if (session('erreurModifierUsager') && session('erreurModifierUsager')->has('password'))
                        <div class="text-c5 font-medium erreur-message">
                            {{ session('erreurModifierUsager')->first('password') }}
                        </div>
                    @endif

                </div>

                <div class="space-y-2">
                    <h1 class="text-2xl font-bold text-c1 uppercase font-barlow underline">{{ __('role') }}</h1>
                    <div class="flex flex-row space-x-3">
                        @php
                            $roles = [1 => __('admin'), 2 => __('utilisateur'), 3 => __('gestion')];
                        @endphp

                        <h1 class="text-xl">{{ $roles[$usager->role_id] ?? 'Rôle inconnu' }}</h1>
                    </div>
                </div>

                <div
                    class="flex flex-col sm:flex-row justify-start items-end h-full sm:space-x-3 space-y-3 sm:space-y-0">
                    <button type="button" onclick="supprimerUsager()"
                        class="w-full text-xl lg:text-2xl rounded-full p-3 px-6 hover:bg-c3 cursor-pointer text-c5 border-2 border-c5 font-barlow">
                        {{ __('supLeCompte') }}
                    </button>
                    <button type="submit"
                        class="w-full text-xl lg:text-2xl rounded-full p-3 px-6 hover:bg-c1 hover:text-c3 cursor-pointer border-2 bg-white text-c1 font-barlow">
                        {{ __('enregistrer') }}
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
            this.textContent = '{{ __('annuler') }}';
            passwordField.value = '';
            passwordVField.value = '';
            passwordField.style.backgroundColor = '#fff';
            passwordVField.style.backgroundColor = '#fff';
        } else {
            this.textContent = '{{ __('modifierMotDePasse') }}';
            passwordField.style.backgroundColor = '#f0f0f0';
            passwordVField.style.backgroundColor = '#f0f0f0';
        }
    });

    function supprimerUsager() {
        Swal.fire({
            title: Lang.get('strings.messageSupTitre'),
            text: Lang.get('strings.messageSup'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: Lang.get('strings.boutonOuiSup'),
            cancelButtonText: Lang.get('strings.annuler'),

            customClass: {
                popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
                title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
                confirmButton: 'bg-c5 hover:bg-white text-c3 hover:text-c5 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
                cancelButton: 'bg-c3 hover:bg-c1 text-c1 hover:text-c3 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                axios.patch("{{ route('usagers.suppression', $usager->id) }}", {}, {
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            Swal.fire({
                                title: Lang.get('strings.messageSup2Titre'),
                                text: Lang.get('strings.messageSup2'),
                                icon: "success",
                                customClass: {
                                    popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
                                    title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
                                    confirmButton: 'bg-c5 hover:bg-white text-c3 hover:text-c5 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl'
                                }
                            }).then(() => {
                                window.location.href = '/';
                            });
                        } else {
                            Swal.fire({
                                title: Lang.get('strings.erreur'),
                                text: Lang.get('strings.erreurGenerale'),
                                icon: "error",
                                customClass: {
                                    popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
                                    title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
                                    confirmButton: 'bg-c5 hover:bg-white text-c3 hover:text-c5 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl'
                                }
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: Lang.get('strings.erreur'),
                            text: Lang.get('strings.erreurGenerale'),
                            icon: "error",
                            customClass: {
                                popup: 'bg-c2 rounded-lg max-w-96 min-h-96',
                                title: 'text-xxl font-bold text-c1 uppercase font-barlow underline',
                                confirmButton: 'bg-c5 hover:bg-white text-c3 hover:text-c5 font-semibold py-2 px-4 rounded-full uppercase font-barlow text-xl'
                            }
                        });
                    });
            }
        });
    }
</script>
