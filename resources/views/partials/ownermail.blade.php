<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>$subject</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #111827;
            background-color: #f9fafb;
            padding: 20px;
        }

        .email-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            max-width: 600px;
            margin: auto;
        }

        h2 {
            color: #1f2937;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #374151;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>📬 New Contact Message</h2>

        <p><span class="label">User Name:</span> {{ $name }}</p>
        <p><span class="label">Message:</span></p>
        <p>{{ $messageContent }}</p>

        <div class="footer">
            This message was sent via your website contact form.
        </div>
    </div>
</body>

</html>