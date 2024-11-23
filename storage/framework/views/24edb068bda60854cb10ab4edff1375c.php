<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
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
        .button {
            display: inline-block;
            padding: 12px 24px;
            font-size: 16px;
            color: #ffffff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
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
            p {
                font-size: 14px;
            }
            .button {
                font-size: 14px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reset Your Password</h1>
        <p>Hello, <?php echo e($user->name); ?></p>
        <p>We received a request to reset your password. Click the button below to reset it:</p>
        <a href="<?php echo e($actionlink); ?>" target="_blank" class="button">Reset Password</a>
        <p>If you did not request a password reset, please ignore this email or contact support if you have any concerns.</p>
        <p>Thank you,<br>MCMastery</p>
        <div class="footer">
            <p>&copy; <?php echo e(date('Y')); ?> MCMastery. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\mcmastery\resources\views/email-templates/forgot-template.blade.php ENDPATH**/ ?>