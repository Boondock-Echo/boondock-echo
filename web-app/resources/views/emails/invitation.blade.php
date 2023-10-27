<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation to join our platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 10px;
        }
        a {
            color: #ffffff;
            text-decoration: none;
            background-color: #3490dc;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }
        a:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Invitation to join our platform</h1>
        <p>Hello,</p>
        <p>You have been invited to join our platform by: <strong> {{ $account_name }}.</strong></p>
        <p>Use the following link to create your account:</p>
        <p><a href="{{ route('invite.register', ['token' => $invitation->token]) }}">Accept Invitation</a></p>
        <p>Thank you!</p>
    </div>
</body>
</html>
