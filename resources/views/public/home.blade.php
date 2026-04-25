@extends('layouts.public')

@section('content')
    <!-- Hero Slider -->
    <section class="hero" style="background: linear-gradient(rgba(45, 27, 0, 0.7), rgba(45, 27, 0, 0.7)), url('https://images.unsplash.com/photo-1544006659-f0b21f04cb1d?auto=format&fit=crop&w=1950&q=80');">
        <div style="max-width: 900px; animation: fadeInUp 1.2s ease;">
            @if($sliders->count() > 0)
                <h1 style="text-shadow: 3px 3px 10px rgba(0,0,0,0.5); font-size: 4.5rem; line-height: 1.1; margin-bottom: 2rem;">{{ $sliders->first()->title }}</h1>
                <p style="font-size: 1.5rem; margin-bottom: 3rem; opacity: 0.9; font-weight: 500;">{{ $sliders->first()->description }}</p>
            @else
                <h1 style="text-shadow: 3px 3px 10px rgba(0,0,0,0.5); font-size: 4.5rem; line-height: 1.1; margin-bottom: 2rem;">Raksha Dharma, <br><span style="color: var(--accent);">Serve Humanity</span></h1>
                <p style="font-size: 1.5rem; margin-bottom: 3rem; opacity: 0.9; font-weight: 500;">Dedicated to the preservation of our heritage and the upliftment of the society through unity and selfless service.</p>
            @endif
            <div style="display: flex; gap: 1.5rem; justify-content: center;">
                <a href="{{ route('join-us') }}" class="btn-premium" style="font-size: 1.2rem; padding: 1rem 3rem;">Become a Member</a>
                <a href="{{ route('donation') }}" class="btn-premium" style="background: white; color: var(--primary); font-size: 1.2rem; padding: 1rem 3rem;">Support Us</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-grid">
        <div class="stat-item">
            <span class="stat-number">{{ number_format($totalMembers) }}+</span>
            <span class="stat-label">Members</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $totalProjects }}+</span>
            <span class="stat-label">Projects Completed</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ $totalEvents }}+</span>
            <span class="stat-label">Events Conducted</span>
        </div>
    </section>

    <!-- Progress Bars & Charts -->
    <section style="padding: 5rem 10%;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 4rem; align-items: center;">
            <div>
                <h2 style="font-size: 2.5rem; margin-bottom: 2rem; color: var(--primary);">Our Progress</h2>
                <div style="margin-bottom: 2rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <span>Project Completion</span>
                        <span>85%</span>
                    </div>
                    <div style="background: #e2e8f0; border-radius: 1rem; height: 12px; overflow: hidden;">
                        <div style="background: var(--secondary); width: 85%; height: 100%;"></div>
                    </div>
                </div>
                <div style="margin-bottom: 2rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                        <span>Donation Usage</span>
                        <span>92%</span>
                    </div>
                    <div style="background: #e2e8f0; border-radius: 1rem; height: 12px; overflow: hidden;">
                        <div style="background: var(--accent); width: 92%; height: 100%;"></div>
                    </div>
                </div>
                <p style="color: #64748b;">We maintain 100% transparency in our operations. Our progress reflects the collective effort of our members and donors.</p>
            </div>
            <div class="card-glass" style="background: white; border-color: #e2e8f0;">
                <canvas id="progressChart"></canvas>
            </div>
        </div>
    </section>

    <!-- Recent Events -->
    <section style="padding: 5rem 10%; background: #f1f5f9;">
        <h2 style="text-align: center; font-size: 2.5rem; margin-bottom: 3rem; color: var(--primary);">Recent Events</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem;">
            @forelse($events as $event)
                <div class="card-glass" style="background: white; padding: 0; overflow: hidden; border-color: #e2e8f0;">
                    <img src="{{ $event->image ? asset('storage/'.$event->image) : 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?auto=format&fit=crop&w=500&q=80' }}" alt="{{ $event->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                    <div style="padding: 1.5rem;">
                        <h3 style="margin-bottom: 0.5rem;">{{ $event->title }}</h3>
                        <p style="font-size: 0.9rem; color: #64748b; margin-bottom: 1rem;">{{ Str::limit($event->description, 100) }}</p>
                        <a href="{{ route('events.show', $event->id) }}" style="color: var(--secondary); font-weight: 700; text-decoration: none;">Read More →</a>
                    </div>
                </div>
            @empty
                <p style="text-align: center; grid-column: 1/-1;">No events found.</p>
            @endforelse
        </div>
    </section>

    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Donations Growth (₹)',
                    data: [12000, 19000, 15000, 25000, 22000, 30000],
                    borderColor: '#c5a059',
                    backgroundColor: 'rgba(197, 160, 89, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    </script>
@endsection
