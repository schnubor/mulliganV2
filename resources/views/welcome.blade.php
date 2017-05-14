@extends('layout.app')

@section('title', 'Home')

@section('content')
    <section class="hero is-primary is-bold is-medium home-header">
        <!-- Hero header: will stick at the top -->
        <div class="hero-head">
            @include('partials.navigation')
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-centered">
                <h2 class="title">
                    Deckbuilder and Catalog
                </h2>
                <h3 class="subtitle">
                    for Magic the Gathering
                </h3>
            </div>
        </div>

        <!-- Hero footer: will stick at the bottom -->
        <div class="hero-foot">
            <nav class="tabs">
                <div class="container">
                    <ul>
                        <li class="is-active"><a>Quick search</a></li>
                        <li><a>Players</a></li>
                        <li><a>Latest</a></li>
                        <li><a>Popular</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <div id="app">
        <section id="quicksearch" class="section has-text-centered">
            <Quicksearch></Quicksearch>
        </section>
        <section class="hero is-light">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-3">
                            <div class="card">
                                <header class="card-header">
                                    <p class="card-header-title">
                                        Mardu Vehicle adhadkahda dkah akhda kdhak hdka 
                                    </p>
                                    <a class="card-header-icon">
                                        10
                                        <span class="icon is-small" style="margin-left: 5px;">
                                            <i class="fa fa-fw fa-heart"></i>
                                        </span>
                                    </a>
                                </header>
                                <div class="card-content">
                                    <div class="content">
                                        by <a href="">schnubor</a> <br/>
                                        <small>submitted 11:09 PM - 1 Jan 2016</small>
                                    </div>
                                </div>
                                <footer class="card-footer">
                                    <a class="card-footer-item">
                                        <span class="has-text-centered">
                                            <span class="ms ms-cost ms-r"></span>
                                            <span class="ms ms-cost ms-w"></span>
                                            <span class="ms ms-cost ms-g"></span>
                                            <span class="ms ms-cost ms-u"></span>
                                            <span class="ms ms-cost ms-b"></span>
                                        </span>
                                    </a>
                                    <a class="card-footer-item">View</a>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

     @include('partials.footer')
@endsection
