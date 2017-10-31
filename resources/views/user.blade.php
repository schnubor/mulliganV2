@extends('layout.app')

@section('title', $user->name)

@section('description', 'Explore ' . $user->name . 's decks and more on Mulligan' )

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
                    {{ $user->name }} 
                    <span style="opacity: .5;">#{{ $user->id }}</span>
                </h1>
                <p class="subtitle">
                    Signed up {{ $user->created_at->diffForHumans() }}.
                </p>
            </div>
        </div>
    </section>

    <div id="app">
        <section class="section">
            <div class="container">
                <h3 class="title">Decks</h3>
                <div class="columns">
                    @foreach($decks as $deck)
                        @include('partials.decktile', [ 'deck' => $deck ])
                    @endforeach
                </div>
            </div>
        </section>
    </div>

    @include('partials.footer')
@endsection