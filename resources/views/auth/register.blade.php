@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h1 class="title">Join Verba</h1>
    <p class="subtitle">Create an account to start writing and engaging with thoughtful readers.</p>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        {{-- Error display --}}
        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Name --}}
        <label>Username</label>
        <input 
            type="text" 
            name="name" 
            placeholder="Your username"
            value="{{ old('name') }}"
            required
        >

        {{-- Email --}}
        <label>Email address</label>
        <input 
            type="email" 
            name="email" 
            placeholder="you@example.com"
            value="{{ old('email') }}"
            required
        >

        {{-- Password --}}
        <label>Password</label>
        <div class="password-wrapper">
            <input 
                id="register-password" 
                type="password"
                name="password"
                required
            >
            <span class="toggle-password" onclick="togglePassword('register-password', this)">Show</span>
        </div>

        {{-- Password Confirmation --}}
        <label>Confirm Password</label>
        <div class="password-wrapper">
            <input 
                id="register-password-confirm" 
                type="password"
                name="password_confirmation"
                required
            >
            <span class="toggle-password" onclick="togglePassword('register-password-confirm', this)">Show</span>
        </div>

        <button class="btn">Create Account</button>
    </form>

    <p class="switch-text">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>

    <a class="back-link" href="{{ route('home') }}">← Back to Home</a>
</div>
@endsection
