<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <title>Mulligan</title>
    </head>
    <body>

        <section class="hero is-primary is-bold">
            <!-- Hero header: will stick at the top -->
            <div class="hero-head">
                @include('partials.navigation')
            </div>

            <!-- Hero content: will be in the middle -->
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Whoops, seems like my <a href="{{ $url }}" target="_blank"><strong>source of data</strong></a> is very slow or offline.
                    </h1>
                    <p class="subtitle">Please try again later.</p>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container content">
                <p class="subtitle">For who it might concern, here is the error stacktrace:</p>
                <p class="control">
                    <textarea class="textarea" style="resize: none; height: 300px">
                        {{ $message }}
                    </textarea>
                </p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <p class="title has-text-centered" style="opacity: .4;">(╯°□°）╯︵ ┻━┻</p>
            </div>
        </section>

        @include('partials.footer');
    </body>
</html>