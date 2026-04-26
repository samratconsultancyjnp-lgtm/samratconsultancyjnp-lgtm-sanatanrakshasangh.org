@extends('layouts.admin')

@section('title', 'Designation Management')

@section('content')
<div style="display: grid; grid-template-columns: 400px 1fr; gap: 2.5rem; align-items: start;">
    <div class="card" style="position: sticky; top: 2rem;">
        <h3 style="margin-bottom: 2rem; font-size: 1.3rem; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-id-badge" style="color: var(--admin-primary);"></i> New Designation
        </h3>
        <form action="{{ route('admin.designations.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.9rem;">Designation Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. State President" required>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%;">
                <i class="fas fa-plus"></i> Add Designation
            </button>
        </form>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Designation Name</th>
                    <th>Created At</th>
                    <th style="text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($designations as $designation)
                <tr>
                    <td style="font-weight: 700; color: var(--text-main);">{{ $designation->name }}</td>
                    <td style="color: var(--text-muted);">{{ $designation->created_at->format('d M, Y') }}</td>
                    <td style="text-align: right;">
                        <form action="{{ route('admin.designations.destroy', $designation->id) }}" method="POST" style="display: inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-admin btn-reject" style="padding: 0.5rem 1rem;" onclick="return confirm('Delete designation?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
