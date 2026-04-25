@extends('layouts.public')

@section('content')
<section style="padding: 5rem 10%; background: #fff;">
    <div style="max-width: 1000px; margin: 0 auto;">
        <a href="{{ route('events') }}" style="color: var(--primary); text-decoration: none; display: flex; align-items: center; margin-bottom: 2rem; font-weight: 600;">
            <i class="fas fa-arrow-left" style="margin-right: 0.5rem;"></i> Back to Events
        </a>
        
        <img src="{{ $event->image ? asset('storage/'.$event->image) : 'https://images.unsplash.com/photo-1521791136064-7986c2923216?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $event->title }}" style="width: 100%; max-height: 500px; object-fit: cover; border-radius: 1.5rem; margin-bottom: 3rem; box-shadow: var(--shadow);">

        <div style="display: grid; grid-template-columns: 1fr 300px; gap: 4rem;">
            <div>
                <h1 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1.5rem;">{{ $event->title }}</h1>
                <div style="color: #475569; line-height: 1.8; font-size: 1.1rem;">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>
            <div>
                <div class="card-glass" style="background: #f8fafc; border-color: #e2e8f0; position: sticky; top: 120px;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--secondary);">Event Details</h3>
                    <div style="margin-bottom: 1rem;">
                        <p style="color: #64748b; font-size: 0.8rem; text-transform: uppercase;">Date</p>
                        <p style="font-weight: 600;"><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
                    </div>
                    <div style="margin-bottom: 1.5rem;">
                        <p style="color: #64748b; font-size: 0.8rem; text-transform: uppercase;">Location</p>
                        <p style="font-weight: 600;"><i class="fas fa-map-marker-alt"></i> Main Office / Virtual</p>
                    </div>
                    <a href="{{ route('join-us') }}" class="btn-premium" style="display: block; text-align: center;">Join This Event</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
