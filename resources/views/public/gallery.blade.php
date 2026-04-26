@extends('layouts.public')

@section('content')
<!-- Hero Section for Gallery -->
<section style="padding: 10rem 10% 6rem; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1544006659-f0b21f04cb1d?auto=format&fit=crop&w=1500&q=80'); background-size: cover; background-position: center; color: white; text-align: center;">
    <h1 style="font-size: 3.5rem; color: var(--primary); margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 2px;">Sacred Glimpses</h1>
    <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto; opacity: 0.9; line-height: 1.8;">Capturing the essence of Sanatan culture and our selfless service to humanity.</p>
</section>

<!-- Gallery Content -->
<section style="padding: 6rem 10%; background: #fff;">
    @forelse($albums as $album)
        <div style="margin-bottom: 6rem;">
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 3rem;">
                <h2 style="font-size: 2.2rem; color: var(--secondary); margin: 0;">{{ $album->name }}</h2>
                <div style="flex: 1; height: 2px; background: linear-gradient(to right, var(--primary), transparent);"></div>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
                @foreach($album->media as $item)
                    <div class="card-glass" style="padding: 0; overflow: hidden; border: 2px solid #f8fafc; height: 280px; border-radius: 1.5rem; transition: all 0.4s ease; box-shadow: 0 10px 20px rgba(0,0,0,0.02);">
                        @if($item->type == 'image')
                            <img src="{{ asset('storage/'.$item->file_path) }}" alt="Gallery Item" style="width: 100%; height: 100%; object-fit: cover; cursor: pointer; transition: 0.5s;" onmouseover="this.style.transform='scale(1.1) rotate(1deg)'" onmouseout="this.style.transform='scale(1)'">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(45deg, #000, #333); cursor: pointer;">
                                <i class="fas fa-play-circle" style="font-size: 4rem; color: var(--primary); filter: drop-shadow(0 0 10px rgba(255,153,51,0.5));"></i>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 10rem 2rem;">
            <i class="far fa-images" style="font-size: 5rem; color: #f1f5f9; margin-bottom: 2rem;"></i>
            <h3 style="font-size: 2rem; color: var(--text-dark); margin-bottom: 1rem;">Gallery is Empty</h3>
            <p style="color: #64748b;">We will be uploading photos and videos of our upcoming events soon.</p>
        </div>
    @endforelse
</section>
@endsection
