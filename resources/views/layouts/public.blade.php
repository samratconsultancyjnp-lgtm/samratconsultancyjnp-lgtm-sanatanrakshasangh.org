<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Sanatan Raksha Sangh') }} - NGO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}" class="logo">SANATAN RAKSHA SANGH</a>
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('events') }}">Events</a>
            <a href="{{ route('gallery') }}">Gallery</a>
            <a href="{{ route('join-us') }}">Join Us</a>
            <a href="{{ route('donation') }}">Donation</a>
            @auth
                @if(auth()->user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn-premium">Admin Panel</a>
                @else
                    <a href="{{ route('member.dashboard') }}" class="btn-premium">Member Panel</a>
                @endif
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer style="background: var(--bg-dark); color: white; padding: 4rem 5% 2rem; margin-top: 4rem;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem;">
            <div>
                <h3 style="color: var(--accent); margin-bottom: 1rem;">Sanatan Raksha Sangh</h3>
                <p>Empowering lives, protecting heritage, and building a better future together.</p>
            </div>
            <div>
                <h3 style="margin-bottom: 1rem;">Quick Links</h3>
                <ul style="list-style: none;">
                    <li><a href="{{ route('about') }}" style="color: white; text-decoration: none;">Mission & Vision</a></li>
                    <li><a href="{{ route('events') }}" style="color: white; text-decoration: none;">Latest Events</a></li>
                    <li><a href="{{ route('donation') }}" style="color: white; text-decoration: none;">Donate Now</a></li>
                </ul>
            </div>
            <div>
                <h3 style="margin-bottom: 1rem;">Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Sangh Road, New Delhi</p>
                <p><i class="fas fa-phone"></i> +91 98765 43210</p>
                <p><i class="fas fa-envelope"></i> info@sanatanraksha.org</p>
            </div>
        </div>
        <div style="text-align: center; margin-top: 3rem; border-top: 1px solid #334155; padding-top: 1.5rem;">
            <p>&copy; {{ date('Year') }} Sanatan Raksha Sangh. All rights reserved.</p>
            <p style="font-size: 0.8rem; margin-top: 0.5rem; opacity: 0.7;">Visitor Counter: <span id="visitor-count">10,245</span></p>
        </div>
    </footer>
</body>
</html>
