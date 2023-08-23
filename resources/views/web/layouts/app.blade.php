<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $setting['site_name'] }}</title>
    <meta name="title" content="{{ $setting['site_name'] }}">
    <meta name="description" content="{{ $setting['site_name'] }}">
    <meta name="keywords" content="" />
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="author" content="{{ $setting['site_name'] }}">
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $setting['site_name'] }}" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="{{ $setting['site_name'] }}" />
    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <!-- Styles -->
{{--    <link rel="icon" href="https://suntech.edu.vn/assets/img/logo.png" />--}}
{{--    <link rel="canonical" href="https://suntech.edu.vn/the-links-trong-html.sunpost.html" />--}}

    <link type='image/x-icon' href='{{ asset('images/favicon.ico') }}' rel='icon'/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('link')
</head>
<body>
    @yield('page')
    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <!-- Scripts -->
    @yield('script')
</body>
</html>
