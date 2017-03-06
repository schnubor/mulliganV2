@extends('layout.app')

@section('title', "Home")

@section('content')
    <section class="hero is-primary is-bold is-medium">
        <!-- Hero header: will stick at the top -->
        <div class="hero-head">
            @include('partials.navigation')
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <h2 class="title">
                    Find Cards. Build Decks.
                </h2>
                <h3 class="subtitle">
                    Magic the Gathering
                </h3>
            </div>
        </div>

        <!-- Hero footer: will stick at the bottom -->
        <div class="hero-foot">
            <nav class="tabs">
                <div class="container">
                    <ul>
                        <li class="is-active"><a>Quick search</a></li>
                        <li><a>Players</a></li>
                        <li><a>Latest</a></li>
                        <li><a>Popular</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <div id="app">
        <section id="quicksearch" class="section is-medium has-text-centered">
            <Quicksearch></Quicksearch>
        </section>
    </div>

     @include('partials.footer')
@endsection
