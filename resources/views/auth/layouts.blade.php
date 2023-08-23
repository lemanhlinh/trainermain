<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Finalstyle - Phong Cách Số') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/web/style.css') }}">
</head>
<body>
<div id="app">
    <div class="content">
        @yield('content')
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('js/web/main.js') }}" defer></script>
</body>
</html>
