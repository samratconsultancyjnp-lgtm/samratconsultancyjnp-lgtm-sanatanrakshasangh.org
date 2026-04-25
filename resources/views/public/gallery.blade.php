@extends('layouts.public')

@section('content')
<section style="padding: 5rem 10%;">
    <h1 style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem; text-align: center;">Photo & Video Gallery</h1>
    <p style="text-align: center; color: #64748b; margin-bottom: 4rem;">A glimpse into our impactful journey and community service.</p>

    @forelse($albums as $album)
        <div style="margin-bottom: 5rem;">
            <h2 style="font-size: 2rem; color: var(--secondary); margin-bottom: 2rem; border-left: 5px solid var(--accent); padding-left: 1rem;">{{ $album->name }}</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.5rem;">
                @foreach($album->media as $item)
                    <div class="card-glass" style="padding: 0; overflow: hidden; border-color: #e2e8f0; height: 200px;">
                        @if($item->type == 'image')
                            <img src="{{ asset('storage/'.$item->file_path) }}" alt="Gallery Item" style="width: 100%; height: 100%; object-fit: cover; cursor: pointer; transition: 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #000;">
                                <i class="fas fa-play-circle" style="font-size: 3rem; color: white;"></i>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p style="text-align: center; color: #64748b;">No albums found in the gallery.</p>
    @endforelse
</section>
@endsection
