<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'eProc') }}</title>

        <!-- Scripts -->
        <script>
            Window.laravel = { csrf_token: '{ csrf_token() }' };
            var _token = '{ csrf_token() }';
        </script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <link href="{{ asset('datatables/datatables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/fontawesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/solid.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        @stack('style')
        
    </head>
    <body style="background-image: url({{ asset('img/bg.png') }})">
        @yield('content')
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}"></script>
        <script src="{{ asset('datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/notify.min.js') }}"></script>
        @stack('scripts')
    </body>
</html>
