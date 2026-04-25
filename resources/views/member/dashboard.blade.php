<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        body { background: #f1f5f9; min-height: 100vh; }
        .member-header { background: var(--primary); color: white; padding: 3rem 10%; }
        .content-wrap { padding: 3rem 10%; display: grid; grid-template-columns: 1fr 300px; gap: 3rem; }
        .member-card { background: white; border-radius: 1rem; padding: 2rem; box-shadow: var(--shadow); }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}" class="logo">SANATAN RAKSHA SANGH</a>
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: white; cursor: pointer; font-weight: 500;">Logout</button>
            </form>
        </div>
    </nav>

    <div class="member-header">
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p>Member ID: SRS-{{ str_pad($member->id, 5, '0', STR_PAD_LEFT) }} | Status: 
            <span style="color: var(--accent); font-weight: 700;">{{ ucfirst($member->status) }}</span>
        </p>
    </div>

    <div class="content-wrap">
        <div>
            <div class="member-card">
                <h3 style="margin-bottom: 1.5rem; color: var(--primary);">Personal Information</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div>
                        <p style="color: #64748b; font-size: 0.9rem;">Father's Name</p>
                        <p style="font-weight: 600;">{{ $member->father_name }}</p>
                    </div>
                    <div>
                        <p style="color: #64748b; font-size: 0.9rem;">Designation</p>
                        <p style="font-weight: 600;">{{ $member->designation->name }}</p>
                    </div>
                    <div>
                        <p style="color: #64748b; font-size: 0.9rem;">Mobile</p>
                        <p style="font-weight: 600;">{{ $member->mobile }}</p>
                    </div>
                    <div>
                        <p style="color: #64748b; font-size: 0.9rem;">Location</p>
                        <p style="font-weight: 600;">{{ $member->district }}, {{ $member->state }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="member-card">
                <h3 style="margin-bottom: 1.5rem; color: var(--primary);">Downloads</h3>
                @if($member->status == 'approved')
                    <a href="{{ route('member.id-card') }}" class="btn-premium" style="display: block; text-align: center; margin-bottom: 1rem;">
                        <i class="fas fa-id-card"></i> Download ID Card
                    </a>
                    <a href="{{ route('member.joining-letter') }}" class="btn-premium" style="display: block; text-align: center; background: var(--bg-dark); color: white;">
                        <i class="fas fa-file-alt"></i> Joining Letter
                    </a>
                @else
                    <div style="background: #fffbeb; border: 1px solid #fde68a; padding: 1rem; border-radius: 0.5rem; color: #92400e; font-size: 0.9rem;">
                        <i class="fas fa-info-circle"></i> Your documents will be available once your membership is approved by the admin.
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
