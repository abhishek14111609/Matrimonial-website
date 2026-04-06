@extends('layouts.app')

@section('title', 'Create Profile | SoulMatch')

@section('content')
    <section class="auth-wrap">
        <div class="auth-panel wide reveal">
            <h1>Create Your Matrimony Profile</h1>
            <p>Join for free and start receiving meaningful match recommendations.</p>
            <form class="auth-form grid-2" action="{{ route('dashboard') }}" method="GET">
                <input type="text" placeholder="Full Name">
                <input type="email" placeholder="Email Address">
                <input type="text" placeholder="Mobile Number">
                <input type="number" placeholder="Age">
                <select>
                    <option>Gender</option>
                    <option>Female</option>
                    <option>Male</option>
                </select>
                <select>
                    <option>Religion</option>
                    <option>Hindu</option>
                    <option>Muslim</option>
                    <option>Christian</option>
                    <option>Sikh</option>
                </select>
                <input type="text" placeholder="City">
                <input type="text" placeholder="Profession">
                <input type="password" placeholder="Create Password">
                <input type="password" placeholder="Confirm Password">
                <button type="submit" class="btn btn-primary full span-2">Register Free</button>
            </form>
        </div>
    </section>
@endsection
