@extends('layout.app')

@section('title', 'Register')

@section('content')
<section class="hero is-fullheight is-medium is-primary is-bold">
    @include('partials.navigation')
    <div class="hero-body">
        <div class="container">
            <div class="columns">
                <div class="column is-one-third is-offset-one-third">
                    <div class="card">
                        <div class="card-content">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <h1 class="title has-text-grey-light has-text-centered">                
                                    <i class="fa fa-edit"></i>
                                </h1>

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" placeholder="Username" value="{{ old('name') }}" required autofocus>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        @if ($errors->has('name'))
                                            <p class="help is-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required>
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
                                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" placeholder="Password" required>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                        @if ($errors->has('password'))
                                            <p class="help is-danger">{{ $errors->first('pasword') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input id="password-confirm" type="password" class="input" name="password_confirmation" placeholder="Password again" required>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-check"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <button class="button is-primary is-medium" type="submit">
                                            Register
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
