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
                                <i class="fa fa-undo"></i>
                            </h1>

                            @if (session('status'))
                                <article class="message is-success">
                                    <div class="message-body">
                                        {{ session('status') }}
                                    </div>
                                </article>
                            @endif

                            <form role="form" method="POST" action="{{ route('password.request') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" placeholder="Your Email address" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>

                                        @if ($errors->has('email'))
                                            <p class="help is-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" placeholder="New Password" type="password" class="form-control" name="password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>

                                        @if ($errors->has('password'))
                                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="password-confirm" class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" placeholder="New Password again" type="password" class="form-control" name="password_confirmation" required>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-check"></i>
                                        </span>

                                        @if ($errors->has('password_confirmation'))
                                            <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button is-primary">
                                            Reset Password
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
