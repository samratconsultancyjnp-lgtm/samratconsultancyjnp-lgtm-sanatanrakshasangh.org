<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; margin: 0; padding: 0; }
        .id-card {
            width: 350px;
            height: 500px;
            border: 2px solid #1a365d;
            border-radius: 15px;
            position: relative;
            background: white;
            overflow: hidden;
            margin: auto;
        }
        .header {
            background: #1a365d;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header img { width: 100%; height: auto; }
        .photo {
            width: 120px;
            height: 120px;
            border: 3px solid #c5a059;
            margin: 20px auto;
            border-radius: 10px;
            background: #f1f5f9;
        }
        .details {
            padding: 20px;
            text-align: center;
        }
        .details h2 { margin: 0; color: #1a365d; }
        .details p { margin: 5px 0; color: #64748b; font-size: 14px; }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #1a365d;
            height: 40px;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.1;
            font-size: 60px;
            color: #ccc;
            z-index: 0;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="id-card">
        @if($template && $template->watermark)
            <img src="{{ public_path('storage/'.$template->watermark) }}" class="watermark" style="width: 200px;">
        @else
            <div class="watermark">SANATAN</div>
        @endif

        <div class="header">
            @if($template && $template->header)
                <img src="{{ public_path('storage/'.$template->header) }}">
            @else
                <h3 style="margin: 0;">SANATAN RAKSHA SANGH</h3>
            @endif
        </div>

        <div class="photo"></div>

        <div class="details">
            <h2>{{ $member->user->name }}</h2>
            <p><strong>{{ $member->designation->name }}</strong></p>
            <hr style="border: 0.5px solid #eee; margin: 15px 0;">
            <p>ID: SRS-{{ str_pad($member->id, 5, '0', STR_PAD_LEFT) }}</p>
            <p>DOB: {{ $member->dob }}</p>
            <p>Mobile: {{ $member->mobile }}</p>
        </div>

        <div class="footer">
            @if($template && $template->footer)
                <img src="{{ public_path('storage/'.$template->footer) }}" style="width: 100%; height: 40px;">
            @endif
        </div>
    </div>
</body>
</html>
