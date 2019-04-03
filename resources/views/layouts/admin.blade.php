<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') - BGHMC | PAMS </title> 
    <link rel="icon" href="../bghmc.png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sb-admin.js') }}" defer></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}" defer></script>
    <script src="{{ asset('js/datatables.js') }}" defer></script>
    <script src="{{ asset('js/datatables4.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<style>

    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }  
   
</style>
    @stack('styles')
</head>
<body id="page-top">
    <div id="app">
        <main>
            @yield('content') 
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <!--<a class="scroll-to-top rounded" href="#page-top">
                            <i class="fas fa-angle-up"></i>
                        </a> -->
                    </div>
                </div>           
          </footer>      
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
