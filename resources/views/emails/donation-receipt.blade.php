<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f4f7f6; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .header { background: #FF9933; color: white; padding: 30px; text-align: center; }
        .content { padding: 40px; }
        .receipt-box { background: #fff8f0; border: 2px dashed #FF9933; padding: 25px; border-radius: 8px; margin: 25px 0; }
        .row { display: flex; justify-content: space-between; margin-bottom: 12px; border-bottom: 1px solid #eee; padding-bottom: 8px; }
        .label { font-weight: bold; color: #666; }
        .footer { background: #3E1F00; color: white; padding: 20px; text-align: center; font-size: 0.9rem; }
        .btn { display: inline-block; padding: 12px 30px; background: #FF9933; color: white; text-decoration: none; border-radius: 25px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0; font-size: 24px;">Donation Receipt</h1>
            <p style="margin: 5px 0 0; opacity: 0.9;">Sanatan Raksha Sangh</p>
        </div>
        <div class="content">
            <h2 style="color: #FF9933;">Namaste {{ $donation->name }},</h2>
            <p>Thank you for your generous contribution. Your support helps us in our mission to protect Dharma and serve humanity. We are pleased to confirm that your donation has been approved.</p>
            
            <div class="receipt-box">
                <div class="row">
                    <span class="label">Transaction ID:</span>
                    <span>{{ $donation->transaction_id }}</span>
                </div>
                <div class="row">
                    <span class="label">Date:</span>
                    <span>{{ $donation->updated_at->format('d M, Y') }}</span>
                </div>
                <div class="row">
                    <span class="label">Amount:</span>
                    <span style="font-size: 1.2rem; font-weight: bold; color: #FF9933;">₹{{ number_format($donation->amount, 2) }}</span>
                </div>
                <div class="row">
                    <span class="label">PAN Number:</span>
                    <span>{{ $donation->pan_number ?? 'N/A' }}</span>
                </div>
            </div>

            <p style="font-size: 0.9rem; color: #666;">This is an electronically generated receipt and does not require a physical signature.</p>
            
            <div style="text-align: center;">
                <a href="{{ config('app.url') }}" class="btn">Visit Our Website</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'Sanatan Raksha Sangh' }}</p>
            <p>{{ $settings['contact_phone'] ?? '' }} | {{ $settings['contact_email'] ?? '' }}</p>
        </div>
    </div>
</body>
</html>
