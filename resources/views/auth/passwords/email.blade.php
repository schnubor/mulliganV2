@extends('layout.app')

@section('title', 'Reset Password')

@section('content')
<section class="hero is-fullheight is-medium is-primary is-bold">
    @include('partials.navigation')
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-one-third is-offset-one-third">
                    <div class="card">
                        <div class="card-content">
                            <h1 class="title has-text-grey-light has-text-centered">                
                                <i class="fa fa-paper-plane-o"></i>
                            </h1>

                            @if (session('status'))
                                <article class="message is-success">
                                    <div class="message-body">
                                        {{ session('status') }}
                                    </div>
                                </article>
                            @endif

                            <form role="form" method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="Your Email address" class="form-control" name="email" value="{{ old('email') }}" required>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                        
                                        @if ($errors->has('email'))
                                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
