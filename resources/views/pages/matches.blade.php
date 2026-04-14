@extends('layouts.app')

@section('title', 'Browse Matches | SoulMatch Matrimony')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Find Your Match</p>
            <h1>Browse Verified Brides & Grooms</h1>
            <p>Handpicked recommendations based on your profile and partner preferences.</p>
        </div>
    </section>

    <section class="section">
        <div class="container listing-layout">
            <aside class="filter-box reveal">
                <h3>Refine Search</h3>
                <form action="{{ route('matches') }}" method="GET" class="search-form-grid">
                    <label>Age Range</label>
                    <div class="inline-inputs">
                        <input type="number" name="min_age" min="18" value="{{ $minAge }}">
                        <span>to</span>
                        <input type="number" name="max_age" min="18" value="{{ $maxAge }}">
                    </div>

                    <label>Education</label>
                    <select name="education">
                        <option value="">Any</option>
                        @foreach ($educationOptions as $education)
                            <option value="{{ $education }}" @selected($selectedEducation === $education)>{{ $education }}</option>
                        @endforeach
                    </select>

                    <label>Location</label>
                    <select name="city">
                        <option value="">Any</option>
                        @foreach ($cityOptions as $city)
                            <option value="{{ $city }}" @selected($selectedCity === $city)>{{ $city }}</option>
                        @endforeach
                    </select>

                    <label>Sort By</label>
                    <select name="sort">
                        <option value="newest" @selected($selectedSort === 'newest')>Newest first</option>
                        <option value="oldest" @selected($selectedSort === 'oldest')>Oldest first</option>
                        <option value="age_asc" @selected($selectedSort === 'age_asc')>Age: Low to high</option>
                        <option value="age_desc" @selected($selectedSort === 'age_desc')>Age: High to low</option>
                    </select>

                    <button class="btn btn-primary full" type="submit">Apply Filters</button>
                </form>
            </aside>

            <div>
                <div class="result-head">
                    <h2>Showing {{ $totalMatches }} Recommended Profiles</h2>
                </div>

                <div class="match-grid">
                    @forelse ($matches as $i => $match)
                        <article class="match-card reveal delay-{{ $i % 3 }}">
                            @if (!empty($match->photo_url))
                                <img class="match-photo" src="{{ $match->photo_url }}" alt="{{ $match->name }}">
                            @else
                                <div class="avatar large">{{ strtoupper(substr($match->name, 0, 1)) }}</div>
                            @endif
                            <div>
                                <h3>{{ $match->name }}</h3>
                                <p>{{ $match->age ?? '-' }} yrs, {{ $match->height ? $match->height . ' cm' : 'N/A' }},
                                    {{ $match->education ?? 'N/A' }}</p>
                                <p class="muted">{{ $match->city ?? 'N/A' }}</p>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('profile', ['id' => $match->id]) }}" class="btn btn-outline">View</a>
                                @auth
                                    @if (auth()->id() === $match->id)
                                        <span class="btn btn-outline" aria-disabled="true">Your Profile</span>
                                    @elseif ($match->is_wishlisted)
                                        <form action="{{ route('wishlist.destroy', ['profileId' => $match->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary" type="submit">Remove Wishlist</button>
                                        </form>
                                    @else
                                        <form action="{{ route('wishlist.store', ['profileId' => $match->id]) }}"
                                            method="POST">
                                            @csrf
                                            <button class="btn btn-primary" type="submit">Add Wishlist</button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                                @endauth
                            </div>
                        </article>
                    @empty
                        <article class="match-card">
                            <div>
                                <h3>No profiles found right now</h3>
                                <p class="muted">Try changing filters or check back after new registrations.</p>
                            </div>
                        </article>
                    @endforelse
                </div>

                @if ($hasPages)
                    <div class="wizard-actions" style="margin-top: 14px;">
                        @if ($onFirstPage)
                            <span class="btn btn-outline" aria-disabled="true">Previous</span>
                        @else
                            <a class="btn btn-outline" href="{{ $previousPageUrl }}">Previous</a>
                        @endif

                        @if ($hasMorePages)
                            <a class="btn btn-primary" href="{{ $nextPageUrl }}">Next</a>
                        @else
                            <span class="btn btn-primary" aria-disabled="true">Next</span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
