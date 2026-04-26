<!DOCTYPE html>
<html>
<head>
    <style>
        .container { padding: 20px; font-family: sans-serif; }
        .otp { font-size: 24px; font-weight: bold; color: #FF6600; padding: 10px; border: 2px dashed #FF6600; display: inline-block; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login Verification</h2>
        <p>Namaste,</p>
        <p>You requested to log in to Sanatan Raksha Sangh. Use the following OTP to verify your identity:</p>
        <div class="otp">{{ $otp }}</div>
        <p>This OTP is valid for 10 minutes. If you did not request this, please ignore this email.</p>
        <p>Regards,<br>Sanatan Raksha Sangh Team</p>
    </div>
</body>
</html>
