@extends('layouts.admin')

@section('title', 'Member Management')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 style="margin: 0;">All Registered Members</h3>
        <div style="display: flex; gap: 10px;">
            <input type="text" placeholder="Search members..." class="form-control" style="width: 300px;">
            <a href="{{ route('admin.members.export') }}" class="btn-admin" style="background: #38a169; color: white; display: flex; align-items: center; gap: 5px; text-decoration: none; padding: 0 1.5rem;">
                <i class="fas fa-file-csv"></i> Export CSV
            </a>
        </div>
    </div>
    
    <table class="table-custom">
        <thead>
            <tr>
                <th>Member Info</th>
                <th>Designation</th>
                <th>Address</th>
                <th>Registration Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid var(--admin-bg);">
                            @else
                                <div style="width: 45px; height: 45px; border-radius: 50%; background: #edf2f7; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div>
                                <div style="font-weight: 700;">{{ $member->user->name }}</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $member->user->email }} | {{ $member->mobile }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $member->designation->name }}</td>
                    <td>{{ $member->state }}, {{ $member->district }}</td>
                    <td>{{ $member->created_at->format('M d, Y') }}</td>
                    <td>
                        <span class="badge badge-{{ $member->status }}">{{ ucfirst($member->status) }}</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.members.show', $member->id) }}" class="btn-admin" style="background: #edf2f7; color: #4a5568; text-decoration: none; padding: 0.5rem 0.8rem;" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            @if($member->status == 'pending')
                                <form action="{{ route('admin.members.approve', $member->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button class="btn-admin btn-approve" title="Approve"><i class="fas fa-check"></i></button>
                                </form>
                                <form action="{{ route('admin.members.reject', $member->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button class="btn-admin btn-reject" title="Reject"><i class="fas fa-times"></i></button>
                                </form>
                            @elseif($member->status == 'approved')
                                <a href="{{ route('admin.members.id-card', $member->id) }}" class="btn-admin btn-approve" style="text-decoration: none; padding: 0.5rem 0.8rem;" title="Download ID Card">
                                    <i class="fas fa-id-card"></i>
                                </a>
                                <a href="{{ route('admin.members.joining-letter', $member->id) }}" class="btn-admin" style="background: #3182ce; color: white; text-decoration: none; padding: 0.5rem 0.8rem;" title="Download Joining Letter">
                                    <i class="fas fa-file-contract"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 4rem; color: var(--text-muted);">No members found in the records.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 2rem;">
        {{ $members->links() }}
    </div>
</div>
@endsection
