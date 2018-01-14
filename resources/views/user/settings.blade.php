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
                    Settings
                </p>
            </div>
        </div>
    </section>

    <div id="app">
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-one-third is-offset-one-third">
                        <div class="box is-centered">
                            {{--  <section class="section">
                                <figure class="image is-128x128" style="border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                    <img src="http://share.moltendorf.net/Pictures/Avatar/Doge/Doge-Lovers.png" alt="{{ $user->name }}">
                                </figure>
                            </section>  --}}
                            @if(Session::has('password_edit_success'))
                                <div class="notification is-success">
                                    {{ Session::get('password_edit_success') }}
                                </div>
                            @elseif(Session::has('password_edit_error'))
                                <div class="notification is-danger">
                                    {{ Session::get('password_edit_error') }}
                                </div>
                            @elseif(Session::has('password_edit_db_error'))
                                <div class="notification is-danger">
                                    {{ Session::get('password_edit_db_error') }}
                                </div>
                            @endif
                            {!! Form::model(Auth::user(), ['route' => 'editpassword', 'files' => true, 'class' => 'form']) !!}
                                {{--  <div class="field">
                                    <p class="has-text-centered">
                                        <strong>Change Avatar</strong>
                                    </p>
                                </div>
                                <div class="file has-name">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="resume">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fa fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                            Choose a file…
                                            </span>
                                        </span>
                                        <span class="file-name">
                                            Screen Shot 2017-07-29 at 15.54.25.png
                                        </span>
                                    </label>
                                </div>
                                <hr>  --}}
                                <div class="field">
                                    <p class="has-text-centered">
                                        <strong>Change Password</strong>
                                    </p>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        {!! Form::password('old', ['class' => 'input', 'placeholder' => 'Current Password']) !!}
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        {!! Form::password('new', ['class' => 'input', 'placeholder' => 'New Password']) !!}
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        {!! Form::password('confirm', ['class' => 'input', 'placeholder' => 'New Password Again']) !!}
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control has-text-centered">
                                        {!! Form::submit('Update', array('class' => 'button is-primary is-medium')) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('partials.footer')
@endsection