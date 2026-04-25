@extends('layouts.admin')

@section('title', 'Member Management')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 style="margin: 0;">All Registered Members</h3>
        <div style="display: flex; gap: 10px;">
            <input type="text" placeholder="Search members..." style="padding: 0.6rem 1rem; border-radius: 0.8rem; border: 1px solid #edf2f7; width: 250px;">
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
                        <div style="font-weight: 700;">{{ $member->user->name }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $member->user->email }} | {{ $member->mobile }}</div>
                    </td>
                    <td>{{ $member->designation->name }}</td>
                    <td>{{ $member->state }}, {{ $member->district }}</td>
                    <td>{{ $member->created_at->format('M d, Y') }}</td>
                    <td>
                        <span class="badge badge-{{ $member->status }}">{{ ucfirst($member->status) }}</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px;">
                            @if($member->status == 'pending')
                                <form action="{{ route('admin.members.approve', $member->id) }}" method="POST">
                                    @csrf
                                    <button class="btn-admin btn-approve"><i class="fas fa-check"></i></button>
                                </form>
                                <form action="{{ route('admin.members.reject', $member->id) }}" method="POST">
                                    @csrf
                                    <button class="btn-admin btn-reject"><i class="fas fa-times"></i></button>
                                </form>
                            @else
                                <button class="btn-admin" style="background: #edf2f7; color: var(--text-muted);" disabled><i class="fas fa-check-double"></i></button>
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
