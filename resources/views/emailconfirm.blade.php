@extends('layout.app')

@section('content')
<section class="hero is-fullheight is-medium is-primary is-bold">
    @include('partials.navigation')
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-one-third is-offset-one-third">
                    <article class="message is-success">
                        <div class="message-header">
                            Your Email is successfully verified
                        </div>
                        <div class="message-body">
                            Click here to <a href="{{url('/login')}}"><strong>login</strong></a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection