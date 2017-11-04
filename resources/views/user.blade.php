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
                @if (count($decks) > 0)
                    <h3 class="title">Decks</h3>
                    <div class="columns">
                        @foreach($decks as $deck)
                            @include('partials.decktile', [ 'deck' => $deck ])
                        @endforeach
                    </div>
                @else
                    @if(Auth::user()->id == $user->id)
                        <article class="message">
                            <div class="message-body">
                                You don't have any decks yet.
                            </div>
                        </article>
                        <div>
                            <a href="{{route('deckbuilder')}}" class="button is-primary">
                                <span class="icon">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span>Add a deck</span>
                            </a>
                        </div>
                    @else
                        <article class="message">
                            <div class="message-body">
                                This user has not submitted any decks yet.
                            </div>
                        </article>
                    @endif
                @endif
            </div>
        </section>
    </div>

    @include('partials.footer')
@endsection