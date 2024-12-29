<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Login Link</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f7;
            color: #51545e;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 20px 0;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }

        .email-body {
            padding: 30px;
            line-height: 1.6;
            font-size: 16px;
            color: #51545e;
        }

        .email-body h1 {
            margin-top: 0;
            color: #333333;
            font-size: 22px;
            text-align: center;
        }

        .email-body p {
            margin: 15px 0;
        }

        .email-footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f7;
            font-size: 14px;
            color: #6c757d;
        }

        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }

        .btn:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 20px;
            }

            .email-header {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <table>
            <tr>
                <td>
                    <div class="email-content">
                        <!-- Header -->
                        <div class="email-header">
                            Login to Your Account
                        </div>

                        <!-- Body -->
                        <div class="email-body">
                            <h1>Welcome Back!</h1>
                            <p>We received a request to log in to your account. Click the button below to log in:</p>
                            <p style="text-align: center;">
                                <a href="{{ $magicLinkUrl }}" class="btn">Login with Link</a>
                            </p>
                            <p style="text-align: center;">This link will expire in 15 minutes. If you didn’t request this, you can safely ignore this email.</p>
                        </div>

                        <!-- Footer -->
                        <div class="email-footer">
                            &copy; {{ date('d-m-Y') }} FilesUpload.io All rights reserved.
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>

