<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Changed Successfully</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #666666;
            font-size: 16px;
            line-height: 1.5;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 16px;
            color: #333333;
        }
        .details p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #aaaaaa;
            text-align: center;
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
            h1 {
                font-size: 20px;
            }
            p, .details p {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Password Changed Successfully</h1>
        <p>Hello {{ $user->name }},</p>
        <p>Your password has been successfully changed. Below are your updated login details:</p>
        <div class="details">
            <p><strong>Username/Email:</strong> {{ $user->username }} or {{ $user->email }}</p>
            <p><strong>New Password:</strong> {{ $new_password }}</p>
        </div>
        <p>If you did not make this change or you believe an unauthorized person has accessed your account, please contact our support team immediately.</p>
        <p>Thank you,<br>MCMastery</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} MCMastery. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
