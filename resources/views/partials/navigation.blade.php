<header class="navbar is-transparent">
    <div class="container">
        <div class="navbar-start">
            <a class="navbar-item" href="/">
                <h1><strong>Mulligan</strong></h1>
            </a>
        </div>
        <span class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </span>
        <div class="navbar-end nav-menu">
            <a href="{{ route('home') }}" class="navbar-item {{ strpos(Route::currentRouteName(), 'home') === 0 ? 'is-active' : '' }}">
                Home
            </a>
            <a href="{{ route('deckbuilder') }}" class="navbar-item {{ strpos(Route::currentRouteName(), 'deckbuilder') === 0 ? 'is-active' : '' }}">
                Deckbuilder
            </a>
            <span class="navbar-item">
                @if( Auth::check() )
                    <a class="button is-primary" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <span class="icon">
                            <i class="fa fa-sign-out"></i>
                        </span>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>
                @else
                    <a class="button is-primary" href="{{ route('login') }}">
                        <span class="icon">
                            <i class="fa fa-sign-in"></i>
                        </span>
                        <span>Login</span>
                    </a>
                @endif
            </span>
        </div>
    </div>
</header>