<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <title>Mulligan</title>

        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Mulligan | {{ $card->name }}" />
        <meta property="og:description" content="Details and rulings for '{{ $card->name }}'" />
        <meta property="og:image" content="{{ $card->imageUrl }}" />
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
                        {{ $card->name }} <span style="opacity: .5;">#{{ $card->multiverseid }}</span>
                    </h1>
                    <p class="subtitle">{{ $card->type }}</p>
                </div>
            </div>
        </section>

        <section class="section is-medium">
            <div class="container">
                <div class="columns">
                    <div class="column is-one-quarter">
                        <img src="{{ $card->imageUrl }}" alt="{{ $card->name }}">
                        <p class="has-text-left">Artist: {{ $card->artist }}</p>
                    </div>
                    <div class="column content">
                        @if( isset( $card->manaCost ) )
                            <p class="title">
                                {!! Helper::replaceManaIcons( $card->manaCost, false, true ) !!}
                            </p>
                            <hr>
                        @endif
                        @if( isset( $card->text ) )
                            <p class="subtitle" style="line-height: 2em;">
                                {!! nl2br(Helper::replaceManaIcons( $card->text ) ) !!}
                            </p>
                        @endif
                        @if( isset( $card->flavor ) )
                            <blockquote><em>{{ $card->flavor }}</em></blockquote>
                        @endif
                        @if( isset( $card->power ) && isset( $card->toughness ) )
                            <p>
                                <span class="title" style="padding-right: 10px;">
                                    <span class="icon is-medium">
                                        <i class="fa fa-gavel"></i>
                                    </span>
                                    <strong>{{ $card->power }}</strong>
                                </span>

                                <span class="title">
                                    <span class="icon is-medium">
                                        <i class="fa fa-shield"></i>
                                    </span>
                                    <strong>{{ $card->toughness }}</strong>
                                </span>
                            </p>
                        @endif
                        <hr>

                        @if( isset( $card->legalities ) )
                            <h3>Legalities</h3>
                            @foreach ($card->legalities as $legality)
                                @if( $legality->legality == "Legal" )
                                    <span class="tag is-success is-medium">{{ $legality->format }}</span>
                                @elseif( $legality->legality == "Restricted" )
                                    <span class="tag is-warning is-medium">{{ $legality->format }}</span>
                                @elseif( $legality->legality == "Banned" )
                                    <span class="tag is-danger is-medium">{{ $legality->format }}</span>
                                @else
                                    <span class="tag is-light is-medium">{{ $legality->format }}</span>
                                @endif
                            @endforeach
                            <hr>
                        @endif

                        @if( isset( $card->rulings ) )
                            <h3>Rulings</h3>
                            @foreach ($card->rulings as $ruling)
                                <div class="box">
                                    <div class="content">
                                        <p>
                                            {{ $ruling->text }}
                                        </p>
                                        <small>– {{ $ruling->date }}</small>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                        @endif

                        <p>
                            Set: {{ $card->setName }} ({{ $card->set }}), Multiverse ID: {{ $card->multiverseid }}
                        </p>
                        <hr>

                        <a href="{{ 'https://www.magiccardmarket.eu/Products/Singles/' . $card->setName . '/' . $card->name }}" class="button is-large is-primary is-outlined">
                            <span class="icon is-medium">
                                <i class="fa fa-shopping-cart"></i>
                            </span>
                            <span>Buy Card</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        @include('partials.footer')
    </body>
</html>