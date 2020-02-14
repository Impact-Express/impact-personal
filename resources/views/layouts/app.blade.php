<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
    <style>.is-invalid {border: 2px solid red !important;}.invalid-feedback {color: red;}</style>
</head>
<body>
    @yield('master')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')

</body>
</html>
