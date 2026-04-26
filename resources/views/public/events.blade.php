@extends('layouts.public')

@section('content')
<!-- Hero Section for Events -->
<section style="padding: 10rem 10% 6rem; background: linear-gradient(135deg, var(--bg-dark), #4a2800); color: white; text-align: center;">
    <h1 style="font-size: 3.5rem; color: var(--primary); margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 2px;">Dharmic Events</h1>
    <p style="font-size: 1.2rem; max-width: 700px; margin: 0 auto; opacity: 0.9; line-height: 1.8;">
        Join us in our sacred journey of service and protection. Explore our upcoming and past initiatives.
    </p>
</section>

<!-- Events Grid -->
<section style="padding: 6rem 10%; background: #FFF8F0; min-height: 60vh;">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 4rem;">
        @forelse($events as $event)
            <div class="card-glass" style="background: white; padding: 0; overflow: hidden; border: 1px solid rgba(255,102,0,0.1); transition: all 0.4s ease; border-radius: 2rem; box-shadow: 0 20px 40px rgba(0,0,0,0.05);">
                <div style="position: relative;">
                    <img src="{{ $event->image ? asset('storage/'.$event->image) : 'https://images.unsplash.com/photo-1544006659-f0b21f04cb1d?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $event->title }}" style="width: 100%; height: 280px; object-fit: cover;">
                    <div style="position: absolute; top: 20px; left: 20px; background: var(--primary); color: white; padding: 0.5rem 1.5rem; border-radius: 50px; font-weight: 700; font-size: 0.85rem; box-shadow: 0 5px 15px rgba(255,153,51,0.3);">
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M') }}
                    </div>
                </div>
                <div style="padding: 2.5rem;">
                    <h3 style="margin-bottom: 1rem; font-size: 1.8rem; color: var(--text-dark);">{{ $event->title }}</h3>
                    <p style="color: #64748b; font-size: 1rem; margin-bottom: 2rem; line-height: 1.7;">{{ Str::limit($event->description, 140) }}</p>
                    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 1.5rem;">
                        <span style="color: var(--secondary); font-weight: 700;"><i class="fas fa-clock"></i> 10:00 AM</span>
                        <a href="{{ route('events.show', $event->id) }}" class="btn-premium" style="padding: 0.7rem 1.8rem; font-size: 0.9rem;">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 8rem 2rem; background: white; border-radius: 3rem; border: 2px dashed rgba(255,153,51,0.2);">
                <div style="width: 100px; height: 100px; background: #fff5eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                    <i class="fas fa-calendar-alt" style="font-size: 3rem; color: var(--primary); opacity: 0.3;"></i>
                </div>
                <h3 style="font-size: 2rem; color: var(--text-dark); margin-bottom: 1rem;">No Events Scheduled</h3>
                <p style="color: #64748b; max-width: 500px; margin: 0 auto;">We are currently planning our next big initiatives. Stay tuned for updates on our sacred mission.</p>
                <a href="{{ route('home') }}" class="btn-premium" style="margin-top: 2rem;">Back to Home</a>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 6rem; display: flex; justify-content: center;">
        {{ $events->links() }}
    </div>
</section>
@endsection
