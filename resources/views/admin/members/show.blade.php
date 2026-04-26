@extends('layouts.admin')

@section('title', 'Member Details')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 3rem; border-bottom: 2px solid var(--admin-bg); padding-bottom: 2rem;">
        <div style="display: flex; gap: 2rem; align-items: center;">
            <div style="width: 120px; height: 120px; border-radius: 1.5rem; overflow: hidden; border: 4px solid var(--admin-bg); box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                @if($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 100%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 3rem;">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
            </div>
            <div>
                <h2 style="margin: 0; font-size: 2.5rem; color: var(--text-main);">{{ $member->user->name }}</h2>
                <p style="margin: 5px 0 0; font-size: 1.2rem; color: var(--admin-primary); font-weight: 700;">{{ $member->designation->name }}</p>
                <div style="margin-top: 1rem;">
                    <span class="badge badge-{{ $member->status }}" style="font-size: 1rem; padding: 0.5rem 1.5rem;">{{ ucfirst($member->status) }} Member</span>
                </div>
            </div>
        </div>
        <div style="display: flex; gap: 1rem;">
            @if($member->status == 'approved')
                <a href="{{ route('admin.members.id-card', $member->id) }}" class="btn-admin btn-approve" style="text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-id-card"></i> ID Card
                </a>
                <a href="{{ route('admin.members.joining-letter', $member->id) }}" class="btn-admin" style="background: #3182ce; color: white; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-file-contract"></i> Joining Letter
                </a>
            @endif
            <a href="{{ route('admin.members.index') }}" class="btn-admin" style="background: #edf2f7; color: var(--text-muted); text-decoration: none;">Back to List</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
        <div>
            <h4 style="color: var(--admin-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-info-circle"></i> Personal Information
            </h4>
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1rem; background: #f8fafc; padding: 2rem; border-radius: 1.5rem;">
                <div style="font-weight: 700; color: #64748b;">Father's Name</div>
                <div style="color: var(--text-main);">{{ $member->father_name }}</div>
                
                <div style="font-weight: 700; color: #64748b;">Date of Birth</div>
                <div style="color: var(--text-main);">{{ $member->dob ? date('d M, Y', strtotime($member->dob)) : 'N/A' }}</div>
                
                <div style="font-weight: 700; color: #64748b;">Mobile Number</div>
                <div style="color: var(--text-main);">{{ $member->mobile }}</div>
                
                <div style="font-weight: 700; color: #64748b;">Email Address</div>
                <div style="color: var(--text-main);">{{ $member->user->email }}</div>
            </div>
        </div>
        <div>
            <h4 style="color: var(--admin-primary); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-map-marker-alt"></i> Address & Location
            </h4>
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1rem; background: #f8fafc; padding: 2rem; border-radius: 1.5rem;">
                <div style="font-weight: 700; color: #64748b;">State</div>
                <div style="color: var(--text-main);">{{ $member->state }}</div>
                
                <div style="font-weight: 700; color: #64748b;">District</div>
                <div style="color: var(--text-main);">{{ $member->district }}</div>
                
                <div style="font-weight: 700; color: #64748b;">Pincode</div>
                <div style="color: var(--text-main);">{{ $member->pincode ?? 'N/A' }}</div>
                
                <div style="font-weight: 700; color: #64748b;">Full Address</div>
                <div style="color: var(--text-main);">{{ $member->address }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
