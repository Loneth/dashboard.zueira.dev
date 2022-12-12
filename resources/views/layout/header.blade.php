<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - {{ strip_tags(config('app.title', 'Home')) }}</title>
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:description" content="{{ config('app.description') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images') }}/favico.ico" />
    <link href="{{ asset('assets/css') }}/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css') }}/style.css?{{ rand(1, 100) }}" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/8bda4be3da.js" crossorigin="anonymous"></script>
    @stack('css')
</head>

<body>
    <div class="container-fluid">
        @yield('content')
    </div>
    <script src="{{ asset('assets/js') }}/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
