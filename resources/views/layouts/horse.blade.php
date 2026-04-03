<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Türkmen Atlary - Akbulut</title>
    <link rel="shortcut icon" href="{{ asset('images/mini_logo_rounded.png') }}" type="image/png">

    @yield('css')
</head>
<body style="margin:0;padding:0;">
@yield('content')
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
@yield('js')
</html>
