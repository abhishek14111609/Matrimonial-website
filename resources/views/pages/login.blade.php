@extends('layouts.app')

@section('title', 'Member Login | SoulMatch')

@section('content')
    <section class="auth-wrap">
        <div class="auth-panel reveal">
            <h1>Welcome Back</h1>
            <p>Login to view your matches and continue conversations.</p>
            <form class="auth-form" action="{{ route('login.attempt') }}" method="POST">
                @csrf
                <div>
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary full">Login</button>
            </form>
            <p class="muted center">New here? <a href="{{ route('register') }}">Create a profile</a></p>
        </div>
    </section>
@endsection
