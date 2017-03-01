<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <title>Mulligan | @yield('title')</title>
        <meta name="description" content="@yield('description')">
        @yield('og_tags')
    </head>
    <body>
        @yield('content')

        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>