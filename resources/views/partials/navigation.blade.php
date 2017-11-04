<header class="navbar is-transparent">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('home') }}">
                <img src="https://imgur.com/s8MADhd.png" alt="Bulma: a modern CSS framework based on Flexbox" width="112" height="28">
            </a>

            <div class="navbar-burger burger" data-target="navMenuTarget">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="navbar-end navbar-menu" id="navMenuTarget">
            <a href="{{ route('deckbuilder') }}" class="navbar-item {{ strpos(Route::currentRouteName(), 'deckbuilder') === 0 ? 'is-active' : '' }}">
                Deckbuilder
            </a>
            @unless( Auth::check() )
                <a href="{{ route('register') }}" class="navbar-item {{ strpos(Route::currentRouteName(), 'register') === 0 ? 'is-active' : '' }}">
                    Sign up
                </a>
            @endif
            <span class="navbar-item">
                @if( Auth::check() )
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link  is-active" href="/users/{{ Auth::user()->name }}">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="navbar-dropdown is-boxed">
                            <a class="navbar-item has-text-black" href="{{ route('user', Auth::user()->name) }}">
                                Your decks
                            </a>
                            <a class="navbar-item has-text-black" href="/settings">
                                Settings
                            </a>
                            
                            <hr class="navbar-divider">
                            
                            <a class="navbar-item has-text-black" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                <?php echo e(csrf_field()); ?></form>
                        </div>
                    </div>
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