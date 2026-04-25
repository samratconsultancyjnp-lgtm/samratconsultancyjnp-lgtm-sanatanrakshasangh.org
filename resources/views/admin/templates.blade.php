@extends('layouts.admin')

@section('title', 'Document Templates')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
    <!-- ID Card Template -->
    <div class="card">
        <h3 style="color: var(--admin-primary); margin-bottom: 2rem;"><i class="fas fa-id-card"></i> ID Card Template</h3>
        <form action="{{ route('admin.templates.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="id_card">
            
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.8rem; font-weight: 600;">Header Logo/Image</label>
                @if($idCard && $idCard->header)
                    <img src="{{ asset('storage/'.$idCard->header) }}" style="width: 100%; height: 80px; object-fit: contain; margin-bottom: 1rem; border: 1px solid #eee;">
                @endif
                <input type="file" name="header" style="width: 100%;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.8rem; font-weight: 600;">Watermark Image</label>
                @if($idCard && $idCard->watermark)
                    <img src="{{ asset('storage/'.$idCard->watermark) }}" style="width: 100px; height: 100px; object-fit: contain; margin-bottom: 1rem; border: 1px solid #eee;">
                @endif
                <input type="file" name="watermark" style="width: 100%;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.8rem; font-weight: 600;">Footer Image</label>
                @if($idCard && $idCard->footer)
                    <img src="{{ asset('storage/'.$idCard->footer) }}" style="width: 100%; height: 50px; object-fit: contain; margin-bottom: 1rem; border: 1px solid #eee;">
                @endif
                <input type="file" name="footer" style="width: 100%;">
            </div>

            <button type="submit" class="btn-admin btn-approve" style="width: 100%;">Update ID Card Design</button>
        </form>
    </div>

    <!-- Joining Letter Template -->
    <div class="card">
        <h3 style="color: var(--admin-primary); margin-bottom: 2rem;"><i class="fas fa-file-alt"></i> Joining Letter Template</h3>
        <form action="{{ route('admin.templates.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="joining_letter">
            
            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.8rem; font-weight: 600;">Letterhead Header</label>
                @if($joiningLetter && $joiningLetter->header)
                    <img src="{{ asset('storage/'.$joiningLetter->header) }}" style="width: 100%; height: 100px; object-fit: contain; margin-bottom: 1rem; border: 1px solid #eee;">
                @endif
                <input type="file" name="header" style="width: 100%;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.8rem; font-weight: 600;">Official Stamp (Watermark)</label>
                @if($joiningLetter && $joiningLetter->watermark)
                    <img src="{{ asset('storage/'.$joiningLetter->watermark) }}" style="width: 150px; height: 150px; object-fit: contain; margin-bottom: 1rem; border: 1px solid #eee;">
                @endif
                <input type="file" name="watermark" style="width: 100%;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label style="display: block; margin-bottom: 0.8rem; font-weight: 600;">Letter Footer</label>
                @if($joiningLetter && $joiningLetter->footer)
                    <img src="{{ asset('storage/'.$joiningLetter->footer) }}" style="width: 100%; height: 80px; object-fit: contain; margin-bottom: 1rem; border: 1px solid #eee;">
                @endif
                <input type="file" name="footer" style="width: 100%;">
            </div>

            <button type="submit" class="btn-admin btn-approve" style="width: 100%;">Update Letter Design</button>
        </form>
    </div>
</div>
@endsection
