<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; padding: 50px; }
        .letter-head { border-bottom: 2px solid #FF9933; padding-bottom: 20px; margin-bottom: 40px; display: flex; justify-content: space-between; align-items: center; }
        .org-info h1 { color: #FF9933; margin: 0; font-size: 28px; }
        .org-info p { margin: 5px 0; color: #666; font-size: 14px; }
        .date { text-align: right; margin-bottom: 30px; }
        .subject { font-weight: bold; text-decoration: underline; margin: 30px 0; }
        .salutation { margin-bottom: 20px; }
        .body { text-align: justify; margin-bottom: 50px; }
        .signature { margin-top: 50px; }
        .footer { position: fixed; bottom: 0; left: 0; width: 100%; border-top: 1px solid #ddd; padding-top: 10px; font-size: 12px; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="letter-head">
        <div class="org-info">
            <h1>{{ $settings['site_name'] ?? 'Sanatan Raksha Sangh' }}</h1>
            <p>Protection of Heritage | Service of Humanity</p>
        </div>
    </div>

    <div class="date">Date: {{ date('d M, Y') }}</div>

    <div class="recipient">
        To,<br>
        <strong>{{ $member->user->name }}</strong>,<br>
        {{ $member->address }},<br>
        {{ $member->district }}, {{ $member->state }} - {{ $member->pincode }}
    </div>

    <div class="subject">Subject: Appointment as {{ $member->designation->name }}</div>

    <div class="salutation">Namaste {{ $member->user->name }},</div>

    <div class="body">
        <p>We are pleased to welcome you to the <strong>{{ $settings['site_name'] ?? 'Sanatan Raksha Sangh' }}</strong>. Your application for membership has been approved, and we are honored to appoint you as the <strong>{{ $member->designation->name }}</strong> effective from today.</p>

        <p>Our organization is dedicated to the preservation of our cultural values and the upliftment of society through unity and selfless service. We believe that your dedication and passion will be a great asset to our mission.</p>

        <p>As a member, you are expected to uphold the values of Sanatan Dharma and work towards the betterment of the community. We look forward to your active participation in our upcoming events and initiatives.</p>

        <p>Congratulations on your appointment!</p>
    </div>

    <div class="signature">
        Warm Regards,<br><br><br>
        <strong>Authorized Signatory</strong><br>
        {{ $settings['site_name'] ?? 'Sanatan Raksha Sangh' }}
    </div>

    <div class="footer">
        {{ $settings['contact_phone'] ?? '' }} | {{ $settings['contact_email'] ?? '' }}
    </div>
</body>
</html>
