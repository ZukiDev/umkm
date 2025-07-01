<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'UMKM Blitar') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="E-Commerce UMKM Kec. Kepanjen Lor">
    <meta name="keywords" content="umkm, Kepanjen Lor, Blitar, ecommmerce">
    <meta name="version" content="1.0.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('asset/images/favicon.ico') }}">

    <!-- Css -->
    <link href="{{ asset('asset/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <!-- Main Css -->
    <link href="{{ asset('asset/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('asset/libs/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('asset/css/tailwind.css') }}">

    @livewireStyles
</head>

<body class="font-nunito text-base text-black dark:text-white dark:bg-slate-900">
    <!-- Loader Start -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader End -->

    @include('customer.partials.navbar')

    @yield('content')

    @include('customer.partials.footer')

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top"
        class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 end-5 size-9 text-center bg-indigo-600 text-white leading-9"><i
            class="uil uil-arrow-up"></i></a>
    <!-- Back to top -->

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('asset/libs/shufflejs/shuffle.min.js') }}"></script>
    <script src="{{ asset('asset/libs/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('asset/libs/tiny-slider/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('asset/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins.init.js') }}"></script>
    <script src="{{ asset('asset/js/app.js') }}"></script>
    <!-- JAVASCRIPTS -->
    @stack('modals')

    @livewireScripts
</body>

</html>
