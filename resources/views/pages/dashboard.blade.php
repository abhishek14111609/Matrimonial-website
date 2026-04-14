@extends('layouts.app')

@section('title', 'Member Dashboard | SoulMatch')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Member Space</p>
            <h1>Welcome back, {{ $member->name }}</h1>
            <p>
                {{ $member->profession ?? 'Member' }} from {{ $member->city ?? 'N/A' }}.
            </p>
            @if (session('status'))
                <p class="dashboard-status">{{ session('status') }}</p>
            @endif
        </div>
    </section>

    <section class="section section-light">
        <div class="container dashboard-kpis">
            <article class="kpi-card reveal">
                <p>Profile Status</p>
                <h3>{{ $profileCompletion }}%</h3>
                <span>{{ $profileCompletion === 100 ? 'Registration complete' : 'Complete your profile for better matches' }}</span>
            </article>
            <article class="kpi-card reveal delay-1">
                <p>Profession</p>
                <h3>{{ $member->profession ?? '---' }}</h3>
                <span>{{ $member->education ?? 'Education not set' }}</span>
            </article>
            <article class="kpi-card reveal delay-2">
                <p>City</p>
                <h3>{{ $member->city ?? '---' }}</h3>
                <span>{{ $member->contact_no ?? 'Contact not set' }}</span>
            </article>
            <article class="kpi-card reveal delay-3">
                <p>Marital Status</p>
                <h3>{{ $member->marital_status ? ucfirst($member->marital_status) : '---' }}</h3>
                <span>{{ $member->height ? $member->height . ' cm' : 'Height not set' }}</span>
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
                        @forelse ($recommendedProfiles as $profile)
                            <article class="match-card">
                                <div class="avatar large">{{ strtoupper(substr($profile->name, 0, 1)) }}</div>
                                <div>
                                    <h3>{{ $profile->name }}</h3>
                                    <p>{{ $profile->dob?->age ?? '-' }} yrs,
                                        {{ $profile->height ? $profile->height . ' cm' : 'N/A' }},
                                        {{ $profile->profession ?? 'N/A' }}</p>
                                    <p class="muted">{{ $profile->city ?? 'N/A' }}</p>
                                </div>
                                <div class="card-actions">
                                    <a href="{{ route('profile', ['id' => $profile->id]) }}"
                                        class="btn btn-outline">View</a>
                                    <button class="btn btn-primary" type="button">Connect</button>
                                </div>
                            </article>
                        @empty
                            <article class="match-card">
                                <div>
                                    <h3>No recommendations yet</h3>
                                    <p class="muted">More members will appear here as they register.</p>
                                </div>
                            </article>
                        @endforelse
                    </div>
                </div>

                <div class="dash-panel reveal delay-1">
                    <div class="panel-head">
                        <h2>Recent Activity</h2>
                    </div>
                    <ul class="activity-list">
                        <li><span>Now</span> Profile completion is currently {{ $profileCompletion }}%.</li>
                        <li><span>Now</span> {{ $recommendedProfiles->count() }} profile suggestions are available for you.
                        </li>
                        <li><span>Today</span> Total member base is {{ $totalProfiles }} profiles.</li>
                        <li><span>Tip</span> Keep your profile complete to improve recommendation quality.</li>
                    </ul>
                </div>
            </div>

            <aside class="dashboard-side">
                <div class="side-card reveal">
                    <h3>Profile Completion</h3>
                    <div class="completion-ring">
                        <strong>{{ $profileCompletion }}%</strong>
                    </div>
                    <p class="muted">Keep details updated for better matching and visibility.</p>
                    <a href="{{ route('profile', ['id' => $member->id]) }}" class="btn btn-outline full">View Profile</a>
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
                    <a href="{{ route('profile', ['id' => $member->id]) }}" class="btn btn-primary full">Edit Profile</a>
                    <a href="{{ route('matches') }}" class="btn btn-outline full">Browse Matches</a>
                </div>
            </aside>
        </div>
    </section>
@endsection
