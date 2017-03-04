@extends('layout.app')

@section('title', "Error")

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
@endsection