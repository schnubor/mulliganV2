<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/app.css">
        <title>Mulligan</title>
    </head>
    <body>
        <div id="app">
            <section class="hero is-primary is-bold is-medium">
                <!-- Hero header: will stick at the top -->
                <div class="hero-head">
                    <header class="nav">
                        <div class="container">
                            <div class="nav-left">
                                <a class="nav-item" href="/">
                                    <h1><strong>Mulligan</strong></h1>
                                </a>
                            </div>
                            <span class="nav-toggle">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                            <div class="nav-right nav-menu">
                                <a class="nav-item is-active">
                                    Home
                                </a>
                                <a class="nav-item">
                                    Advanced Search
                                </a>
                                <a class="nav-item">
                                    Deck Builder
                                </a>
                                <span class="nav-item">
                                    <a class="button is-primary is-inverted">
                                        <span class="icon">
                                            <i class="fa fa-sign-in"></i>
                                        </span>
                                        <span>Login</span>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </header>
                </div>

                <!-- Hero content: will be in the middle -->
                <div class="hero-body">
                    <div class="container has-text-centered">
                        <h2 class="title">
                            Find Cards. Build Decks.
                        </h2>
                        <h3 class="subtitle">
                            Magic the Gathering
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

            <Quicksearch></Quicksearch>

            <footer class="footer">
                <div class="container">
                    <div class="content has-text-centered">
                        <p>
                            <strong>Mulligan</strong> by <a href="http://chko.org">Christian Korndoerfer</a>. The source code is licensed
                            <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
                            is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC ANS 4.0</a>.
                        </p>
                        <p>
                            <a class="icon" href="https://github.com/schnubor/mulligan">
                                <i class="fa fa-github"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </footer>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
