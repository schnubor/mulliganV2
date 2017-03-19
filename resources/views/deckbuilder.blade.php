@extends('layout.app')

@section('title', 'Deckbuilder')

@section('description', 'Build your own Magic The Gathering Deck now.')

@section('content')
    <section class="hero is-primary is-bold">
        <!-- Hero header: will stick at the top -->
        <div class="hero-head">
            @include('partials.navigation')
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Deckbuilder
                </h1>
                <p class="subtitle">Create a new deck.</p>
            </div>
        </div>
    </section>

    <div id="app">
        <Deckbuilder></Deckbuilder>
    </div>

    @include('partials.footer')
@endsection
