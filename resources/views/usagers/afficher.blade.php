@extends('layouts.app')

@section('title', 'Compte')

@section('contenu')
    {{-- //TODO importer la navbar et le footer --}}
    <div class="flex w-full h-full bg-c2">
        <div class="flex flex-row">
            <div class="border-r-4">
                <button class="font-barlow text-sm text-c1 font-semibold" type="">COMPTE</button>
            </div>
            <div>
                <button class="font-barlow text-sm text-c1 font-semibold" type="">LIEUX</button>
            </div>
            <div>
                <button class="font-barlow text-sm text-c1 font-semibold" type="">ACTIVITÉS</button>
            </div>
        </div>
    </div>
@endsection

