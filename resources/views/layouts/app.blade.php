<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Clientes</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    @include('partials.nav')
    <div id="app">
        @yield('content')
    </div>
</body>
</html>