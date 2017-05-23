@extends('layout.app')

@section('title', $deck->title)

@section('description', str_limit($deck->description, $limit = 150, $end = '...'))

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
                    {{ $deck->title }} 
                    <span style="opacity: .5;">#{{ $deck->id }}</span>
                </h1>
                <p class="subtitle">
                    Created by Anonymous
                    @if($deck->wip === 1)
                        <span class="tag is-warning">WIP</span>
                    @endif
                </p>
            </div>
        </div>
    </section>

    <div id="app">
        <Deck id="{{ $deck->id }}"></Deck>
    </div>

    @include('partials.footer')
@endsection