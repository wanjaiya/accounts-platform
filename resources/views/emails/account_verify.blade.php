<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #007bff; /* Replace with your brand color */
            color: white;
            padding: 20px;
            text-align: center;
        }
        .button {
            background-color: #28a745; /* Replace with your brand color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">

            <h1>Email Verification</h1>
        </div>
        <div class="content" style="padding: 20px;">
            <h3>Hello {{ $name }},</h3>
            <p>Thank you for signing up! To complete your registration, please verify your email address by entering the verification code below:</p>


             <h2>{{ $token }}</h2>


            <p>If you did not sign up for an account, please ignore this email.</p>
        </div>
        <div class="footer">
            <p>&copy; 2023 Your Company Name | All Rights Reserved</p>
        </div>
    </div>
</body>
</html>
