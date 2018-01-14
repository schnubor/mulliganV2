@extends('layout.app')

@section('title', 'Home')

@section('content')
    <section class="hero is-primary is-bold is-medium home-header">
        <!-- Hero header: will stick at the top -->
        <div class="hero-head">
            @include('partials.navigation')
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <h2 class="title">
                    Deckbuilder and Catalog
                </h2>
                <h3 class="subtitle">
                    for Magic the Gathering
                </h3>
            </div>
        </div>

        <!-- Hero footer: will stick at the bottom -->
        <div class="hero-foot">
            <nav class="tabs">
                <div class="container">
                    <ul>
                        <li><a href="#quicksearch">Quick search</a></li>
                        <li><a href="#players">Players</a></li>
                        <li><a href="#latest">Latest</a></li>
                        <li><a href="#popular">Popular</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <div id="app">
        <section id="quicksearch" class="section has-text-centered">
            <Quicksearch></Quicksearch>
        </section>
        <section class="hero is-light" id="#popular">
            <div class="hero-body">
                <div class="container">
                    <h3 class="title">Popular Decks</h3>
                    <div class="columns">
                        @foreach($popularDecks as $popular)
                            @include('partials.decktile', [ 'deck' => $popular ])
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section class="section" id="#latest">
            <div class="container">
                <h3 class="title">Latest Decks</h3>
                <table class="table is-fullwidth">
                    <thead>
                        <tr>
                            <th>Colors</th>
                            <th>Title</th>
                            <th>Format</th>
                            <th>Author</th>
                            <th>Sleeved</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestDecks as $latest)
                            @include('partials.deckrow', ['deck' => $latest])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

     @include('partials.footer')
@endsection
