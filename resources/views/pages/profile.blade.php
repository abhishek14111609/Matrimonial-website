@extends('layouts.app')

@section('title', 'Profile Details | SoulMatch Matrimony')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Profile ID: SM-{{ $id }}</p>
            <h1>{{ $profile['name'] }}</h1>
            <p>{{ $profile['age'] }} yrs | {{ $profile['location'] }} | {{ $profile['profession'] }}</p>
        </div>
    </section>

    <section class="section">
        <div class="container profile-layout">
            <div class="profile-main reveal">
                <div class="profile-banner">
                    <div class="avatar huge">{{ strtoupper(substr($profile['name'], 0, 1)) }}</div>
                    <div>
                        <h2>{{ $profile['name'] }}</h2>
                        <p>{{ $profile['profession'] }}</p>
                        <p class="muted">Last active: 2 hours ago</p>
                    </div>
                </div>

                <div class="profile-block">
                    <h3>About</h3>
                    <p>{{ $profile['about'] }}</p>
                </div>

                <div class="profile-block">
                    <h3>Personal Details</h3>
                    <div class="detail-grid">
                        <div><strong>Age:</strong> {{ $profile['age'] }} years</div>
                        <div><strong>Height:</strong> {{ $profile['height'] }}</div>
                        <div><strong>Religion:</strong> {{ $profile['religion'] }}</div>
                        <div><strong>Mother Tongue:</strong> {{ $profile['language'] }}</div>
                        <div><strong>Education:</strong> {{ $profile['education'] }}</div>
                        <div><strong>Income:</strong> {{ $profile['income'] }}</div>
                    </div>
                </div>

                <div class="profile-block">
                    <h3>Family & Lifestyle</h3>
                    <div class="detail-grid">
                        <div><strong>Family Type:</strong> Nuclear</div>
                        <div><strong>Family Values:</strong> Moderate</div>
                        <div><strong>Diet:</strong> Vegetarian</div>
                        <div><strong>Location:</strong> {{ $profile['location'] }}</div>
                    </div>
                </div>
            </div>

            <aside class="profile-side reveal delay-1">
                <div class="side-card">
                    <h3>Interested in this profile?</h3>
                    <button class="btn btn-primary full" type="button">Send Interest</button>
                    <button class="btn btn-outline full" type="button">Chat Request</button>
                    <button class="btn btn-ghost full" type="button">Shortlist</button>
                </div>

                <div class="side-card">
                    <h3>Partner Preference</h3>
                    <p>Looking for a caring, family-oriented and professionally settled life partner from similar values
                        background.</p>
                </div>

                <div class="side-card">
                    <h3>Safety Tips</h3>
                    <ul>
                        <li>Always verify profile details.</li>
                        <li>Use in-app chat before sharing contact.</li>
                        <li>Inform family before in-person meetings.</li>
                    </ul>
                </div>
            </aside>
        </div>
    </section>
@endsection
