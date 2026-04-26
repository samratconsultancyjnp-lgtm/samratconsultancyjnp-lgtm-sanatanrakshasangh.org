<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Sanatan Raksha Sangh</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-om"></i>
            <span>ADMIN PANEL</span>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.members.index') }}" class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Member Management
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donations.index') }}" class="{{ request()->routeIs('admin.donations.*') ? 'active' : '' }}">
                    <i class="fas fa-hand-holding-heart"></i> Donations
                </a>
            </li>
            <li>
                <a href="{{ route('admin.events.index') }}" class="{{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i> Events
                </a>
            </li>
            <li>
                <a href="{{ route('admin.sliders.index') }}" class="{{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                    <i class="fas fa-sliders-h"></i> Home Slider
                </a>
            </li>
            <li>
                <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i> Gallery
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Website Settings
                </a>
            </li>
            <li>
                <a href="{{ route('admin.templates') }}" class="{{ request()->routeIs('admin.templates') ? 'active' : '' }}">
                    <i class="fas fa-file-contract"></i> Document Templates
                </a>
            </li>
            <li>
                <a href="{{ route('admin.designations.index') }}" class="{{ request()->routeIs('admin.designations.*') ? 'active' : '' }}">
                    <i class="fas fa-id-badge"></i> Designations
                </a>
            </li>
            <li>
                <a href="{{ route('admin.team.index') }}" class="{{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i> Manage Team
                </a>
            </li>
            <li>
                <a href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Public Website
                </a>
            </li>
            <li style="margin-top: auto;">
                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #feb2b2;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header-top">
            <h2 style="font-weight: 700; color: var(--text-main);">@yield('title', 'Dashboard Overview')</h2>
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="text-align: right;">
                    <p style="margin: 0; font-weight: 700;">{{ auth()->user()->name }}</p>
                    <p style="margin: 0; font-size: 0.8rem; color: var(--text-muted);">Administrator</p>
                </div>
                <img src="https://ui-avatars.com/api/?name=Admin&background=FF9933&color=fff" style="width: 45px; height: 45px; border-radius: 12px;">
            </div>
        </div>

        @if(session('success'))
            <div style="background: #f0fff4; color: #38a169; padding: 1rem 1.5rem; border-radius: 1rem; margin-bottom: 2rem; border: 1px solid #c6f6d5;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @yield('content')

        <footer style="margin-top: 5rem; padding: 2rem 0; border-top: 1px solid #edf2f7; text-align: center; font-size: 0.9rem; color: #718096;">
            <p>&copy; {{ date('Y') }} Sanatan Raksha Sangh. All rights reserved.</p>
            <p style="margin-top: 0.5rem;">Design and developed by <a href="https://samratconsultancy.in/" target="_blank" style="color: #ff9933; font-weight: 700; text-decoration: none;">Samrat Consultancy & IT World Pvt. Ltd.</a></p>
        </footer>
    </div>
</body>
</html>
