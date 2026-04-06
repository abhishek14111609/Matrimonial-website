@extends('layouts.app')

@section('title', 'Member Dashboard | SoulMatch')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Member Space</p>
            <h1>Welcome back, Priya</h1>
            <p>Your daily dashboard with fresh matches, interests, and profile insights.</p>
        </div>
    </section>

    <section class="section section-light">
        <div class="container dashboard-kpis">
            <article class="kpi-card reveal">
                <p>New Matches Today</p>
                <h3>18</h3>
                <span>+4 from yesterday</span>
            </article>
            <article class="kpi-card reveal delay-1">
                <p>Interests Received</p>
                <h3>9</h3>
                <span>3 shortlisted</span>
            </article>
            <article class="kpi-card reveal delay-2">
                <p>Profile Views</p>
                <h3>124</h3>
                <span>Strong visibility this week</span>
            </article>
            <article class="kpi-card reveal delay-3">
                <p>Match Score Trend</p>
                <h3>92%</h3>
                <span>Based on preference completion</span>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="container dashboard-grid">
            <div class="dashboard-main">
                <div class="dash-panel reveal">
                    <div class="panel-head">
                        <h2>Top Recommended Matches</h2>
                        <a href="{{ route('matches') }}">See all</a>
                    </div>
                    <div class="match-grid">
                        <article class="match-card">
                            <div class="avatar large">R</div>
                            <div>
                                <h3>Ritvik Malhotra</h3>
                                <p>29 yrs, 5ft 10in, Product Manager</p>
                                <p class="muted">Gurugram | Match score 96%</p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-outline" type="button">View</button>
                                <button class="btn btn-primary" type="button">Connect</button>
                            </div>
                        </article>
                        <article class="match-card">
                            <div class="avatar large">A</div>
                            <div>
                                <h3>Arjun Iyer</h3>
                                <p>31 yrs, 5ft 9in, Consultant</p>
                                <p class="muted">Bengaluru | Match score 93%</p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-outline" type="button">View</button>
                                <button class="btn btn-primary" type="button">Connect</button>
                            </div>
                        </article>
                        <article class="match-card">
                            <div class="avatar large">K</div>
                            <div>
                                <h3>Karan Joshi</h3>
                                <p>30 yrs, 5ft 11in, Architect</p>
                                <p class="muted">Pune | Match score 91%</p>
                            </div>
                            <div class="card-actions">
                                <button class="btn btn-outline" type="button">View</button>
                                <button class="btn btn-primary" type="button">Connect</button>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="dash-panel reveal delay-1">
                    <div class="panel-head">
                        <h2>Recent Activity</h2>
                    </div>
                    <ul class="activity-list">
                        <li><span>10:30 AM</span> You received an interest from Neha S.</li>
                        <li><span>09:10 AM</span> Your profile was viewed by 12 members.</li>
                        <li><span>Yesterday</span> Relationship manager shared 4 curated profiles.</li>
                        <li><span>Yesterday</span> You shortlisted 2 potential matches.</li>
                    </ul>
                </div>
            </div>

            <aside class="dashboard-side">
                <div class="side-card reveal">
                    <h3>Profile Completion</h3>
                    <div class="completion-ring">
                        <strong>82%</strong>
                    </div>
                    <p class="muted">Add horoscope and family details to boost visibility.</p>
                    <button class="btn btn-outline full" type="button">Complete Profile</button>
                </div>

                <div class="side-card reveal delay-1">
                    <h3>Today Tasks</h3>
                    <ul>
                        <li>Respond to 3 pending interests</li>
                        <li>Update preferred city filters</li>
                        <li>Verify contact preferences</li>
                    </ul>
                </div>

                <div class="side-card reveal delay-2">
                    <h3>Quick Actions</h3>
                    <a href="{{ route('plans') }}" class="btn btn-primary full">Upgrade Plan</a>
                    <a href="{{ route('matches') }}" class="btn btn-outline full">Browse Matches</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
