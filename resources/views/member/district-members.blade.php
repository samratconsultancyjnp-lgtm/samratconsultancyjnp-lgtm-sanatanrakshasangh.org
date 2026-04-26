@extends('layouts.member')

@section('page_title', 'District Members')

@section('content')
<div class="card-premium">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h3 style="margin: 0; color: var(--secondary);">Approved Members in {{ $currentMember->district }}</h3>
            <p style="margin: 5px 0 0; color: #94a3b8; font-size: 0.9rem;">Total {{ $districtMembers->count() }} active members found in your area</p>
        </div>
        <div style="background: rgba(255,102,0,0.1); color: var(--primary); padding: 0.5rem 1rem; border-radius: 8px; font-weight: 600; font-size: 0.8rem;">
            <i class="fas fa-map-marker-alt"></i> {{ $currentMember->district }}
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #f1f5f9;">
                    <th style="padding: 1.2rem 1rem; color: #94a3b8; font-weight: 500; font-size: 0.85rem; text-transform: uppercase;">Member Name</th>
                    <th style="padding: 1.2rem 1rem; color: #94a3b8; font-weight: 500; font-size: 0.85rem; text-transform: uppercase;">Designation</th>
                    <th style="padding: 1.2rem 1rem; color: #94a3b8; font-weight: 500; font-size: 0.85rem; text-transform: uppercase;">Member ID</th>
                    <th style="padding: 1.2rem 1rem; color: #94a3b8; font-weight: 500; font-size: 0.85rem; text-transform: uppercase;">Mobile</th>
                    <th style="padding: 1.2rem 1rem; color: #94a3b8; font-weight: 500; font-size: 0.85rem; text-transform: uppercase;">Address</th>
                    <th style="padding: 1.2rem 1rem; color: #94a3b8; font-weight: 500; font-size: 0.85rem; text-transform: uppercase;">Joined Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($districtMembers as $m)
                    <tr style="border-bottom: 1px solid #f8fafc; transition: all 0.2s ease;">
                        <td style="padding: 1.2rem 1rem;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: #f1f5f9; border: 1px solid #eee;">
                                    @if($m->photo)
                                        <img src="{{ asset('storage/' . $m->photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @else
                                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 0.8rem;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--secondary);">{{ $m->user->name }}</div>
                                    <div style="font-size: 0.75rem; color: #94a3b8;">{{ $m->state }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 1.2rem 1rem;">
                            <span style="background: rgba(255,102,0,0.1); color: var(--primary); padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;">
                                {{ $m->designation->name }}
                            </span>
                        </td>
                        <td style="padding: 1.2rem 1rem; font-family: monospace; color: #64748b; font-weight: 600;">
                            SRS-{{ str_pad($m->id, 5, '0', STR_PAD_LEFT) }}
                        </td>
                        <td style="padding: 1.2rem 1rem; color: var(--secondary); font-weight: 500; font-size: 0.9rem;">
                            +91 {{ $m->mobile }}
                        </td>
                        <td style="padding: 1.2rem 1rem; color: #64748b; font-size: 0.85rem; max-width: 200px;">
                            {{ $m->address }}
                        </td>
                        <td style="padding: 1.2rem 1rem; color: #64748b; font-size: 0.9rem;">
                            {{ $m->created_at->format('d M, Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 4rem; text-align: center; color: #94a3b8;">
                            <i class="fas fa-user-friends" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.2;"></i>
                            <p>No other members found in your district yet.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
