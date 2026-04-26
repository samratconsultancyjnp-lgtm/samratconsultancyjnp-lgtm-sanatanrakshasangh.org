@extends('layouts.public')

@section('content')
<section style="padding: 10rem 10% 5rem; background: linear-gradient(rgba(45, 27, 0, 0.85), rgba(45, 27, 0, 0.85)), url('https://images.unsplash.com/photo-1544006659-f0b21f04cb1d?auto=format&fit=crop&w=1500&q=80'); background-size: cover; background-position: center; color: white; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div style="max-width: 600px; width: 100%;">
        <div class="card-glass" style="background: rgba(45, 27, 0, 0.6); border: 2px solid var(--primary); padding: 4rem; box-shadow: 0 20px 50px rgba(0,0,0,0.5);">
            <h1 style="font-size: 3rem; text-align: center; margin-bottom: 1rem; color: var(--primary); text-transform: uppercase;">Daanam <span style="color: var(--accent);">Seva</span></h1>
            <p style="text-align: center; margin-bottom: 3rem; opacity: 0.9; font-size: 1.1rem;">Your contribution is a sacred step towards the protection of Dharma and the service of humanity.</p>

            @if(session('final_success'))
                <div style="text-align: center; background: white; padding: 4rem 2rem; border-radius: 1.5rem; color: var(--text-dark);">
                    <div style="background: #dcfce7; color: #166534; padding: 1.5rem; border-radius: 1rem; margin-bottom: 2rem;">
                        <i class="fas fa-check-circle" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        <h3 style="margin-bottom: 0.5rem;">Successful!</h3>
                        <p>{{ session('final_success') }}</p>
                    </div>
                    <a href="{{ route('home') }}" class="btn-premium" style="width: 100%; display: block;">Back to Home</a>
                </div>
            @elseif(session('donation_success'))
                @php $success = session('donation_success'); @endphp
                <div style="text-align: center; background: white; padding: 2rem; border-radius: 1.5rem; color: var(--text-dark);">
                    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
                        <i class="fas fa-check-circle"></i> Donation record submitted! Please complete the payment.
                    </div>
                    
                    <h3 style="margin-bottom: 1.5rem; color: var(--primary);">Scan to Pay (₹{{ number_format($success['amount']) }})</h3>
                    
                    @php 
                        $upiUrl = "upi://pay?pa=" . $success['upi_id'] . "&pn=Sanatan%20Raksha%20Sangh&am=" . $success['amount'] . "&cu=INR&tn=" . $success['transaction_id'];
                        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode($upiUrl);
                    @endphp
                    
                    <div style="background: #f8fafc; padding: 1.5rem; border-radius: 1rem; display: inline-block; margin-bottom: 2rem; border: 2px solid var(--primary);">
                        <img src="{{ $qrUrl }}" alt="Payment QR Code" style="width: 200px; height: 200px;">
                        <p style="margin-top: 10px; font-weight: 700; font-size: 0.9rem;">UPI ID: {{ $success['upi_id'] }}</p>
                    </div>

                    <div style="text-align: left; background: #f1f5f9; padding: 1.5rem; border-radius: 1rem; margin-bottom: 2rem;">
                        <h4 style="margin-bottom: 1rem; border-bottom: 1px solid #cbd5e1; padding-bottom: 5px;">Bank Account Details</h4>
                        <p><strong>Bank:</strong> {{ $success['bank_name'] }}</p>
                        <p><strong>Account:</strong> {{ $success['account_number'] }}</p>
                        <p><strong>IFSC:</strong> {{ $success['ifsc_code'] }}</p>
                        <p style="margin-top: 10px; font-size: 0.8rem; color: #64748b;">System Ref: {{ $success['transaction_id'] }}</p>
                    </div>

                    <form action="{{ route('donation.submit-payment') }}" method="POST" style="text-align: left;">
                        @csrf
                        <input type="hidden" name="donation_id" value="{{ $success['id'] }}">
                        <div class="form-group">
                            <label style="color: var(--text-dark); font-weight: 700;">Enter Payment Transaction ID / UTR Number <span style="color: red;">*</span></label>
                            <input type="text" name="transaction_id" class="form-control" style="border: 2px solid var(--primary); padding: 1rem;" placeholder="Ex: 123456789012" required>
                        </div>
                        <button type="submit" class="btn-premium" style="width: 100%; padding: 1rem; margin-top: 1rem;">Submit Payment Details</button>
                    </form>
                </div>
            @else
                <form action="{{ route('donation.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label style="color: white;">Full Name</label>
                        <input type="text" name="name" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" required>
                    </div>
                    <div class="form-group">
                        <label style="color: white;">Mobile Number</label>
                        <input type="text" name="mobile" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" required>
                    </div>
                    <div class="form-group">
                        <label style="color: white;">Email Address</label>
                        <input type="email" name="email" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" required>
                    </div>
                    <div class="form-group">
                        <label style="color: white;">PAN Number (Optional)</label>
                        <input type="text" name="pan_number" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" placeholder="ABCDE1234F">
                    </div>
                    <div class="form-group">
                        <label style="color: white;">Donation Amount (₹)</label>
                        <input type="number" name="amount" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" placeholder="Enter amount" required>
                    </div>
                    <div class="form-group">
                        <label style="color: white;">Message (Optional)</label>
                        <textarea name="message" class="form-control" style="background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.2);" rows="2"></textarea>
                    </div>
                    <div style="text-align: center; margin-top: 2rem;">
                        <button type="submit" class="btn-premium" style="width: 100%; padding: 1rem;">Submit & Pay</button>
                    </div>
                </form>
            @endif
            <p style="text-align: center; margin-top: 2rem; font-size: 0.8rem; opacity: 0.7;">Your contribution is safe and will be used for the welfare of society.</p>
        </div>
    </div>
</section>
@endsection

