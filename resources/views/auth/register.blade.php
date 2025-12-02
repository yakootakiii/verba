@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h1 class="title">Join Verba</h1>
    <p class="subtitle">Create an account to start writing and engaging with thoughtful readers.</p>

    <form action="#" method="POST">
        @csrf

        <label>Email address</label>
        <input type="email" placeholder="you@example.com" required>

        <label>Password</label>
        <div class="password-wrapper">
            <input id="register-password" type="password" required>
            <span class="toggle-password" onclick="togglePassword('register-password', this)">Show</span>
        </div>

        <button class="btn">Create Account</button>
    </form>

    <p class="switch-text">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>

    <a class="back-link" href="{{ route('home') }}">← Back to Home</a>
</div>
@endsection
