@extends('layouts.app')

@section('title', 'Zoom')

@section('contenu')

    <!-- <span class="iconify" data-icon="mdi:spy" data-inline="false"></span> -->

    <div class="@container flex flex-col w-full h-full bg-c2">
        <div class="relative size-20 w-full">
            <img class="absolute size-16 left-6 top-2" src="{{ asset('images/logos/logoC1.svg') }}">
        </div>

        <div class="flex flex-row">

        <a href="#pills-home"
            class="my-1 ml-12 p-3 w-1/4 block rounded-full pb-2 pt-2 text-sm font-medium uppercase leading-tight text-white dark:text-white/100 dark:data-[twe-nav-active]:!bg-c1 "
            id="pills-home-tab" data-twe-toggle="pill" data-twe-target="#pills-home" data-twe-nav-active role="tab"
            aria-controls="pills-home" aria-selected="true">
            Home
        </a>

        <div class="h-3/4 w-0.5 mt-1 w-full rounded ml-4 mr-12 bg-c1"></div>
        </div>

        <div class="h-full w-full flex justify-center flex-row">
            <div class="h-0.5  w-full rounded ml-12 mr-12 bg-c1"></div>
        </div>

    </div>

@endsection
