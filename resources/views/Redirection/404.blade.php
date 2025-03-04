@extends('layouts.Redirection')

@section('title', __('erreur404'))

@section('contenu')

    <div class="flex items-center justify-center h-screen overflow-hidden relative font-barlow">

        <div class="absolute inset-x-0 top-5 z-10 text-center w-fit ">
            <a href="/" class="flex items-center hover:text-c3  transition text-c1">
                <span class="iconify text-5xl  " data-icon="ion:arrow-undo" data-inline="false"></span>
                <span class="font-bold text-3xl"> {{ __('retour') }}</span>
            </a>
        </div>

        <div class="text-center z-10">
            <h1 class=" text-4xl md:text-6xl font-extrabold text-c1 drop-shadow-lg">
                {{ __('erreur404') }}
            </h1>
            <p class=" text-lg md:text-2xl mt-4 text-c1 font-semibold drop-shadow-lg">
                {{ __('erreur404Texte') }}
            </p>
        </div>

        <svg class="nuage" viewBox="0 0 64 32">
            <ellipse cx="32" cy="16" rx="20" ry="10" fill="#ffffff" />
            <ellipse cx="20" cy="18" rx="12" ry="8" fill="#ffffff" />
            <ellipse cx="44" cy="18" rx="12" ry="8" fill="#ffffff" />
        </svg>
        <svg class="nuage" viewBox="0 0 64 32">
            <ellipse cx="32" cy="16" rx="20" ry="10" fill="#ffffff" />
            <ellipse cx="20" cy="18" rx="12" ry="8" fill="#ffffff" />
            <ellipse cx="44" cy="18" rx="12" ry="8" fill="#ffffff" />
        </svg>
        <svg class="nuage" viewBox="0 0 64 32">
            <ellipse cx="32" cy="16" rx="20" ry="10" fill="#ffffff" />
            <ellipse cx="20" cy="18" rx="12" ry="8" fill="#ffffff" />
            <ellipse cx="44" cy="18" rx="12" ry="8" fill="#ffffff" />
        </svg>

        <svg class="montgolfiere" viewBox="0 0 100 150">
            <ellipse cx="50" cy="45" rx="30" ry="40" fill="#154C51" />
            <rect x="40" y="90" width="20" height="15" fill="#8B4513" />
            <line x1="40" y1="90" x2="50" y2="70" stroke="black" />
            <line x1="60" y1="90" x2="50" y2="70" stroke="black" />
        </svg>

    </div>
