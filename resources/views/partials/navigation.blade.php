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
            <a href="{{ route('home') }}" class="nav-item {{ strpos(Route::currentRouteName(), 'home') === 0 ? 'is-active' : '' }}">
                Home
            </a>
            <a href="{{ route('deckbuilder') }}" class="nav-item {{ strpos(Route::currentRouteName(), 'deckbuilder') === 0 ? 'is-active' : '' }}">
                Deckbuilder
            </a>
            <span class="nav-item">
                <a class="button is-primary">
                    <span class="icon">
                        <i class="fa fa-sign-in"></i>
                    </span>
                    <span>Login</span>
                </a>
            </span>
        </div>
    </div>
</header>