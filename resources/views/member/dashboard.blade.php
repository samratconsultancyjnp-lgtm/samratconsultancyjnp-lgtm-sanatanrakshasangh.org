@extends('layouts.member')

@section('page_title', 'Dashboard Overview')

@section('content')
<div class="stats-grid" style="background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); margin-bottom: 3rem;">
    <div class="stat-card" style="background: white; border: 1px solid #f1f5f9; box-shadow: none;">
        <div class="stat-icon"><i class="fas fa-id-badge"></i></div>
        <div>
            <div style="font-size: 0.8rem; color: #64748b; font-weight: 500;">Membership ID</div>
            <div style="font-weight: 700; font-size: 1.2rem; color: var(--secondary);">SRS-{{ str_pad($member->id, 5, '0', STR_PAD_LEFT) }}</div>
        </div>
    </div>
    <div class="stat-card" style="background: white; border-left-color: #10b981; border: 1px solid #f1f5f9; border-left-width: 5px; box-shadow: none;">
        <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: #10b981;"><i class="fas fa-check-circle"></i></div>
        <div>
            <div style="font-size: 0.8rem; color: #64748b; font-weight: 500;">Status</div>
            <div style="font-weight: 700; font-size: 1.2rem; color: #10b981;">{{ ucfirst($member->status) }}</div>
        </div>
    </div>
    <div class="stat-card" style="background: white; border-left-color: #6366f1; border: 1px solid #f1f5f9; border-left-width: 5px; box-shadow: none;">
        <div class="stat-icon" style="background: rgba(99,102,241,0.1); color: #6366f1;"><i class="fas fa-map-marker-alt"></i></div>
        <div>
            <div style="font-size: 0.8rem; color: #64748b; font-weight: 500;">District</div>
            <div style="font-weight: 700; font-size: 1.2rem; color: var(--secondary);">{{ $member->district }}</div>
        </div>
    </div>
    <div class="stat-card" style="background: white; border-left-color: #f59e0b; border: 1px solid #f1f5f9; border-left-width: 5px; box-shadow: none;">
        <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: #f59e0b;"><i class="fas fa-heart"></i></div>
        <div>
            <div style="font-size: 0.8rem; color: #64748b; font-weight: 500;">Total Contributed</div>
            <div style="font-weight: 700; font-size: 1.2rem; color: var(--secondary);">₹{{ number_format($totalDonations, 2) }}</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <div class="card-premium">
        <h3 style="margin-top: 0; color: var(--secondary); display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-user-circle" style="color: var(--primary);"></i> Personal Profile
        </h3>
        <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 1.5rem 0;">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">
            <div>
                <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 5px;">Father's Name</label>
                <div style="font-weight: 600; color: var(--secondary);">{{ $member->father_name }}</div>
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 5px;">Designation</label>
                <div style="font-weight: 600; color: var(--secondary);">{{ $member->designation->name }}</div>
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 5px;">Date of Birth</label>
                <div style="font-weight: 600; color: var(--secondary);">{{ date('d M, Y', strtotime($member->dob)) }}</div>
            </div>
            <div>
                <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 5px;">Mobile Number</label>
                <div style="font-weight: 600; color: var(--secondary);">+91 {{ $member->mobile }}</div>
            </div>
            <div style="grid-column: span 2;">
                <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 5px;">Full Address</label>
                <div style="font-weight: 600; color: var(--secondary);">{{ $member->address }}, {{ $member->district }}, {{ $member->state }}</div>
            </div>
        </div>
    </div>

    <div class="card-premium" style="background: var(--secondary); color: white;">
        <h3 style="margin-top: 0; color: var(--primary);">Quick Actions</h3>
        <p style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 2rem;">Access your documents and support the cause.</p>
        
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @if($member->status == 'approved')
                <a href="{{ route('member.id-card') }}" class="btn-premium" style="text-align: center; width: 100%;">
                    <i class="fas fa-id-card"></i> Download ID Card
                </a>
            @endif
            <a href="{{ route('donation') }}" class="btn-premium" style="text-align: center; width: 100%; background: #fff; color: var(--secondary);">
                <i class="fas fa-plus"></i> New Donation
            </a>
            @if($member->status == 'approved')
                <a href="{{ route('member.joining-letter') }}" style="color: white; text-align: center; font-size: 0.9rem; text-decoration: none; border: 1px solid rgba(255,255,255,0.2); padding: 0.8rem; border-radius: 50px;">
                    <i class="fas fa-file-pdf"></i> Joining Letter
                </a>
            @endif
        </div>
    </div>
</div>

<div class="card-premium">
    <h3 style="margin-top: 0; color: var(--secondary); display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-history" style="color: var(--primary);"></i> Donation History
    </h3>
    <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 1.5rem 0;">

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid #f1f5f9;">
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.8rem; text-transform: uppercase;">Date</th>
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.8rem; text-transform: uppercase;">Amount</th>
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.8rem; text-transform: uppercase;">Transaction ID</th>
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.8rem; text-transform: uppercase;">Status</th>
                    <th style="padding: 1rem; color: #94a3b8; font-size: 0.8rem; text-transform: uppercase;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $donation)
                    <tr style="border-bottom: 1px solid #f8fafc;">
                        <td style="padding: 1rem; font-size: 0.9rem;">{{ $donation->created_at->format('d M, Y') }}</td>
                        <td style="padding: 1rem; font-weight: 600; color: var(--secondary);">₹{{ number_format($donation->amount, 2) }}</td>
                        <td style="padding: 1rem; font-family: monospace; font-size: 0.85rem;">{{ $donation->transaction_id }}</td>
                        <td style="padding: 1rem;">
                            @php
                                $statusColor = [
                                    'pending' => ['#f59e0b', '#fffbeb'],
                                    'approved' => ['#10b981', '#ecfdf5'],
                                    'rejected' => ['#ef4444', '#fef2f2']
                                ][$donation->status] ?? ['#64748b', '#f8fafc'];
                            @endphp
                            <span style="background: {{ $statusColor[1] }}; color: {{ $statusColor[0] }}; padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">
                                {{ $donation->status }}
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            @if($donation->status === 'approved')
                                <a href="{{ route('member.donations.receipt', $donation->id) }}" style="color: var(--primary); text-decoration: none; font-size: 0.85rem; font-weight: 600;">
                                    <i class="fas fa-file-download"></i> Receipt
                                </a>
                            @else
                                <span style="color: #cbd5e1; font-size: 0.85rem;">N/A</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 3rem; text-align: center; color: #94a3b8;">
                            <i class="fas fa-hand-holding-heart" style="font-size: 2rem; opacity: 0.2; margin-bottom: 10px;"></i>
                            <p>No donations recorded yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
