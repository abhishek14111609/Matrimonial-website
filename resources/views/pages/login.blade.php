@extends('layouts.app')

@section('title', 'Member Login | SoulMatch')

@section('content')
    <section class="auth-wrap">
        <div class="auth-panel reveal">
            <h1>Welcome Back</h1>
            <p>Login to view your matches and continue conversations.</p>
            <form class="auth-form" action="{{ route('dashboard') }}" method="GET">
                <input type="email" placeholder="Email address">
                <input type="password" placeholder="Password">
                <button type="submit" class="btn btn-primary full">Login</button>
                <a href="#" class="link-center">Forgot password?</a>
            </form>
            <p class="muted center">New here? <a href="{{ route('register') }}">Create a profile</a></p>
        </div>
    </section>
@endsection
