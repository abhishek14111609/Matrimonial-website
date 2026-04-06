@extends('layouts.app')

@section('title', 'Membership Plans | SoulMatch Matrimony')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Membership</p>
            <h1>Choose A Plan That Fits Your Journey</h1>
            <p>Upgrade for unlimited connections, direct chat, and assisted matchmaking support.</p>
        </div>
    </section>

    <section class="section section-light">
        <div class="container pricing-grid">
            <article class="price-card reveal">
                <h3>Classic</h3>
                <p class="price">Rs 2,999 <span>/ 3 months</span></p>
                <ul>
                    <li>40 Contact Views</li>
                    <li>Unlimited Interests</li>
                    <li>Basic Match Alerts</li>
                    <li>Email Support</li>
                </ul>
                <button class="btn btn-outline full" type="button">Choose Classic</button>
            </article>

            <article class="price-card featured reveal delay-1">
                <span class="tag">Most Popular</span>
                <h3>Premium</h3>
                <p class="price">Rs 5,999 <span>/ 6 months</span></p>
                <ul>
                    <li>120 Contact Views</li>
                    <li>Unlimited Chat</li>
                    <li>Priority in Search</li>
                    <li>Phone + Chat Support</li>
                </ul>
                <button class="btn btn-primary full" type="button">Choose Premium</button>
            </article>

            <article class="price-card reveal delay-2">
                <h3>Elite Assisted</h3>
                <p class="price">Rs 12,999 <span>/ 6 months</span></p>
                <ul>
                    <li>Dedicated Relationship Manager</li>
                    <li>Handpicked Introductions</li>
                    <li>Profile Verification Assistance</li>
                    <li>Weekend Consultations</li>
                </ul>
                <button class="btn btn-outline full" type="button">Talk to Expert</button>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="container section-head reveal">
            <p class="eyebrow">Need Help?</p>
            <h2>Our team can guide you to the best plan based on your preferences.</h2>
            <a href="{{ route('contact') }}" class="btn btn-primary">Contact Support</a>
        </div>
    </section>
@endsection
