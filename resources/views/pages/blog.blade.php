@extends('layouts.app')

@section('title', 'Matrimony Blog | SoulMatch')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Insights & Advice</p>
            <h1>Matrimony Blog</h1>
            <p>Relationship tips, family communication guides, and wedding planning inspiration.</p>
        </div>
    </section>

    <section class="section">
        <div class="container blog-grid">
            <article class="blog-card reveal">
                <span class="chip">Guides</span>
                <h3>How to Create a Strong Matrimony Profile That Gets Quality Responses</h3>
                <p>Craft a profile that highlights personality, family values, and life goals effectively.</p>
                <a href="#">Read More</a>
            </article>
            <article class="blog-card reveal delay-1">
                <span class="chip">Family</span>
                <h3>10 Questions Families Should Discuss Before Finalizing a Match</h3>
                <p>A practical checklist to build alignment and avoid misunderstandings later.</p>
                <a href="#">Read More</a>
            </article>
            <article class="blog-card reveal delay-2">
                <span class="chip">Wedding</span>
                <h3>Smart Wedding Budget Planning for Modern Indian Couples</h3>
                <p>Balance celebration and financial goals with this simple budget approach.</p>
                <a href="#">Read More</a>
            </article>
        </div>
    </section>
@endsection
