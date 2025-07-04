<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'UMKM Kepanjen Lor') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="E-Commerce UMKM Blitar">
    <meta name="keywords" content="umkm, blitar, ecommmerce">
    <meta name="version" content="1.0.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Css -->
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet">
    <!-- Main Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/libs/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}">

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

    <div class="page-wrapper toggled">
        <!-- sidebar-wrapper -->
        <nav id="sidebar" class="sidebar-wrapper sidebar-dark">
            <div class="sidebar-content">
                @if (Auth::check() && Auth::user()->role->id == '3')
                    @include('superadmin.partials.sidebar')
                @elseif (Auth::check() && Auth::user()->role->id == '2')
                    @include('admin.partials.sidebar')
                @else
                    {{-- Optional: Fallback for other users or guests --}}
                    <p>User role not recognized</p>
                @endif
                <!-- sidebar-menu  -->
            </div>
        </nav>
        <!-- sidebar-wrapper  -->

        <!-- Start Page Content -->
        <main class="page-content bg-gray-50 dark:bg-slate-800">
            @if (Auth::check() && Auth::user()->role->id == '3')
                @include('superadmin.partials.header')
            @elseif (Auth::check() && Auth::user()->role->id == '2')
                @include('admin.partials.header')
            @else
                {{-- Optional: Fallback for other users or guests --}}
                <p>User role not recognized</p>
            @endif

            @yield('content')

            @if (Auth::check() && Auth::user()->role->id == '3')
                @include('superadmin.partials.footer')
            @elseif (Auth::check() && Auth::user()->role->id == '2')
                @include('admin.partials.footer')
            @else
                {{-- Optional: Fallback for other users or guests --}}
                <p>User role not recognized</p>
            @endif
        </main>
        <!--End page-content" -->
    </div>
    <!-- page-wrapper -->

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/apexchart.init.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/maps/world.js') }}"></script>
    <script src="{{ asset('assets/js/jsvectormap.init.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- JAVASCRIPTS -->
    @stack('modals')

    @livewireScripts
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#16a34a',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Mohon Maaf!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#dc2626',
            });
        @endif
    </script>

</body>



</html>
