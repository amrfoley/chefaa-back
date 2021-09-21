<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid justify-content-center">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="chefaa logo" height="40px" class="d-inline-block align-text-top" />
                </a>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <!-- The sidebar -->
                        @include('layouts.side-bar')
                    </div>
                    <div class="col-md-10">
                        <!-- flash messages -->
                        @include('layouts.flash-messages')    
                        <!-- content -->
                        @yield('content')
                    </div>
                </div>
            </div>                    
        </main>

        <footer>            
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
        </footer>
    </div>
</body>
</html>
