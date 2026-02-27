<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Notification</title>
    <style>
        body {
            background: #f4f7fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            padding: 40px 0;
        }
        .email-box {
            background: #ffffff;
            margin: 0 auto;
            width: 90%;
            max-width: 600px;
            border-radius: 8px;
            padding: 30px 40px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.08);
        }
        .header {
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h2 {
            color: #1e40af;
            margin: 0;
            font-size: 22px;
        }
        .content {
            font-size: 16px;
            line-height: 1.7;
            color: #374151;
        }
        .content p {
            margin-bottom: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #6b7280;
        }
        .button {
            display: inline-block;
            background: #2563eb;
            color: #ffffff !important;
            padding: 12px 22px;
            border-radius: 6px;
            font-size: 15px;
            text-decoration: none;
            margin-top: 20px;
        }
        .button:hover {
            background: #1e3a8a;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-box">

            <div class="header">
                <h2>📩 Notification from {{ config('app.name') }}</h2>
            </div>

            <div class="content">
                <p>{!! nl2br(e($mailBody)) !!}</p>

                <!-- Optional button example (you can delete it if not needed) -->
                {{--
                <a href="#" class="button">View Details</a>
                --}}
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>

        </div>
    </div>
</body>
</html>
