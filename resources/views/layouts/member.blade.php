<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Panel - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        :root {
            --sidebar-width: 280px;
            --primary: #FF6600;
            --secondary: #3E1F00;
            --bg-light: #FFF8F0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-light);
            margin: 0;
            display: flex;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--secondary);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 10px 0 30px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .sidebar-logo {
            padding: 2.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-logo i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .sidebar-menu {
            flex: 1;
            padding: 2rem 1.5rem;
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(255,102,0,0.1);
            color: white;
            transform: translateX(5px);
        }

        .menu-item i {
            width: 20px;
            color: var(--primary);
        }

        .sidebar-footer {
            padding: 2rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            min-height: 100vh;
            padding: 2.5rem 4rem;
            background: var(--bg-light);
        }

        .member-top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }

        .user-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .card-premium {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.02);
            border: 1px solid rgba(0,0,0,0.03);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            border-left: 5px solid var(--primary);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,102,0,0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
        }
    </style>
    @yield('extra_css')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            <i class="fas fa-om"></i>
            <div style="font-weight: 700; letter-spacing: 1px; font-size: 1rem;">MEMBER PANEL</div>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('member.dashboard') }}" class="menu-item {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="{{ route('member.district-members') }}" class="menu-item {{ request()->routeIs('member.district-members') ? 'active' : '' }}">
                <i class="fas fa-users"></i> District Members
            </a>
            <a href="{{ route('donation') }}" class="menu-item">
                <i class="fas fa-hand-holding-heart"></i> Make Donation
            </a>
            <a href="{{ route('home') }}" class="menu-item">
                <i class="fas fa-globe"></i> Visit Website
            </a>
        </div>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item" style="background: none; border: none; width: 100%; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="member-top-bar">
            <div>
                <h2 style="margin: 0; color: var(--secondary);">@yield('page_title', 'Dashboard')</h2>
                <p style="margin: 5px 0 0; color: #94a3b8; font-size: 0.9rem;">Welcome back to Sanatan Raksha Sangh</p>
            </div>
            <div class="user-badge">
                <div class="avatar-circle">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div style="font-weight: 600; font-size: 0.9rem;">{{ auth()->user()->name }}</div>
            </div>
        </div>

        @yield('content')

        <footer style="margin-top: 5rem; padding: 2rem 0; border-top: 1px solid rgba(0,0,0,0.05); text-align: center; font-size: 0.9rem; color: #94a3b8;">
            <p>&copy; {{ date('Y') }} Sanatan Raksha Sangh. All rights reserved.</p>
            <p style="margin-top: 0.5rem;">Design and developed by <a href="https://samratconsultancy.in/" target="_blank" style="color: var(--primary); font-weight: 700; text-decoration: none;">Samrat Consultancy & IT World Pvt. Ltd.</a></p>
        </footer>
    </div>
</body>
</html>
