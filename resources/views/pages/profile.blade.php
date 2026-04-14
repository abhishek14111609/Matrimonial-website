@extends('layouts.app')

@section('title', 'Profile Details | SoulMatch Matrimony')

@section('content')
    <section class="inner-hero profile-hero">
        <div class="container">
            <p class="eyebrow">Profile ID: SM-{{ $id }}</p>
            <h1>{{ $profile['name'] }}</h1>
            <p class="profile-hero-meta">
                @if (!empty($profile['age']))
                    {{ $profile['age'] }} yrs |
                @endif
                {{ $profile['location'] }} | {{ $profile['profession'] }}
            </p>
            @if (!empty($profile['contact_no']))
                <div class="profile-contact-strip">
                    <span>Contact No</span>
                    <strong>{{ $profile['contact_no'] }}</strong>
                </div>
            @endif
            @if (session('status'))
                <p class="dashboard-status">{{ session('status') }}</p>
            @endif
        </div>
    </section>

    <section class="section profile-scene">
        <div class="container profile-layout">
            <div class="profile-main reveal">
                <div class="profile-banner">
                    @if (!empty($profile['photo']))
                        <img class="profile-photo" src="{{ $profile['photo'] }}" alt="{{ $profile['name'] }}">
                    @else
                        <div class="avatar huge">{{ strtoupper(substr($profile['name'], 0, 1)) }}</div>
                    @endif
                    <div class="profile-identity">
                        <h2>{{ $profile['name'] }}</h2>
                        <p class="profile-role">{{ $profile['profession'] }}</p>
                        <div class="profile-chips">
                            @if (!empty($profile['age']))
                                <span>{{ $profile['age'] }} yrs</span>
                            @endif
                            <span>{{ $profile['location'] }}</span>
                            @if (!empty($profile['marital_status']))
                                <span>{{ $profile['marital_status'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="profile-block">
                    <h3>About</h3>
                    <p>{{ $profile['about'] }}</p>
                </div>

                <div class="profile-block">
                    <h3>Personal Details</h3>
                    <div class="detail-grid">
                        @if (!empty($profile['age']))
                            <div><strong>Age</strong> {{ $profile['age'] }} years</div>
                        @endif
                        @if (!empty($profile['dob']))
                            <div><strong>DOB</strong> {{ $profile['dob'] }}</div>
                        @endif
                        @if (!empty($profile['time_of_dob']))
                            <div><strong>Time of DOB</strong> {{ $profile['time_of_dob'] }}</div>
                        @endif
                        @if (!empty($profile['gender']))
                            <div><strong>Gender</strong> {{ $profile['gender'] }}</div>
                        @endif
                        @if (!empty($profile['height']))
                            <div><strong>Height</strong> {{ $profile['height'] }}</div>
                        @endif
                        @if (!empty($profile['weight']))
                            <div><strong>Weight</strong> {{ $profile['weight'] }}</div>
                        @endif
                        @if (!empty($profile['education']))
                            <div><strong>Education</strong> {{ $profile['education'] }}</div>
                        @endif
                        @if (!empty($profile['contact_no']))
                            <div><strong>Contact</strong> {{ $profile['contact_no'] }}</div>
                        @endif
                        @if (!empty($profile['marital_status']))
                            <div><strong>Marital Status</strong> {{ $profile['marital_status'] }}</div>
                        @endif
                        @if (!empty($profile['address']))
                            <div><strong>Address</strong> {{ $profile['address'] }}</div>
                        @endif
                    </div>
                </div>

                <div class="profile-block">
                    <h3>Family & Lifestyle</h3>
                    <div class="detail-grid">
                        @if (!empty($profile['father_name']))
                            <div><strong>Father</strong> {{ $profile['father_name'] }}
                                ({{ $profile['father_occupation'] }})</div>
                        @endif
                        @if (!empty($profile['mother_name']))
                            <div><strong>Mother</strong> {{ $profile['mother_name'] }}
                                ({{ $profile['mother_occupation'] }})</div>
                        @endif
                        @if (!empty($profile['siblings']))
                            <div class="span-2">
                                <strong>Siblings</strong>
                                <ul class="profile-list">
                                    @foreach ($profile['siblings'] as $sibling)
                                        <li>
                                            {{ $sibling['name'] ?? $sibling }}
                                            @if (!empty($sibling['occupation']))
                                                - {{ $sibling['occupation'] }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (!empty($profile['maternal_relatives']))
                            <div><strong>Mother Side Relative</strong> {{ $profile['maternal_relatives'] }}</div>
                        @endif
                        <div><strong>Location</strong> {{ $profile['location'] }}</div>
                    </div>
                </div>
            </div>

            <aside class="profile-side reveal delay-1">
                <div class="side-card wishlist-card">
                    <h3>Save this profile</h3>
                    @if (!empty($profile['contact_no']))
                        <p class="contact-focus">Contact: {{ $profile['contact_no'] }}</p>
                    @endif
                    @auth
                        @if ($isOwnProfile)
                            <button class="btn btn-outline full" type="button" disabled>Your profile</button>
                        @elseif ($isWishlisted)
                            <form action="{{ route('wishlist.destroy', ['profileId' => $id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline full" type="submit">Remove from Wishlist</button>
                            </form>
                        @else
                            <form action="{{ route('wishlist.store', ['profileId' => $id]) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary full" type="submit">Add to Wishlist</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary full">Login to add Wishlist</a>
                    @endauth
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
