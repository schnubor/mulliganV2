@extends('layout.app')

@section('title', 'Edit Deck | '.$title )

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
                    Edit Deck
                    <span style="opacity: .5;">#{{ $id }}</span>
                </h1>
                <p class="subtitle">{{ $title }}</p>
            </div>
        </div>
    </section>

    <div id="app">
        <Deckbuilder :deckid="{{ json_encode($id) }}"></Deckbuilder>
    </div>

    @include('partials.footer')
@endsection
