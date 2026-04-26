@extends('layouts.admin')

@section('title', 'Gallery Management')

@section('content')
<div style="display: grid; grid-template-columns: 350px 1fr; gap: 2.5rem; align-items: start;">
    <!-- Album Management -->
    <div class="card" style="position: sticky; top: 2rem;">
        <h3 style="margin-bottom: 2rem; font-size: 1.3rem; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-folder-plus" style="color: var(--admin-primary);"></i> Album Creator
        </h3>
        <form action="{{ route('admin.gallery.album.store') }}" method="POST" style="margin-bottom: 3rem;">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.9rem;">New Album Name</label>
                <input type="text" name="name" class="form-control" placeholder="e.g. Flood Relief 2024" required>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%;">
                <i class="fas fa-plus"></i> Create Album
            </button>
        </form>

        <h4 style="margin-bottom: 1.5rem; color: var(--text-muted); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">Existing Albums</h4>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            @forelse($albums as $album)
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1.2rem; background: #f8fafc; border-radius: 1rem; border: 1px solid #edf2f7; transition: 0.3s;" onmouseover="this.style.borderColor='var(--admin-primary)'" onmouseout="this.style.borderColor='#edf2f7'">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <i class="fas fa-folder" style="color: #cbd5e0;"></i>
                    <span style="font-weight: 600;">{{ $album->name }}</span>
                </div>
                <form action="{{ route('admin.gallery.album.destroy', $album->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" style="color: #e53e3e; border: none; background: none; cursor: pointer; padding: 5px;" onclick="return confirm('Delete album and all its media?')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
            @empty
            <p style="text-align: center; color: var(--text-muted); font-size: 0.9rem; padding: 2rem;">No albums yet.</p>
            @endforelse
        </div>
    </div>

    <!-- Media Upload & Content -->
    <div>
        <div class="card">
            <h3 style="margin-bottom: 2rem; font-size: 1.3rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-cloud-upload-alt" style="color: var(--admin-primary);"></i> Media Uploader
            </h3>
            <form action="{{ route('admin.gallery.media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.9rem;">Select Album</label>
                        <select name="gallery_album_id" class="form-control" required>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.9rem;">Media Type</label>
                        <select name="type" class="form-control" required>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.9rem;">Choose File</label>
                        <input type="file" name="file" class="form-control" style="padding: 0.6rem;" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-upload"></i> Start Upload
                </button>
            </form>
        </div>

        <div class="card">
            <h3 style="margin-bottom: 2rem; font-size: 1.3rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-th-large" style="color: var(--admin-primary);"></i> Media Library
            </h3>
            
            @forelse($albums as $album)
            <div style="margin-bottom: 3rem;">
                <h4 style="margin-bottom: 1.5rem; font-size: 1rem; color: var(--text-muted); border-bottom: 1px solid #edf2f7; padding-bottom: 10px;">
                    {{ $album->name }} ({{ $album->media->count() }} Items)
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.5rem;">
                    @foreach($album->media as $media)
                    <div style="position: relative; group; overflow: hidden; border-radius: 1rem; aspect-ratio: 16/10; border: 1px solid #edf2f7;">
                        @if($media->type == 'image')
                            <img src="{{ asset('storage/'.$media->file_path) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #1A1A1A;">
                                <i class="fas fa-play-circle" style="font-size: 2rem; color: var(--admin-primary);"></i>
                            </div>
                        @endif
                        
                        <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; opacity: 0; transition: 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                            <form action="{{ route('admin.gallery.media.destroy', $media->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: #e53e3e; color: white; border: none; padding: 10px 15px; border-radius: 8px; cursor: pointer; transition: 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            <div style="text-align: center; padding: 5rem 0;">
                <i class="fas fa-images" style="font-size: 3rem; color: #edf2f7; margin-bottom: 1rem; display: block;"></i>
                <p style="color: var(--text-muted);">Library is empty. Create an album to get started.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
