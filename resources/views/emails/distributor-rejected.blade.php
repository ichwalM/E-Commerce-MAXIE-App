<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #333; padding: 20px; text-align: center; }
        .header h1 { color: white; margin: 0; font-size: 24px; }
        .content { padding: 30px; background-color: #f9f9f9; border: 1px solid #eee; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Application Update</h1>
        </div>
        <div class="content">
            <h2>Hello, {{ $user->name }}</h2>
            <p>Thank you for your interest in becoming a <strong>Maxie Skincare Distributor</strong>.</p>
            <p>We have reviewed your application and, unfortunately, we are unable to approve your distributor account at this time.</p>
            <p>If you have any questions or believe this decision was made in error, please contact our support team.</p>
            <p>Thank you for understanding.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Maxie Skincare. All rights reserved.
        </div>
    </div>
</body>
</html>
