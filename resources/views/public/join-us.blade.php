@extends('layouts.public')

@section('content')
<section style="padding: 5rem 10%; background: var(--bg-light);">
    <div style="max-width: 800px; margin: 0 auto;">
        <div class="card-glass" style="background: white; border-color: #e2e8f0;">
            <h2 style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem; text-align: center;">Join Sanatan Raksha Sangh</h2>
            <p style="text-align: center; color: #64748b; margin-bottom: 3rem;">Become a part of our mission. Fill out the form below to register as a member.</p>

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
                        <select name="state" id="state" class="form-control" required onchange="updateDistricts()">
                            <option value="">Select State</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
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
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
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
                    <button type="submit" class="btn-premium" style="width: 100%;">Submit Registration</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    const districtData = {
        'Bihar': ['Patna', 'Gaya', 'Bhagalpur', 'Muzaffarpur'],
        'Uttar Pradesh': ['Lucknow', 'Kanpur', 'Varanasi', 'Agra'],
        'Jharkhand': ['Ranchi', 'Jamshedpur', 'Dhanbad', 'Bokaro']
    };

    function updateDistricts() {
        const state = document.getElementById('state').value;
        const districtSelect = document.getElementById('district');
        districtSelect.innerHTML = '<option value="">Select District</option>';
        
        if (state && districtData[state]) {
            districtData[state].forEach(district => {
                const option = document.createElement('option');
                option.value = district;
                option.textContent = district;
                districtSelect.appendChild(option);
            });
        }
    }
</script>
@endsection
