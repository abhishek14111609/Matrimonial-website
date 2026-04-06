@extends('layouts.app')

@section('title', 'Contact SoulMatch | Matrimony Support')

@section('content')
    <section class="inner-hero">
        <div class="container">
            <p class="eyebrow">We Are Here To Help</p>
            <h1>Contact Us</h1>
            <p>Reach out for membership help, account support, or matchmaking assistance.</p>
        </div>
    </section>

    <section class="section">
        <div class="container contact-layout">
            <form class="contact-form reveal">
                <h3>Send a Message</h3>
                <input type="text" placeholder="Your Name">
                <input type="email" placeholder="Your Email">
                <input type="text" placeholder="Phone Number">
                <textarea rows="5" placeholder="How can we help you?"></textarea>
                <button type="button" class="btn btn-primary">Submit</button>
            </form>

            <div class="contact-info reveal delay-1">
                <div class="info-card">
                    <h4>Customer Support</h4>
                    <p>+91 90000 11111</p>
                    <p>support@soulmatch.demo</p>
                </div>
                <div class="info-card">
                    <h4>Head Office</h4>
                    <p>4th Floor, Zenith Tower, Andheri East, Mumbai</p>
                </div>
                <div class="info-card">
                    <h4>Support Hours</h4>
                    <p>Mon to Sun: 9:00 AM - 10:00 PM</p>
                </div>
            </div>
        </div>
    </section>
@endsection
