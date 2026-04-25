@extends('layouts.public')

@section('content')
    <!-- Hero Slider -->
    <section class="hero">
        @if($sliders->count() > 0)
            <h1>{{ $sliders->first()->title }}</h1>
            <p>{{ $sliders->first()->description }}</p>
        @else
            <h1>Empowering Humanity</h1>
            <p>Join us in our mission to protect and serve. Together, we can make a significant impact on lives and preserve our rich heritage.</p>
        @endif
        <a href="{{ route('join-us') }}" class="btn-premium">Join Our Mission</a>
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
