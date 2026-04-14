@extends('layouts.app')

@section('title', 'My Wishlist | SoulMatch')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Saved Profiles</p>
            <h1>My Wishlist</h1>
            <p>Profiles you have saved for later review.</p>
            @if (session('status'))
                <p class="dashboard-status">{{ session('status') }}</p>
            @endif
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="match-grid">
                @forelse ($profiles as $profile)
                    <article class="match-card reveal">
                        <div class="avatar large">{{ strtoupper(substr($profile->name, 0, 1)) }}</div>
                        <div>
                            <h3>{{ $profile->name }}</h3>
                            <p>{{ $profile->dob?->age ?? '-' }} yrs, {{ $profile->education ?? 'N/A' }}</p>
                            <p class="muted">{{ $profile->city ?? 'N/A' }} | {{ $profile->profession ?? 'N/A' }}</p>
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('profile', ['id' => $profile->id]) }}" class="btn btn-outline">View</a>
                            <form action="{{ route('wishlist.destroy', ['profileId' => $profile->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">Remove</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <article class="match-card">
                        <div>
                            <h3>No profiles in wishlist</h3>
                            <p class="muted">Browse matches and add profiles to your wishlist.</p>
                            <a href="{{ route('matches') }}" class="btn btn-outline">Browse Matches</a>
                        </div>
                    </article>
                @endforelse
            </div>
        </div>
    </section>
@endsection
