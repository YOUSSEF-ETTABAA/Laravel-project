<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belkhanfar Driving School - Contact Response</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #007bff;
        }

        .response {
            margin-top: 20px;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Furni Morocco - Contact Response</h1>
        <hr>
        <h3>Hello {{ $mailData['user_name'] }},</h3>
        <p>Thank you for contacting Furni Morocco web site. Here is our response to your inquiry:</p>

        <div class="response">
            <p><strong>Your Question:</strong></p>
            <p>{{ $mailData['question'] }}</p>
            <hr>
            <p><strong>Our Response:</strong></p>
            <p>{{ $mailData['response'] }}</p>
        </div>

        <p>Thank you for choosing Furni Morocco!</p>
        <p>Best regards,<br>Furni Morocco Team</p>
    </div>
</body>

</html>
