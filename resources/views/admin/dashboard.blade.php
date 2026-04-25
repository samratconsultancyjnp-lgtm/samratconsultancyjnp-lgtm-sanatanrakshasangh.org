@extends('layouts.admin')

@section('content')
    <h1 style="margin-bottom: 2rem;">Dashboard Overview</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div class="admin-card" style="border-left: 5px solid var(--primary);">
            <span style="color: #64748b; font-size: 0.9rem;">Total Members</span>
            <h2 style="font-size: 2rem; margin-top: 0.5rem;">{{ $stats['total_members'] }}</h2>
        </div>
        <div class="admin-card" style="border-left: 5px solid #f59e0b;">
            <span style="color: #64748b; font-size: 0.9rem;">Pending Approvals</span>
            <h2 style="font-size: 2rem; margin-top: 0.5rem; color: #f59e0b;">{{ $stats['pending_approvals'] }}</h2>
        </div>
        <div class="admin-card" style="border-left: 5px solid #10b981;">
            <span style="color: #64748b; font-size: 0.9rem;">Total Donations</span>
            <h2 style="font-size: 2rem; margin-top: 0.5rem; color: #10b981;">₹{{ number_format($stats['total_donations'], 2) }}</h2>
        </div>
        <div class="admin-card" style="border-left: 5px solid var(--secondary);">
            <span style="color: #64748b; font-size: 0.9rem;">Events</span>
            <h2 style="font-size: 2rem; margin-top: 0.5rem;">{{ $stats['total_events'] }}</h2>
        </div>
    </div>

    <div class="admin-card">
        <h3 style="margin-bottom: 1.5rem;">Recent Registrations</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid #f1f5f9;">
                    <th style="padding: 1rem;">Name</th>
                    <th style="padding: 1rem;">Email</th>
                    <th style="padding: 1rem;">Status</th>
                    <th style="padding: 1rem;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse(\App\Models\Member::with('user')->latest()->take(5)->get() as $member)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 1rem;">{{ $member->user->name }}</td>
                        <td style="padding: 1rem;">{{ $member->user->email }}</td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.25rem 0.75rem; border-radius: 1rem; font-size: 0.8rem; background: {{ $member->status == 'approved' ? '#dcfce7' : ($member->status == 'pending' ? '#fef3c7' : '#fee2e2') }}; color: {{ $member->status == 'approved' ? '#166534' : ($member->status == 'pending' ? '#92400e' : '#991b1b') }};">
                                {{ ucfirst($member->status) }}
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            <a href="{{ route('admin.members.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">Manage</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" style="padding: 1rem; text-align: center;">No recent registrations.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
