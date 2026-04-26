@extends('layouts.admin')

@section('title', 'Website Settings')

@section('content')
<div class="card">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
            <div>
                <h4 style="color: var(--admin-primary); margin-bottom: 2rem; border-bottom: 2px solid var(--admin-bg); padding-bottom: 10px;">General Information</h4>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">NGO Name</label>
                    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Sanatan Raksha Sangh' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Contact Email</label>
                    <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'info@sanatanraksha.org' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Contact Phone</label>
                    <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '+91 800 123 4567' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Mission Statement</label>
                    <textarea name="mission_content" rows="3" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">{{ $settings['mission_content'] ?? '' }}</textarea>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Vision Statement</label>
                    <textarea name="vision_content" rows="3" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">{{ $settings['vision_content'] ?? '' }}</textarea>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Main About Us Content</label>
                    <textarea name="about_content" rows="6" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">{{ $settings['about_content'] ?? '' }}</textarea>
                </div>
            </div>
            <div>
                <h4 style="color: var(--admin-primary); margin-bottom: 2rem; border-bottom: 2px solid var(--admin-bg); padding-bottom: 10px;">Dynamic Stats & SEO</h4>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Total Projects Completed</label>
                    <input type="number" name="total_projects" value="{{ $settings['total_projects'] ?? '45' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Total Events Conducted</label>
                    <input type="number" name="total_events_conducted" value="{{ $settings['total_events_conducted'] ?? '120' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">SEO Meta Title</label>
                    <input type="text" name="meta_title" value="{{ $settings['meta_title'] ?? 'Sanatan Raksha Sangh - Protection & Service' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">SEO Meta Description</label>
                    <textarea name="meta_description" rows="3" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">{{ $settings['meta_description'] ?? '' }}</textarea>
                </div>

                <h4 style="color: var(--admin-primary); margin-top: 3rem; margin-bottom: 2rem; border-bottom: 2px solid var(--admin-bg); padding-bottom: 10px;">Payment Information (QR & Bank)</h4>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">UPI ID (for QR Code)</label>
                    <input type="text" name="upi_id" value="{{ $settings['upi_id'] ?? '' }}" placeholder="name@upi" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ $settings['bank_name'] ?? '' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Account Number</label>
                    <input type="text" name="account_number" value="{{ $settings['account_number'] ?? '' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">IFSC Code</label>
                    <input type="text" name="ifsc_code" value="{{ $settings['ifsc_code'] ?? '' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>

                <h4 style="color: var(--admin-primary); margin-top: 3rem; margin-bottom: 2rem; border-bottom: 2px solid var(--admin-bg); padding-bottom: 10px;">SMTP Mail Settings</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Mail Host</label>
                        <input type="text" name="mail_host" value="{{ $settings['mail_host'] ?? '' }}" placeholder="smtp.gmail.com" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Mail Port</label>
                        <input type="text" name="mail_port" value="{{ $settings['mail_port'] ?? '587' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                    </div>
                </div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Mail Username</label>
                    <input type="text" name="mail_username" value="{{ $settings['mail_username'] ?? '' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Mail Password</label>
                    <input type="password" name="mail_password" value="{{ $settings['mail_password'] ?? '' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Encryption</label>
                        <select name="mail_encryption" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                            <option value="tls" {{ ($settings['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                            <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">From Email</label>
                        <input type="text" name="mail_from_address" value="{{ $settings['mail_from_address'] ?? '' }}" style="width: 100%; padding: 0.8rem; border-radius: 0.8rem; border: 1px solid #edf2f7;">
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 3rem; text-align: center;">
            <button type="submit" class="btn-admin btn-approve" style="padding: 1rem 4rem; font-size: 1.1rem;">Update All Settings</button>
        </div>
    </form>
</div>
@endsection
