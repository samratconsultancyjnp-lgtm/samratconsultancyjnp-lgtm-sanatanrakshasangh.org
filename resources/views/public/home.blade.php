@extends('layouts.public')

@section('content')
    <!-- Hero Slider -->
    @php $firstSlider = $sliders->first(); @endphp
    <section class="hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ $firstSlider ? asset('storage/' . $firstSlider->image) : 'https://images.unsplash.com/photo-1544006659-f0b21f04cb1d?auto=format&fit=crop&w=1950&q=80' }}'); background-size: cover; background-position: center;">
        <div style="max-width: 900px; animation: fadeInUp 1.2s ease;">
            <h1 style="text-shadow: 3px 3px 10px rgba(0,0,0,0.5); font-size: 4.5rem; line-height: 1.1; margin-bottom: 2rem;">सेवा ही धर्म है, <br><span style="color: var(--accent);">और धर्म की रक्षा हमारा संकल्प</span></h1>
            <p style="font-size: 1.5rem; margin-bottom: 3rem; opacity: 0.9; font-weight: 500;">सनातनी रक्षा संघ एक सामाजिक एवं धार्मिक संगठन है जो समाज के उत्थान और सनातन धर्म की रक्षा के लिए समर्पित है।</p>
            <div style="display: flex; gap: 1.5rem; justify-content: center;">
                <a href="{{ route('join-us') }}" class="btn-premium" style="font-size: 1.2rem; padding: 1rem 3rem;">Become a Member</a>
                <a href="{{ route('donation') }}" class="btn-premium" style="background: white; color: var(--primary); font-size: 1.2rem; padding: 1rem 3rem;">Support Us</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-grid">
        <div class="stat-item">
            <span class="stat-number">500+</span>
            <span class="stat-label">Families Served</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">160+</span>
            <span class="stat-label">Religious Works</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">450+</span>
            <span class="stat-label">Events Conducted</span>
        </div>
        <div class="stat-item">
            <span class="stat-number">{{ number_format($totalMembers) }}+</span>
            <span class="stat-label">Total Members</span>
        </div>
    </section>

    <!-- President's Message Section -->
    <section class="about-section">
        <div class="about-grid">
            <div class="about-image-container">
                <div class="about-image-blob"></div>
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80" alt="President" class="about-main-img">
            </div>
            <div class="about-content">
                <h4>अध्यक्ष का संदेश</h4>
                <h2>समाज के उत्थान और धर्म की रक्षा <br><span>हमारा प्राथमिक लक्ष्य</span></h2>
                <p>सनातनी रक्षा संघ के माध्यम से हम समाज के हर वर्ग को सशक्त बनाने का प्रयास कर रहे हैं। हमारा मानना है कि सेवा ही सबसे बड़ा धर्म है और अपने धर्म व संस्कृति की रक्षा करना हम सभी का परम कर्तव्य है।</p>
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-hands-helping"></i></div>
                        <div class="stat-number">नि:शुल्क</div>
                        <div class="stat-label">सहायता</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-shield-alt"></i></div>
                        <div class="stat-number">पूर्ण</div>
                        <div class="stat-label">सुरक्षा</div>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="btn-premium" style="margin-top: 2.5rem;">Read Full Message</a>
            </div>
        </div>
    </section>

    <!-- Our Projects Section -->
    <section style="padding: 5rem 10%; background: #f8f8f8;">
        <div class="section-title" style="text-align: center; margin-bottom: 4rem;">
            <h2>हमारे <span>मुख्य प्रकल्प</span></h2>
            <p>हम विभिन्न योजनाओं के माध्यम से समाज सेवा और धर्म रक्षा का कार्य कर रहे हैं।</p>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem;">
            <div class="card-glass" style="background: white; border-color: #eee; text-align: center;">
                <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1.5rem;"><i class="fas fa-khanda"></i></div>
                <h3>सनातनी आत्मरक्षा प्रशिक्षण योजना</h3>
                <p style="color: #666; margin-top: 1rem;">युवाओं और महिलाओं को आत्मरक्षा के लिए प्रशिक्षित करना ताकि वे स्वयं की और धर्म की रक्षा कर सकें।</p>
            </div>
            <div class="card-glass" style="background: white; border-color: #eee; text-align: center;">
                <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1.5rem;"><i class="fas fa-tools"></i></div>
                <h3>आजीविका एवं कौशल विकास अभियान</h3>
                <p style="color: #666; margin-top: 1rem;">बेरोजगार युवाओं को रोजगार परक कौशल सिखाकर उन्हें आर्थिक रूप से स्वावलम्बी बनाना।</p>
            </div>
            <div class="card-glass" style="background: white; border-color: #eee; text-align: center;">
                <div style="font-size: 3rem; color: var(--primary); margin-bottom: 1.5rem;"><i class="fas fa-utensils"></i></div>
                <h3>भोजन एवं जीवन सहायता योजना</h3>
                <p style="color: #666; margin-top: 1rem;">असहाय और जरूरतमंद परिवारों को भोजन और चिकित्सा सहायता उपलब्ध कराना।</p>
            </div>
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
