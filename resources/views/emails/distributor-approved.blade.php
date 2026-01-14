<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #99010A; padding: 20px; text-align: center; }
        .header h1 { color: white; margin: 0; font-size: 24px; }
        .content { padding: 30px; background-color: #f9f9f9; border: 1px solid #eee; }
        .button { display: inline-block; padding: 12px 24px; background-color: #99010A; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; margin-top: 20px; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to the Family!</h1>
        </div>
        <div class="content">
            <h2>Hello, {{ $user->name }}!</h2>
            <p>Congratulations! Your application to become a <strong>Maxie Skincare Distributor</strong> has been approved.</p>
            <p>You now have full access to our Distributor Dashboard, where you can:</p>
            <ul>
                <li>Request stock (make orders)</li>
                <li>Manage your inventory</li>
                <li>Track your sales and revenue</li>
            </ul>
            <p>We are excited to grow together with you.</p>
            
            <center>
                <a href="{{ route('login') }}" class="button">Login to Dashboard</a>
            </center>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Maxie Skincare. All rights reserved.
        </div>
    </div>
</body>
</html>
