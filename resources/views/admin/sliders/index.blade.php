@extends('layouts.admin')

@section('title', 'Home Slider Management')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 350px; gap: 2rem;">
    <!-- Slider List -->
    <div class="card-glass" style="background: white; padding: 2rem; border-radius: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
            <i class="fas fa-list-ul" style="color: var(--primary);"></i> Active Slides
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            @forelse($sliders as $slider)
                <div style="background: #f8fafc; border-radius: 1rem; overflow: hidden; border: 1px solid #e2e8f0; transition: 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <img src="{{ asset('storage/' . $slider->image) }}" style="width: 100%; height: 150px; object-fit: cover;">
                    <div style="padding: 1rem;">
                        <h4 style="margin-bottom: 0.5rem; font-size: 1rem;">{{ $slider->title ?? 'No Title' }}</h4>
                        <p style="font-size: 0.8rem; color: #64748b; margin-bottom: 1rem;">Order: {{ $slider->order }}</p>
                        <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" onsubmit="return confirm('Remove this slide?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="width: 100%; padding: 0.6rem; background: #fee2e2; color: #ef4444; border: none; border-radius: 0.5rem; font-weight: 600; cursor: pointer; transition: 0.3s;">
                                <i class="fas fa-trash-alt"></i> Remove Slide
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #94a3b8;">
                    <i class="fas fa-images" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                    <p>No slider images uploaded yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Upload Form -->
    <div style="position: sticky; top: 100px; height: fit-content;">
        <div class="card-glass" style="background: white; padding: 2rem; border-radius: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 2px dashed var(--primary);">
            <h3 style="margin-bottom: 1rem;">Add New Slide</h3>
            <p style="font-size: 0.85rem; color: var(--secondary); margin-bottom: 1.5rem; font-weight: 600;">
                <i class="fas fa-info-circle"></i> Recommended Size: 1920x800px
            </p>

            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Slider Image <span style="color: red;">*</span></label>
                    <input type="file" name="image" class="form-control" required style="padding: 0.5rem;">
                </div>
                <div class="form-group">
                    <label>Title (Optional)</label>
                    <input type="text" name="title" class="form-control" placeholder="Slide Heading">
                </div>
                <div class="form-group">
                    <label>Description (Optional)</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Short description..."></textarea>
                </div>
                <div class="form-group">
                    <label>Display Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
                <button type="submit" class="btn-premium" style="width: 100%; margin-top: 1rem;">
                    <i class="fas fa-cloud-upload-alt"></i> Upload Slide
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .form-group { margin-bottom: 1.2rem; }
    .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.9rem; color: #475569; }
    .form-control { width: 100%; padding: 0.75rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; background: #f8fafc; }
    .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(255, 153, 51, 0.1); }
    .btn-premium { background: var(--primary); color: white; padding: 0.8rem; border-radius: 0.75rem; border: none; font-weight: 700; cursor: pointer; transition: 0.3s; }
    .btn-premium:hover { background: var(--secondary); transform: translateY(-2px); }
</style>
@endsection
