@extends('layouts.app')

@section('title', 'Success Stories | SoulMatch Matrimony')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Real Journeys</p>
            <h1>Success Stories from SoulMatch Couples</h1>
            <p>Heartwarming stories from families who found their perfect partner with us.</p>
        </div>
    </section>

    <section class="section">
        <div class="container story-grid">
            @php
                $stories = [
                    [
                        'couple' => 'Anjali & Nitin',
                        'city' => 'Mumbai',
                        'text' => 'Our families connected instantly and we felt aligned from the first conversation.',
                    ],
                    [
                        'couple' => 'Fatima & Aamir',
                        'city' => 'Hyderabad',
                        'text' => 'The verified profiles and safe chat gave us confidence to move forward.',
                    ],
                    [
                        'couple' => 'Rhea & Tushar',
                        'city' => 'Pune',
                        'text' =>
                            'We wanted a modern yet value-based match, and SoulMatch helped us find exactly that.',
                    ],
                    [
                        'couple' => 'Sonal & Dhruv',
                        'city' => 'Ahmedabad',
                        'text' =>
                            'Great recommendations and a respectful community made the process smooth for both families.',
                    ],
                ];
            @endphp

            @foreach ($stories as $i => $story)
                <article class="story-card reveal delay-{{ $i % 3 }}">
                    <h3>{{ $story['couple'] }}</h3>
                    <p class="muted">{{ $story['city'] }}</p>
                    <p>{{ $story['text'] }}</p>
                </article>
            @endforeach
        </div>
    </section>
@endsection
