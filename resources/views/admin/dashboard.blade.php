@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; margin-bottom: 3rem;">
    <div class="card stat-card">
        <div class="stat-icon" style="background: #ebf8ff; color: #3182ce;"><i class="fas fa-users"></i></div>
        <div>
            <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Total Members</p>
            <h3 style="margin: 0; font-size: 1.8rem;">{{ $stats['total_members'] }}</h3>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon" style="background: #fffaf0; color: #dd6b20;"><i class="fas fa-user-clock"></i></div>
        <div>
            <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Pending Approvals</p>
            <h3 style="margin: 0; font-size: 1.8rem;">{{ $stats['pending_approvals'] }}</h3>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon" style="background: #f0fff4; color: #38a169;"><i class="fas fa-hand-holding-heart"></i></div>
        <div>
            <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Total Donations</p>
            <h3 style="margin: 0; font-size: 1.8rem;">₹{{ number_format($stats['total_donations'], 2) }}</h3>
        </div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon" style="background: #fdf2f2; color: #e53e3e;"><i class="fas fa-calendar-alt"></i></div>
        <div>
            <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Total Events</p>
            <h3 style="margin: 0; font-size: 1.8rem;">{{ $stats['total_events'] }}</h3>
        </div>
    </div>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 style="margin: 0;">Recent Member Registrations</h3>
        <a href="{{ route('admin.members.index') }}" style="color: var(--admin-primary); text-decoration: none; font-weight: 600;">View All</a>
    </div>
    <table class="table-custom">
        <thead>
            <tr>
                <th>Name</th>
                <th>Father Name</th>
                <th>State / District</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $recentMembers = \App\Models\Member::with('user', 'designation')->latest()->take(5)->get(); @endphp
            @forelse($recentMembers as $member)
                <tr>
                    <td>
                        <div style="font-weight: 700;">{{ $member->user->name }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $member->user->email }}</div>
                    </td>
                    <td>{{ $member->father_name }}</td>
                    <td>{{ $member->state }} / {{ $member->district }}</td>
                    <td>
                        <span class="badge badge-{{ $member->status }}">{{ ucfirst($member->status) }}</span>
                    </td>
                    <td>
                        @if($member->status == 'pending')
                            <form action="{{ route('admin.members.approve', $member->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button class="btn-admin btn-approve" title="Approve"><i class="fas fa-check"></i></button>
                            </form>
                            <form action="{{ route('admin.members.reject', $member->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button class="btn-admin btn-reject" title="Reject"><i class="fas fa-times"></i></button>
                            </form>
                        @else
                            <span style="color: var(--text-muted); font-size: 0.8rem;">Processed</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 3rem; color: var(--text-muted);">No recent registrations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
