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
                <label>Age Range</label>
                <div class="inline-inputs">
                    <input type="number" value="24">
                    <span>to</span>
                    <input type="number" value="32">
                </div>

                <label>Religion</label>
                <select>
                    <option>Any</option>
                    <option>Hindu</option>
                    <option>Muslim</option>
                    <option>Christian</option>
                </select>

                <label>Education</label>
                <select>
                    <option>Any</option>
                    <option>Graduate</option>
                    <option>Postgraduate</option>
                    <option>Doctorate</option>
                </select>

                <label>Location</label>
                <select>
                    <option>Any</option>
                    <option>Mumbai</option>
                    <option>Delhi</option>
                    <option>Bengaluru</option>
                    <option>Hyderabad</option>
                </select>

                <button class="btn btn-primary full" type="button">Apply Filters</button>
            </aside>

            <div>
                <div class="result-head">
                    <h2>Showing 24 Recommended Profiles</h2>
                    <select>
                        <option>Sort by Compatibility</option>
                        <option>Newest First</option>
                        <option>Recently Active</option>
                    </select>
                </div>

                <div class="match-grid">
                    @php
                        $matches = [
                            [
                                'id' => 201,
                                'name' => 'Ishita Nair',
                                'meta' => '27 yrs, 5ft 4in, MBA',
                                'location' => 'Kochi',
                            ],
                            [
                                'id' => 202,
                                'name' => 'Sarthak Jain',
                                'meta' => '30 yrs, 5ft 9in, CA',
                                'location' => 'Jaipur',
                            ],
                            [
                                'id' => 203,
                                'name' => 'Mitali Das',
                                'meta' => '26 yrs, 5ft 3in, Architect',
                                'location' => 'Kolkata',
                            ],
                            [
                                'id' => 204,
                                'name' => 'Kunal Kapoor',
                                'meta' => '31 yrs, 5ft 10in, VP Sales',
                                'location' => 'Gurugram',
                            ],
                            [
                                'id' => 205,
                                'name' => 'Ritika Singh',
                                'meta' => '28 yrs, 5ft 5in, Doctor',
                                'location' => 'Lucknow',
                            ],
                            [
                                'id' => 206,
                                'name' => 'Amit Bansal',
                                'meta' => '29 yrs, 5ft 8in, Tech Lead',
                                'location' => 'Pune',
                            ],
                        ];
                    @endphp

                    @foreach ($matches as $i => $match)
                        <article class="match-card reveal delay-{{ $i % 3 }}">
                            <div class="avatar large">{{ strtoupper(substr($match['name'], 0, 1)) }}</div>
                            <div>
                                <h3>{{ $match['name'] }}</h3>
                                <p>{{ $match['meta'] }}</p>
                                <p class="muted">{{ $match['location'] }}</p>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('profile', ['id' => $match['id']]) }}" class="btn btn-outline">View</a>
                                <button class="btn btn-primary" type="button">Connect</button>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
