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
            <a href="{{ route('plans') }}">Plans</a>
            <a href="{{ route('success') }}">Success Stories</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('contact') }}">Contact</a>
        </nav>

        <div class="nav-utilities">
            <div class="notif-wrap" id="notifWrap">
                <button class="notif-btn" id="notifToggle" aria-label="Open notifications" aria-expanded="false"
                    type="button">
                    <span class="notif-icon" aria-hidden="true">&#128276;</span>
                    <span class="notif-badge">3</span>
                </button>

                <div class="notif-panel" id="notifPanel" role="dialog" aria-label="Notifications">
                    <div class="notif-head">
                        <h4>Notifications</h4>
                        <span>3 new</span>
                    </div>
                    <ul>
                        <li>
                            <strong>New Interest</strong>
                            <p>Ritvik Malhotra sent you an interest.</p>
                            <small>2 min ago</small>
                        </li>
                        <li>
                            <strong>Profile Viewed</strong>
                            <p>Your profile was viewed by 11 members today.</p>
                            <small>25 min ago</small>
                        </li>
                        <li>
                            <strong>Match Alert</strong>
                            <p>4 highly compatible profiles are waiting.</p>
                            <small>1 hour ago</small>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="auth-actions">
                <a href="{{ route('login') }}" class="btn btn-ghost">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Join Free</a>
            </div>
        </div>
    </div>
</header>
