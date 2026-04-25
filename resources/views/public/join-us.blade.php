@extends('layouts.public')

@section('content')
<section style="padding: 10rem 10% 5rem; background: var(--bg-light);">
    <div style="max-width: 900px; margin: 0 auto;">
        <div class="card-glass" style="background: white; border: 2px solid var(--primary); padding: 4rem; box-shadow: 0 30px 60px rgba(255,102,0,0.1);">
            <h2 style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem; text-align: center; text-transform: uppercase;">Aatmanirbhar <span style="color: var(--secondary);">Sangathan</span></h2>
            <p style="text-align: center; color: #64748b; margin-bottom: 4rem; font-size: 1.2rem;">Join the Sanatan Raksha Sangh and be a part of the spiritual and social revolution.</p>

            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 2rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('join-us.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name') <span style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email') <span style="color: red; font-size: 0.8rem;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Designation</label>
                        <select name="designation_id" class="form-control" required>
                            <option value="">Select Designation</option>
                            @foreach($designations as $designation)
                                <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>State</label>
                        <select name="state" id="state" class="form-control" required>
                            <option value="">Select State</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Uttar Pradesh" selected>Uttar Pradesh</option>
                            <option value="West Bengal">West Bengal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>District</label>
                        <select name="district" id="district" class="form-control" required>
                            <option value="">Select District</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Full Address</label>
                    <textarea name="address" class="form-control" rows="3" required placeholder="Building No, Street, Landmark...">{{ old('address') }}</textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 2rem;">
                    <button type="submit" class="btn-premium" style="width: 100%;">Create Member Account</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const districtData = {
        'Andhra Pradesh': ['Visakhapatnam', 'Vijayawada', 'Guntur', 'Nellore'],
        'Bihar': ['Patna', 'Gaya', 'Bhagalpur', 'Muzaffarpur', 'Darbhanga'],
        'Delhi': ['New Delhi', 'North Delhi', 'South Delhi', 'East Delhi'],
        'Gujarat': ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot'],
        'Haryana': ['Gurugram', 'Faridabad', 'Panipat', 'Ambala'],
        'Jharkhand': ['Ranchi', 'Jamshedpur', 'Dhanbad', 'Bokaro', 'Deoghar'],
        'Karnataka': ['Bengaluru', 'Mysuru', 'Hubballi', 'Mangaluru'],
        'Madhya Pradesh': ['Indore', 'Bhopal', 'Jabalpur', 'Gwalior'],
        'Maharashtra': ['Mumbai', 'Pune', 'Nagpur', 'Thane', 'Nashik'],
        'Punjab': ['Ludhiana', 'Amritsar', 'Jalandhar', 'Patiala'],
        'Rajasthan': ['Jaipur', 'Jodhpur', 'Kota', 'Bikaner'],
        'Tamil Nadu': ['Chennai', 'Coimbatore', 'Madurai', 'Salem'],
        'Uttar Pradesh': ['Lucknow', 'Kanpur', 'Varanasi', 'Agra', 'Prayagraj', 'Meerut', 'Gorakhpur', 'Ayodhya'],
        'West Bengal': ['Kolkata', 'Howrah', 'Durgapur', 'Siliguri']
    };

    function updateDistricts() {
        const stateSelect = document.getElementById('state');
        const districtSelect = document.getElementById('district');
        const state = stateSelect.value;
        const currentSelection = "{{ old('district') }}";
        
        console.log('Updating districts for:', state); // Debug log
        
        districtSelect.innerHTML = '<option value="">Select District</option>';
        
        if (state && districtData[state]) {
            districtData[state].forEach(district => {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                if (district === currentSelection) {
                    option.selected = true;
                }
                districtSelect.appendChild(option);
            });
            districtSelect.disabled = false;
        } else {
            districtSelect.disabled = true;
        }
    }

    // Add event listener directly
    document.addEventListener('DOMContentLoaded', function() {
        const stateEl = document.getElementById('state');
        if (stateEl) {
            stateEl.addEventListener('change', updateDistricts);
            updateDistricts(); // Initial run
        }
    });
</script>
@endsection
