@extends('layouts.public')

@section('content')
<section style="padding: 5rem 10%; background: white;">
    <h1 style="font-size: 3rem; color: var(--primary); margin-bottom: 2rem; text-align: center;">About Us</h1>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 4rem; align-items: center;">
        <div>
            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="About NGO" style="width: 100%; border-radius: 1.5rem; box-shadow: var(--shadow);">
        </div>
        <div>
            <h2 style="color: var(--secondary); margin-bottom: 1rem;">Our Mission</h2>
            <p style="margin-bottom: 2rem; color: #475569;">{{ $aboutText }}</p>
            
            <h2 style="color: var(--secondary); margin-bottom: 1rem;">Our Vision</h2>
            <p style="color: #475569;">To create a society where every individual has the opportunity to thrive, protecting our cultural values while embracing modern progress. We aim to be the shield for those in need.</p>
            
            <div style="margin-top: 2.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="card-glass" style="background: #f8fafc; padding: 1.5rem;">
                    <h3 style="color: var(--primary);">Integrity</h3>
                    <p style="font-size: 0.9rem;">We maintain absolute transparency in all our actions.</p>
                </div>
                <div class="card-glass" style="background: #f8fafc; padding: 1.5rem;">
                    <h3 style="color: var(--primary);">Service</h3>
                    <p style="font-size: 0.9rem;">Dedicated to the welfare of humanity without bias.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 5rem 10%; background: var(--bg-dark); color: white; text-align: center;">
    <h2 style="font-size: 2.5rem; margin-bottom: 1.5rem; color: var(--accent);">Accreditations</h2>
    <p style="max-width: 800px; margin: 0 auto 3rem; opacity: 0.8;">We are recognized by several national and international bodies for our contributions to social welfare and cultural preservation.</p>
    <div style="display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap;">
        <span style="border: 1px solid var(--glass-border); padding: 1rem 2rem; border-radius: 0.5rem;">ISO 9001:2015</span>
        <span style="border: 1px solid var(--glass-border); padding: 1rem 2rem; border-radius: 0.5rem;">NGO Darpan Verified</span>
        <span style="border: 1px solid var(--glass-border); padding: 1rem 2rem; border-radius: 0.5rem;">80G Certified</span>
    </div>
</section>
@endsection
