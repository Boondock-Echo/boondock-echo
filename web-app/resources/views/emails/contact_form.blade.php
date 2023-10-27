<!DOCTYPE html>
<html>
<head>
    <title>Contact Form Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        h4 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        p {
            margin-bottom: 10px;
        }
        
        
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
        }
        
        .footer p {
            font-size: 12px;
            color: #999999;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
       
        Thank You, {{ $contactData['first_name'] }}, for showing interest in Boondock Echo
       We have received your inquiry and will get in touch with you very soon.
        <p>If you have any further questions or need immediate assistance, please feel free to reach out to us.</p>
        
    </div>
    
    <div class="footer">
        <p>&copy; 2023 Boondock Echo. All rights reserved.</p>
        <p>This email was generated automatically. Please do not reply to this email.</p>
    </div>
</body>
</html>
