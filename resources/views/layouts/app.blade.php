<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verba - A Quiet Space for Words</title>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@400;600&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">Verba</div>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('feed') }}">Explore</a>

                @auth
                    <a href="{{ route('profile') }}">Profile</a>

                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button 
                            type="submit" 
                            style="
                                background: #b80000; 
                                color: white; 
                                padding: 6px 14px; 
                                border-radius: 6px; 
                                border: none; 
                                cursor: pointer;
                                font-family: Inter, sans-serif;
                            "
                        >
                            Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}">Sign In</a>
                @endguest
            </nav>

        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
