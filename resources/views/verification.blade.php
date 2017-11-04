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
                            You've successfully registered
                        </div>
                        <div class="message-body">
                            An email is sent to you for verification.
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection