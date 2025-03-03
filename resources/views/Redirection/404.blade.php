<script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{ asset('js/translations.js') }}"></script>
<!-- <link rel="icon" type="image/png" href="https://www.v3r.net/wp-content/uploads/2023/06/favicon.png" /> -->
<title>{{ __('erreur404') }}</title>
<body data-locale="{{ session('locale', config('app.locale')) }}">
    

<div class="w-full">
    <div class="absolute inset-x-0 z-10">
        <a href="/" class="">
            <span class="iconify size-10" data-icon="ion:arrow-undo" data-inline="false"></span>

        </a>
    </div>
    <div class="relative h-screen flex flex-col items-center justify-center overflow-hidden ">

        <span class="text-md md:text-2xl lg:text-4xl font-bold"> {{ __('erreur404Texte') }}</span>
    </div>

</div>
</body>