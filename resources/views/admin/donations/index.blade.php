@extends('layouts.admin')

@section('title', 'Donation Management')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h3 style="margin: 0; color: var(--text-main);">All Donations</h3>
    <a href="{{ route('admin.donations.export') }}" class="btn-admin" style="background: #38a169; color: white; display: flex; align-items: center; gap: 5px; text-decoration: none; padding: 0.8rem 1.5rem; border-radius: 0.8rem; font-weight: 700;">
        <i class="fas fa-file-csv"></i> Export CSV
    </a>
</div>

<div class="card" style="padding: 0; overflow: hidden;">
    <table class="table-custom">
        <thead>
            <tr>
                <th>Donor Name</th>
                <th>Amount</th>
                <th>TXN ID</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($donations as $donation)
            <tr>
                <td style="font-weight: 600;">{{ $donation->name }}</td>
                <td style="font-weight: 800; color: var(--admin-primary);">₹{{ number_format($donation->amount) }}</td>
                <td style="font-family: monospace; color: var(--text-muted);">{{ $donation->transaction_id }}</td>
                <td>
                    <span class="badge {{ $donation->status == 'approved' ? 'badge-approved' : 'badge-pending' }}">
                        {{ ucfirst($donation->status) }}
                    </span>
                </td>
                <td>
                    <div style="display: flex; gap: 8px;">
                        @if($donation->status == 'pending')
                        <form action="{{ route('admin.donations.approve', $donation->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-admin btn-approve" style="padding: 0.5rem 1rem;">
                                <i class="fas fa-check"></i> Approve
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('admin.donations.receipt', $donation->id) }}" class="btn-admin" style="background: #edf2f7; color: #4a5568; text-decoration: none; padding: 0.5rem 1rem;">
                            <i class="fas fa-file-pdf"></i> Receipt
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-top: 2rem;">
        {{ $donations->links() }}
    </div>
</div>
@endsection
