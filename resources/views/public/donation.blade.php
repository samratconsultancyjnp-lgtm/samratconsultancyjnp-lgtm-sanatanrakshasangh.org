@extends('layouts.public')

@section('content')
<section style="padding: 5rem 10%; background: linear-gradient(rgba(26, 54, 93, 0.9), rgba(26, 54, 93, 0.9)), url('https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?auto=format&fit=crop&w=1500&q=80'); background-size: cover; background-position: center; color: white; min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 600px; width: 100%;">
        <div class="card-glass" style="background: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.2); padding: 3rem;">
            <h1 style="font-size: 2.5rem; text-align: center; margin-bottom: 1rem; color: var(--accent);">Make a Donation</h1>
            <p style="text-align: center; margin-bottom: 3rem; opacity: 0.9;">Your contribution helps us continue our mission of serving those in need. Every rupee counts.</p>

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
