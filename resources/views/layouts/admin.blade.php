<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        body { display: flex; min-height: 100vh; background: #f8fafc; }
        .sidebar { width: 260px; background: var(--primary); color: white; padding: 2rem 1.5rem; }
        .sidebar a { display: block; color: rgba(255,255,255,0.7); text-decoration: none; padding: 0.8rem 1rem; border-radius: 0.5rem; margin-bottom: 0.5rem; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: white; }
        .main-content { flex: 1; padding: 2rem 3rem; overflow-y: auto; }
        .admin-card { background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: var(--shadow); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 style="color: var(--accent); margin-bottom: 2rem;">Admin Panel</h2>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="{{ route('admin.members.index') }}" class="{{ request()->routeIs('admin.members.*') ? 'active' : '' }}"><i class="fas fa-users"></i> Member Management</a>
        <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> Website Settings</a>
        <a href="{{ route('admin.templates') }}" class="{{ request()->routeIs('admin.templates') ? 'active' : '' }}"><i class="fas fa-file-invoice"></i> Document Templates</a>
        <a href="{{ route('home') }}"><i class="fas fa-external-link-alt"></i> Public Website</a>
        <form method="POST" action="{{ route('logout') }}" style="margin-top: 2rem;">
            @csrf
            <button type="submit" style="background: none; border: none; color: #fca5a5; cursor: pointer; padding: 1rem;"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>

    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>
