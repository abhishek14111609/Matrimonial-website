@extends('layouts.app')

@section('title', 'FAQs | SoulMatch Matrimony')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">Frequently Asked Questions</p>
            <h1>Everything You Need To Know</h1>
        </div>
    </section>

    <section class="section">
        <div class="container faq-list">
            <details class="faq-item reveal" open>
                <summary>Is registration free?</summary>
                <p>Yes, basic profile creation and browsing are free. Premium plans unlock advanced features.</p>
            </details>
            <details class="faq-item reveal delay-1">
                <summary>How are profiles verified?</summary>
                <p>We use document checks, mobile verification, and AI quality filters for profile trust.</p>
            </details>
            <details class="faq-item reveal delay-2">
                <summary>Can I hide my profile and photos?</summary>
                <p>Yes, privacy settings allow you to control who can view your details and photos.</p>
            </details>
            <details class="faq-item reveal">
                <summary>Do you offer assisted matchmaking?</summary>
                <p>Yes, our Elite Assisted plan provides a relationship manager for curated introductions.</p>
            </details>
        </div>
    </section>
@endsection
