@extends('layouts.app')

@section('content')
<div class="auth-container">
    <h1 class="title">Welcome back</h1>
    <p class="subtitle">Sign in to continue your literary journey.</p>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label>Email address</label>
        <input 
            type="email" 
            name="email" 
            placeholder="you@example.com" 
            value="{{ old('email') }}"
            required
        >

        <label>Password</label>
        <div class="password-wrapper">
            <input 
                id="login-password" 
                type="password" 
                name="password"
                required
            >
            <span class="toggle-password" onclick="togglePassword('login-password', this)">Show</span>
        </div>

        <button class="btn">Sign In</button>
    </form>


    <p class="switch-text">Don't have an account? <a href="{{ route('register') }}">Join us</a></p>

    <a class="back-link" href="{{ route('home') }}">← Back to Home</a>
</div>
@endsection
