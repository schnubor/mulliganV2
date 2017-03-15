<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <title>Mulligan | @yield('title')</title>
        <meta name="description" content="@yield('description')">

        {{-- Social --}}
        <meta property="og:image" content="@yield('ogimage', 'https://mulligan.com/images/fb_image.jpg')">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Mulligan | @yield('title')">
        <meta property="og:description" content="@yield('description', 'Find cards and build decks for Magic the Gathering.')">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:site_name" content="mulligan.com">

    </head>
    <body>
        @yield('content')

        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>