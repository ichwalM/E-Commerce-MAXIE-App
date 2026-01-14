<!DOCTYPE html>
<html>
<head>
    <title>Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #99010A; text-align: center;">Welcome to Maxie Skincare!</h2>
        <p>Thank you for registering. Please use the following One-Time Password (OTP) to verify your email address and activate your account.</p>
        
        <div style="background-color: #f8f8f8; padding: 20px; text-align: center; margin: 30px 0; border-radius: 4px;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #333;">{{ $otp }}</span>
        </div>
        
        <p>This code will expire in 15 minutes.</p>
        <p>If you did not create an account, no further action is required.</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        <p style="font-size: 12px; color: #aaa; text-align: center;">&copy; {{ date('Y') }} Maxie Skincare. All rights reserved.</p>
    </div>
</body>
</html>
