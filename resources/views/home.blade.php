<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @hasSection('title')- @yield('title') @endif</title>

    <!-- Scripts / Styles -->
    @vite('resources/js/app.js')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/lxw2fcr.css">
</head>
<body>
    <div id="app">
        <router-view></router-view>
    </div>
</body>
</html>
