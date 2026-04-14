<header class="topbar" id="topbar">
    <div class="container nav-shell">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark">S</span>
            <span class="brand-text">SoulMatch</span>
        </a>

        <button class="menu-toggle" id="menuToggle" aria-label="Toggle Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="nav" id="mainNav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('matches') }}">Matches</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>

        <div class="nav-utilities">
            <div class="auth-actions">
                @auth
                    <a href="{{ route('wishlist.index') }}" class="btn btn-ghost">Wishlist</a>
                    <a href="{{ route('profile', ['id' => auth()->id()]) }}" class="btn btn-ghost">My Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="btn btn-ghost">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Join Free</a>
                @endguest
            </div>
        </div>
    </div>
</header>
