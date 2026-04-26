<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 20px; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #fff; }
        .card-container { margin-bottom: 50px; text-align: center; }
        .id-card { width: 325px; height: 205px; display: inline-block; position: relative; border: 1px solid #000; border-radius: 8px; overflow: hidden; background: #fff; margin: 10px; vertical-align: top; }
        
        /* Front Side Styles */
        .header { background: #FF9933; color: white; padding: 8px; text-align: center; }
        .org-name { font-size: 11px; font-weight: bold; text-transform: uppercase; margin: 0; }
        .content { display: flex; padding: 10px; height: 140px; }
        .photo-box { width: 85px; float: left; text-align: center; }
        .photo { width: 75px; height: 85px; border: 2px solid #FF9933; border-radius: 4px; object-fit: cover; }
        .details-box { width: 210px; float: left; padding-left: 10px; text-align: left; }
        .name { font-size: 14px; font-weight: bold; color: #3E1F00; margin-bottom: 2px; }
        .designation { font-size: 10px; color: #FF9933; font-weight: bold; margin-bottom: 8px; text-transform: uppercase; border-bottom: 1px solid #eee; padding-bottom: 2px; }
        .info-row { margin-bottom: 3px; font-size: 9px; }
        .info-label { font-weight: bold; color: #666; display: inline-block; width: 55px; }
        .footer { position: absolute; bottom: 0; width: 100%; background: #3E1F00; color: white; padding: 4px 0; text-align: center; font-size: 7px; }
        
        /* Back Side Styles */
        .back-content { padding: 15px; text-align: center; height: 100%; }
        .back-title { font-size: 12px; font-weight: bold; color: #FF9933; margin-bottom: 10px; border-bottom: 1px solid #FF9933; padding-bottom: 5px; }
        .qr-box { margin-top: 10px; }
        .qr-code { width: 80px; height: 80px; }
        .address-box { font-size: 8px; color: #444; margin-top: 8px; line-height: 1.2; text-align: left; padding: 0 10px; }
        .watermark { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.05; width: 120px; z-index: -1; }
    </style>
</head>
<body>
    <div class="card-container">
        <!-- Front Side -->
        <div class="id-card">
            @if($template && $template->watermark)
                <img src="{{ public_path('storage/' . $template->watermark) }}" class="watermark">
            @endif
            <div class="header">
                <h1 class="org-name">{{ $settings['site_name'] ?? 'Sanatan Raksha Sangh' }}</h1>
                <p style="font-size: 7px; margin: 1px 0 0; opacity: 0.9;">IDENTITY CARD</p>
            </div>
            <div style="width: 80px; height: 95px; border: 1px solid #ddd; padding: 2px; position: absolute; top: 75px; left: 25px; background: white;">
                @if($photoBase64)
                    <img src="{{ $photoBase64 }}" style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 100%; background: #f8f9fa; display: flex; align-items: center; justify-content: center; color: #dee2e6; font-size: 8px; text-align: center;">
                        NO PHOTO<br>AVAILABLE
                    </div>
                @endif
            </div>
            <div style="position: absolute; top: 172px; left: 25px; width: 80px; text-align: center; font-size: 8px; font-weight: bold; color: #333;">
                SRS-{{ str_pad($member->id, 5, '0', STR_PAD_LEFT) }}
            </div>

            <div style="position: absolute; top: 75px; left: 120px; width: 180px;">
                <div style="font-size: 14px; font-weight: 900; color: #2D1B00; text-transform: uppercase; margin-bottom: 2px;">{{ $member->user->name }}</div>
                <div style="font-size: 9px; font-weight: 700; color: #FF6600; text-transform: uppercase; margin-bottom: 8px;">{{ $member->designation->name }}</div>
                
                <table style="width: 100%; font-size: 9px; border-collapse: collapse;">
                    <tr><td style="width: 60px; color: #666;">Father:</td><td style="font-weight: bold;">{{ $member->father_name }}</td></tr>
                    <tr><td style="color: #666;">Mobile:</td><td style="font-weight: bold;">{{ $member->mobile }}</td></tr>
                    <tr><td style="color: #666;">DOB:</td><td style="font-weight: bold;">{{ $member->dob ? date('d-m-Y', strtotime($member->dob)) : 'N/A' }}</td></tr>
                    <tr><td style="color: #666;">Issue Date:</td><td style="font-weight: bold;">{{ $member->created_at->format('d-m-Y') }}</td></tr>
                </table>
            </div>

            <div style="position: absolute; bottom: 0; width: 100%; background: #3E1F00; color: white; text-align: center; font-size: 7px; padding: 4px 0;">
                +91 {{ $settings['contact_phone'] ?? '' }} | {{ $settings['contact_email'] ?? '' }}
            </div>
        </div>

        <!-- Back Side -->
        <div class="id-card" style="margin-left: 20px;">
            <div class="header" style="background: #3E1F00;">
                <h1 class="org-name" style="font-size: 10px;">{{ $settings['site_name'] ?? 'Sanatan Raksha Sangh' }}</h1>
            </div>
            <div style="text-align: center; padding: 10px;">
                <div style="font-size: 11px; font-weight: bold; color: #FF6600; border-bottom: 1px solid #FFD700; display: inline-block; padding-bottom: 2px; margin-bottom: 10px; width: 180px;">
                    Member Verification QR
                </div>
                <br>
                @if($qrBase64)
                    <img src="{{ $qrBase64 }}" style="width: 90px; height: 90px;">
                @else
                    <div style="width: 90px; height: 90px; border: 1px dashed #ccc; display: flex; align-items: center; justify-content: center; font-size: 8px; margin: auto;">QR Error</div>
                @endif
            </div>

            <div style="padding: 0 15px; font-size: 8px; color: #444;">
                <div style="float: left; width: 100%;">
                    <strong>Address:</strong><br>
                    {{ $member->address }}, {{ $member->district }},<br>
                    {{ $member->state }}{{ $member->pincode ? ' - ' . $member->pincode : '' }}
                </div>
            </div>
            <div style="font-size: 6px; margin-top: 10px; color: #999; text-align: center; padding: 0 10px;">
                This card is the property of {{ $settings['site_name'] ?? 'Sanatan Raksha Sangh' }}. If found, please return to the above address.
            </div>
        </div>
    </div>
</body>
</html>
