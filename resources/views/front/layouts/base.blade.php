<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta name="keywords" content="KEYWORDS..."/>
    <meta name="description" content="DESCRIPTION..."/>
    <meta name="author" content="DeathGhost"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="/Front/imagesicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon-precomposed" sizes="57x57"
          href="/Front/imagesicon/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120"
          href="/Front/imagesicon/apple-touch-icon-120x120-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="196x196"
          href="/Front/imagesicon/apple-touch-icon-196x196-precomposed.png">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="{{ asset('Front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Front/css/style.css') }}"/>
    <script src="{{ asset('Front/js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('packages/layer/layer.js') }}"></script>
</head>
<body>
@yield('content')
<script src="{{ asset('Front/js/bootstrap.min.js') }}"></script>

</body>
</html>
