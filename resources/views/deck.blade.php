@extends('layout.app')

@section('title', $deck->title)

@section('description', 'A Magic The Gathering Deck.')

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
                    {{ $deck->title }} <span style="opacity: .5;">#{{ $deck->id }}</span>
                </h1>
                <p class="subtitle">Created by Anonymus</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            Le Deck Contents
        </div>
    </section>

    @include('partials.footer')
@endsection