<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <a href="{{ route('home') }}" class="brand footer-brand">
                <span class="brand-mark">S</span>
                <span class="brand-text">SoulMatch</span>
            </a>
            <p class="muted">A premium matrimony platform crafted for meaningful matches and family-first values.</p>
            <div class="mini-badges">
                <span>100% Profiles Screened</span>
                <span>Privacy Protected</span>
                <span>24x7 Support</span>
            </div>
        </div>

        <div>
            <h4>Explore</h4>
            <a href="{{ route('matches') }}">Browse Matches</a>
            <a href="{{ route('success') }}">Success Stories</a>
            <a href="{{ route('plans') }}">Membership Plans</a>
            <a href="{{ route('faq') }}">FAQs</a>
        </div>

        <div>
            <h4>Company</h4>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('contact') }}">Contact</a>
            <a href="{{ route('blog') }}">Blog</a>
        </div>

        <div>
            <h4>Legal</h4>
            <a href="{{ route('privacy') }}">Privacy Policy</a>
            <a href="{{ route('terms') }}">Terms & Conditions</a>
            <a href="{{ route('login') }}">Member Login</a>
        </div>
    </div>

    <div class="container footer-bottom">
        <p>Copyright {{ date('Y') }} SoulMatch Matrimony. All rights reserved.</p>
        <p>Built for demo presentation.</p>
    </div>
</footer>
