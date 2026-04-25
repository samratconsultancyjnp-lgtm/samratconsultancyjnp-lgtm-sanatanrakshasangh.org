@extends('layouts.public')

@section('content')
<section style="padding: 5rem 10%; background: #f8fafc;">
    <h1 style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem; text-align: center;">Our Events</h1>
    <p style="text-align: center; color: #64748b; margin-bottom: 4rem;">Stay updated with our latest initiatives and community programs.</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
        @forelse($events as $event)
            <div class="card-glass" style="background: white; padding: 0; overflow: hidden; border-color: #e2e8f0;">
                <img src="{{ $event->image ? asset('storage/'.$event->image) : 'https://images.unsplash.com/photo-1521791136064-7986c2923216?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $event->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                <div style="padding: 2rem;">
                    <span style="color: var(--secondary); font-weight: 700; font-size: 0.9rem;">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</span>
                    <h3 style="margin: 0.5rem 0 1rem; font-size: 1.5rem;">{{ $event->title }}</h3>
                    <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 1.5rem;">{{ Str::limit($event->description, 120) }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn-premium" style="padding: 0.5rem 1.5rem; font-size: 0.9rem;">Learn More</a>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 5rem;">
                <i class="fas fa-calendar-times" style="font-size: 4rem; color: #e2e8f0; margin-bottom: 1rem; display: block;"></i>
                <p style="color: #64748b;">No upcoming events at the moment. Please check back later.</p>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 4rem;">
        {{ $events->links() }}
    </div>
</section>
@endsection
