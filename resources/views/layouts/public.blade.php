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
    <header class="header-fixed" id="mainHeader">
        <div class="top-bar">
            <div>
                <i class="fas fa-envelope"></i> info@sanatanraksha.org | 
                <i class="fas fa-phone-alt"></i> +91 800 123 4567
            </div>
            <div>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <nav>
            <a href="{{ route('home') }}" class="logo" style="display: flex; align-items: center; gap: 10px; text-decoration: none; white-space: nowrap;">
                <i class="fas fa-om" style="font-size: 1.6rem; color: var(--primary);"></i>
                <span style="font-size: 1.1rem; letter-spacing: 1px; color: var(--text-dark); font-weight: 800; font-family: 'Outfit', sans-serif;">SANATAN RAKSHA SANGH</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}">Events</a>
                <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
                <a href="{{ route('join-us') }}" class="{{ request()->routeIs('join-us') ? 'active' : '' }}">Join Us</a>
                @auth
                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" style="color: var(--accent);"><i class="fas fa-user-shield"></i> Admin</a>
                    @else
                        <a href="{{ route('member.dashboard') }}" style="color: var(--accent);"><i class="fas fa-user"></i> Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                @endauth
                <a href="{{ route('donation') }}" class="donation-btn-top"><i class="fas fa-heart"></i> DONATE NOW</a>
            </div>
        </nav>
    </header>

    <script>
        window.onscroll = function() {
            var header = document.getElementById('mainHeader');
            if (window.pageYOffset > 50) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        };
    </script>

    <main>
        @yield('content')
    </main>

    <footer style="background: var(--bg-dark); color: white; padding: 5rem 5% 2rem; border-top: 5px solid var(--primary);">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 4rem;">
            <div>
                <h3 style="color: var(--primary); margin-bottom: 1.5rem; font-size: 1.8rem;">Sanatan Raksha Sangh</h3>
                <p style="opacity: 0.8; line-height: 1.8;">Our organization is dedicated to the preservation of Sanatan values and the welfare of society through service and empowerment.</p>
                <div style="margin-top: 2rem; display: flex; gap: 1.5rem;">
                    <a href="#" style="color: var(--primary); font-size: 1.5rem;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: var(--primary); font-size: 1.5rem;"><i class="fab fa-twitter"></i></a>
                    <a href="#" style="color: var(--primary); font-size: 1.5rem;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: var(--primary); font-size: 1.5rem;"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div>
                <h3 style="margin-bottom: 1.5rem; border-bottom: 2px solid var(--primary); display: inline-block; padding-bottom: 5px;">Quick Links</h3>
                <ul style="list-style: none;">
                    <li style="margin-bottom: 0.8rem;"><a href="{{ route('about') }}" style="color: white; text-decoration: none; opacity: 0.8; transition: 0.3s;">Mission & Vision</a></li>
                    <li style="margin-bottom: 0.8rem;"><a href="{{ route('events') }}" style="color: white; text-decoration: none; opacity: 0.8; transition: 0.3s;">Upcoming Events</a></li>
                    <li style="margin-bottom: 0.8rem;"><a href="{{ route('gallery') }}" style="color: white; text-decoration: none; opacity: 0.8; transition: 0.3s;">Media Gallery</a></li>
                    <li style="margin-bottom: 0.8rem;"><a href="{{ route('donation') }}" style="color: white; text-decoration: none; opacity: 0.8; transition: 0.3s;">Support Our Cause</a></li>
                </ul>
            </div>
            <div>
                <h3 style="margin-bottom: 1.5rem; border-bottom: 2px solid var(--primary); display: inline-block; padding-bottom: 5px;">Contact Info</h3>
                <p style="margin-bottom: 1rem;"><i class="fas fa-map-marker-alt" style="color: var(--primary); margin-right: 10px;"></i> 45, Sangh Sadan, Ayodhya, UP</p>
                <p style="margin-bottom: 1rem;"><i class="fas fa-phone-alt" style="color: var(--primary); margin-right: 10px;"></i> +91 800 123 4567</p>
                <p style="margin-bottom: 1rem;"><i class="fas fa-envelope" style="color: var(--primary); margin-right: 10px;"></i> contact@sanatanraksha.org</p>
            </div>
        </div>
        <div style="text-align: center; margin-top: 4rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem;">
            <p>&copy; {{ date('Y') }} Sanatan Raksha Sangh. All rights reserved.</p>
            <p style="margin-top: 0.5rem; font-size: 0.9rem; opacity: 0.9;">Design and developed by <a href="https://samratconsultancy.in/" target="_blank" style="color: var(--primary); font-weight: 700; text-decoration: none;">Samrat Consultancy & IT World Pvt. Ltd.</a></p>
            <div style="margin-top: 1rem; font-size: 0.9rem; opacity: 0.6;">
                Visitor Count: <span style="color: var(--accent); font-weight: 700;">12,542</span>
            </div>
        </div>
    </footer>
</body>
</html>
