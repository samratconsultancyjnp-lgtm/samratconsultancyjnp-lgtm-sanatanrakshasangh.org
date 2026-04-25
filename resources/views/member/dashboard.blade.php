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
        body { background: #FFF8F0; min-height: 100vh; }
        .member-header { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 5rem 10%; box-shadow: 0 10px 30px rgba(255,102,0,0.2); }
        .content-wrap { padding: 4rem 10%; display: grid; grid-template-columns: 1fr 350px; gap: 4rem; }
        .member-card { background: white; border-radius: 1.5rem; padding: 2.5rem; box-shadow: 0 15px 40px rgba(0,0,0,0.05); border: 1px solid rgba(255,102,0,0.1); }
    </style>
</head>
<body>
    <nav id="mainNav" class="header-fixed" style="background: var(--bg-dark);">
        <a href="{{ route('home') }}" class="logo">
            <i class="fas fa-om"></i> SANATAN RAKSHA SANGH
        </a>
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
