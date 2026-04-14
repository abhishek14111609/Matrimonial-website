@extends('layouts.app')

@section('title', 'SoulMatch Matrimony | Find Your Perfect Life Partner')
@section('meta_description',
    'Premium matrimony platform to discover verified brides and grooms for serious
    relationships and marriage.')

@section('content')
    <section class="hero-section">
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>

        <div class="container hero-grid">
            <div class="hero-copy reveal">
                <p class="eyebrow">India\'s Trusted Matrimony Experience</p>
                <h1>Meaningful Matches for Modern Families</h1>
                <p>Discover compatible, verified profiles with advanced preferences, privacy controls, and premium
                    matchmaking support.</p>
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create Free Profile</a>
                    <a href="{{ route('matches') }}" class="btn btn-outline btn-lg">View Matches</a>
                </div>
                <div class="hero-stats">
                    <div>
                        <h3 class="counter" data-target="{{ $activeMembers }}" data-suffix="+">0</h3>
                        <p>Active Members</p>
                    </div>
                    <div>
                        <h3 class="counter" data-target="{{ $successStories }}" data-suffix="+">0</h3>
                        <p>Success Stories</p>
                    </div>
                    <div>
                        <h3 class="counter" data-target="{{ $cityCoverage }}" data-suffix="+">0</h3>
                        <p>City Coverage</p>
                    </div>
                </div>
            </div>

            <div class="search-panel reveal delay-1">
                <h3>Start Your Search</h3>
                <form class="search-form-grid" action="{{ route('matches') }}" method="GET">
                    <div>
                        <label>Age</label>
                        <div class="inline-inputs">
                            <input type="number" name="min_age" min="18" value="{{ request('min_age', 21) }}">
                            <span>to</span>
                            <input type="number" name="max_age" min="18" value="{{ request('max_age', 35) }}">
                        </div>
                    </div>
                    <div>
                        <label>City</label>
                        <select name="city">
                            <option value="">Any</option>
                            @foreach ($cityOptions as $city)
                                <option value="{{ $city }}" @selected(request('city') === $city)>{{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Education</label>
                        <select name="education">
                            <option value="">Any</option>
                            @foreach ($educationOptions as $education)
                                <option value="{{ $education }}" @selected(request('education') === $education)>{{ $education }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Sort By</label>
                        <select name="sort">
                            <option value="newest" @selected(request('sort') === 'newest')>Newest</option>
                            <option value="age_asc" @selected(request('sort') === 'age_asc')>Age: Low to high</option>
                            <option value="age_desc" @selected(request('sort') === 'age_desc')>Age: High to low</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary full">Find Matches</button>
                </form>
            </div>
        </div>
    </section>

    <section class="section section-light">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">Premium Journey</p>
                <h2>Why Families Choose SoulMatch</h2>
            </div>
            <div class="feature-grid">
                <article class="feature-card reveal">
                    <h3>Verified Profiles</h3>
                    <p>Manual and AI checks ensure high-quality, real member profiles for safer matchmaking.</p>
                </article>
                <article class="feature-card reveal delay-1">
                    <h3>Smart Compatibility</h3>
                    <p>Education, lifestyle, values, and family preferences combined for better matches.</p>
                </article>
                <article class="feature-card reveal delay-2">
                    <h3>Private & Secure</h3>
                    <p>Hide photos and contact details until you decide to connect with confidence.</p>
                </article>
                <article class="feature-card reveal delay-3">
                    <h3>Assisted Service</h3>
                    <p>Dedicated relationship managers help premium members get quality introductions.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">Top Picks</p>
                <h2>Featured Profiles</h2>
            </div>
            <div class="profile-grid">
                @forelse ($featuredProfiles as $i => $profile)
                    <article class="profile-card featured-profile-card reveal delay-{{ $i % 3 }}">
                        <a href="{{ route('profile', ['id' => $profile['id']]) }}" class="featured-profile-media">
                            @if (!empty($profile['photo']))
                                <img class="featured-profile-image" src="{{ $profile['photo'] }}"
                                    alt="{{ $profile['name'] }}">
                            @endif
                            @if (empty($profile['photo']))
                                <div class="featured-profile-fallback">{{ strtoupper(substr($profile['name'], 0, 1)) }}
                                </div>
                            @endif

                            <div class="featured-profile-overlay">
                                <h3>{{ $profile['name'] }}</h3>
                                <p>{{ $profile['age'] ?? '-' }} yrs, {{ $profile['city'] ?? 'N/A' }}</p>
                                <p>{{ $profile['profession'] ?? 'Profession not set' }}</p>
                            </div>
                        </a>

                        <a href="{{ route('profile', ['id' => $profile['id']]) }}" class="btn btn-outline full">View
                            Profile</a>
                    </article>
                @empty
                    <article class="profile-card">
                        <h3>No profiles yet</h3>
                        <p class="muted">New members will appear here once they register.</p>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section section-light">
        <div class="container process-grid">
            <div class="process-copy reveal">
                <p class="eyebrow">How It Works</p>
                <h2>Simple, Fast, Family-Friendly</h2>
                <p>Create your profile, set partner preferences, and start conversations with verified matches.</p>
            </div>
            <div class="steps">
                <div class="step reveal">
                    <span>01</span>
                    <div>
                        <h3>Create Profile</h3>
                        <p>Register in minutes with key personal and family details.</p>
                    </div>
                </div>
                <div class="step reveal delay-1">
                    <span>02</span>
                    <div>
                        <h3>Discover Matches</h3>
                        <p>Get daily recommendations tailored to your preferences.</p>
                    </div>
                </div>
                <div class="step reveal delay-2">
                    <span>03</span>
                    <div>
                        <h3>Connect & Meet</h3>
                        <p>Express interest, chat securely, and involve families confidently.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section testimonials">
        <div class="container">
            <div class="section-head reveal">
                <p class="eyebrow">Happy Couples</p>
                <h2>Stories That Started Here</h2>
            </div>
            <div class="testimonial-track" id="testimonialTrack">
                <article class="testimonial-card active">
                    <p>"We connected through SoulMatch and instantly felt aligned in values and family mindset. Married
                        within 8 months!"</p>
                    <h4>Priya & Karan, Mumbai</h4>
                </article>
                <article class="testimonial-card">
                    <p>"The profile quality is excellent. Our parents were equally involved and the process felt safe and
                        respectful."</p>
                    <h4>Megha & Arjun, Delhi</h4>
                </article>
                <article class="testimonial-card">
                    <p>"We loved the privacy controls and curated recommendations. It saved us a lot of time and effort."
                    </p>
                    <h4>Sneha & Rahul, Bengaluru</h4>
                </article>
            </div>
        </div>
    </section>

    <section class="cta-band">
        <div class="container cta-content reveal">
            <h2>Ready to Begin Your Marriage Journey?</h2>
            <p>Join thousands of families choosing a secure and modern matrimony platform.</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create Your Profile</a>
        </div>
    </section>
@endsection
