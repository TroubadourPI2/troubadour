@extends('layouts.Redirection')

@section('title', __('erreur429'))

@section('contenu')
    <div class="erreur-429 flex items-center justify-center h-screen overflow-hidden relative font-barlow uppercase">
        <div class="absolute inset-x-0 top-5 z-10 text-center w-fit">
            <a href="/" class="flex items-center hover:text-c3 transition text-white">
                <span class="iconify text-5xl" data-icon="ion:arrow-undo" data-inline="false"></span>
                <span class="font-bold text-3xl"> {{ __('retour') }}</span>
            </a>
        </div>

        <div class="pluieConteneur" id="pluieConteneur"></div>

        <div class="eclair"></div>

        <div class="erreurConteneur">
            <h1 class="text-4xl md:text-6xl font-extrabold drop-shadow-lg text-center">
                {{ __('erreur429') }}
            </h1>
            <p class="text-lg md:text-2xl mt-4 font-semibold drop-shadow-lg">
                {{ __('erreur429Texte') }}
            </p>
        </div>
    </div>

@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pluieConteneur = document.getElementById('pluieConteneur');
        const containeurLargeur = pluieConteneur.offsetWidth;
        const containerHauteur = pluieConteneur.offsetHeight;

        const nombreGouttes = Math.min(100, Math.floor(containeurLargeur / 10));

        for (let i = 0; i < nombreGouttes; i++) {
            CreerPluie();
        }

        function CreerPluie() {
            const goutte = document.createElement('div');
            goutte.className = 'pluie';

            const gauche = Math.floor(Math.random() * containeurLargeur);
            goutte.style.left = gauche + 'px';

            const hauteur = 15 + Math.random() * 20;
            goutte.style.height = hauteur + 'px';

            const duration = 0.8 + Math.random();
            goutte.style.animation = `pluie ${duration}s linear infinite`;
            goutte.style.animationDelay = Math.random() + 's';

            pluieConteneur.appendChild(goutte);
        }
    });
</script>
