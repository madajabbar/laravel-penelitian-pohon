<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sipunggur | {{$title}}</title>

    <link rel="stylesheet" href="{{ asset('dist/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/shared/iconly.css') }}">
    @yield('css')
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            @include('backend.layouts.header')

            <div class="content-wrapper container">
                <div class="page-heading">
                    <h3>{{$title}}</h3>
                </div>
                @yield('content')
            </div>

            @include('backend.layouts.footer')
        </div>
    </div>

    <script src="{{ asset('dist/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('dist/assets/js/app.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/horizontal-layout.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('dist/assets/extensions/jquery/jquery.min.js') }}"></script>

    <!-- Need: Apexcharts -->
    @yield('js')

</body>
</html>
