@extends('layouts.public')

@section('content')
<section style="padding: 10rem 10% 5rem; background: linear-gradient(rgba(45, 27, 0, 0.85), rgba(45, 27, 0, 0.85)), url('https://images.unsplash.com/photo-1544006659-f0b21f04cb1d?auto=format&fit=crop&w=1500&q=80'); background-size: cover; background-position: center; color: white; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 600px; width: 100%;">
        <div class="card-glass" style="background: rgba(45, 27, 0, 0.6); border: 2px solid var(--primary); padding: 4rem; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
            <h1 style="font-size: 3rem; text-align: center; margin-bottom: 1rem; color: var(--primary); text-transform: uppercase;">Daanam <span style="color: var(--accent);">Seva</span></h1>
            <p style="text-align: center; margin-bottom: 3rem; opacity: 0.9; font-size: 1.1rem;">Your contribution is a sacred step towards the protection of Dharma and the service of humanity.</p>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('donation.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label style="color: white;">Full Name</label>
                    <input type="text" name="name" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" required>
                </div>
                <div class="form-group">
                    <label style="color: white;">Email Address</label>
                    <input type="email" name="email" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" required>
                </div>
                <div class="form-group">
                    <label style="color: white;">Donation Amount (₹)</label>
                    <input type="number" name="amount" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" placeholder="Enter amount" required>
                </div>
                <div class="form-group">
                    <label style="color: white;">Message (Optional)</label>
                    <textarea name="message" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" rows="3"></textarea>
                </div>
                <div style="text-align: center; margin-top: 2rem;">
                    <button type="submit" class="btn-premium" style="width: 100%; padding: 1rem;">Process Donation</button>
                </div>
            </form>
            <p style="text-align: center; margin-top: 2rem; font-size: 0.8rem; opacity: 0.7;">Secure payment integration will be available after admin approval.</p>
        </div>
    </div>
</section>
@endsection
