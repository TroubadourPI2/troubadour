<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    @vite('resources/css/Redirection.css')
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@400;600;700&display=swap"
        rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon"  href="{{asset('Images/Logos/logo.svg')}}" />
</head>

<body data-locale="{{ session('locale', config('app.locale')) }}">
    <header>

        @yield('header')

    </header>

    <main class=" w-full ">
        @yield('contenu')

    </main>
    @yield('footer')
    <footer>

    </footer>
</body>
<script src="{{ asset('js/translations.js') }}"></script>
<script src="{{ asset('js/Redirection/Yeux.js') }}" defer></script>

</html>
