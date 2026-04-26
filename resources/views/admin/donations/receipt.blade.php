<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #FF9933; padding-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #FF9933; }
        .receipt-title { font-size: 20px; margin: 20px 0; text-align: center; text-decoration: underline; }
        .details { margin-top: 30px; }
        .row { margin-bottom: 15px; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; border-top: 1px solid #ddd; padding-top: 20px; }
        .stamp { border: 2px solid #FF9933; width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #FF9933; font-weight: bold; position: absolute; bottom: 100px; right: 50px; opacity: 0.5; transform: rotate(-15deg); }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">SANATAN RAKSHA SANGH</div>
        <div>{{ $settings['contact_phone'] ?? '' }} | {{ $settings['contact_email'] ?? '' }}</div>
    </div>

    <div class="receipt-title">DONATION RECEIPT</div>

    <div class="details">
        <div class="row"><span class="label">Receipt No:</span> SRS/{{ date('Y') }}/{{ $donation->id }}</div>
        <div class="row"><span class="label">Date:</span> {{ date('d-m-Y') }}</div>
        <div class="row"><span class="label">Donor Name:</span> {{ $donation->name }}</div>
        <div class="row"><span class="label">Mobile No:</span> {{ $donation->mobile }}</div>
        <div class="row"><span class="label">Amount Paid:</span> <strong>₹{{ number_format($donation->amount, 2) }}</strong></div>
        <div class="row"><span class="label">Transaction ID:</span> {{ $donation->transaction_id }}</div>
        <div class="row"><span class="label">Payment Mode:</span> Online</div>
    </div>

    <p style="margin-top: 40px; line-height: 1.6;">
        We sincerely thank you for your generous contribution towards the Sanatan Raksha Sangh. Your support helps us in our mission to protect and preserve our cultural values and serve society.
    </p>

    <div class="stamp">SRS SEAL</div>

    <div class="footer">
        This is a computer-generated receipt and does not require a physical signature.
    </div>
</body>
</html>
