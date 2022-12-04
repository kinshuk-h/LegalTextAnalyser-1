<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>LTA</title>

        <!-- Icon Font Css -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <!-- AOS -->
        <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.css" />
        <script src="https://cdn.rawgit.com/michalsnik/aos/2.0.1/dist/aos.js"></script>
        {{-- CSS Stylesheets --}}
        <link href="{{ Vite::asset('resources/css/app.css') }}" rel="stylesheet">
        <link href="{{ Vite::asset('resources/css/toppage.css') }}" rel="stylesheet">
        <style>
            *{
                font-size: 0.9rem;
            }
        </style>
        @stack('styles')
    </head>
    <body class="has-background-white">
        
        <x-header />

        <div style="min-height: 100vh">
            @yield('content')
        </div>

        <x-footer />

        <script src="{{ Vite::asset('resources/js/navbar.js') }}"></script>
        <script src="{{ Vite::asset('resources/js/toparrowpage.js') }}"></script>
        
    </body>
</html>