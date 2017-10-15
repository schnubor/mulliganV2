@extends('layout.app')

@section('title', 'Login')

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
                                <i class="fa fa-lock"></i>
                            </h1>
                            <form role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('email'))
                                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" type="password" placeholder="Password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('password'))
                                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <a href="{{ route('password.request') }}" class="is-size-7 has-text-grey-light">Forgot Your Password?</a>
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <label class="checkbox">
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            Remember me
                                        </label>
                                    </div>
                                </div>

                                <div class="field">
                                    <button class="button is-primary is-medium" type="submit">
                                        <span class="icon">
                                            <i class="fa fa-sign-in"></i>
                                        </span>
                                        <span>Login</span>
                                    </button>
                                </div>


                                
                            </form>
                        </div>
                        <footer class="card-footer">
                            <p class="card-footer-item">
                                <span>
                                    <a href="/register">Not a member yet? Sign up here.</a>
                                </span>
                            </p>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
