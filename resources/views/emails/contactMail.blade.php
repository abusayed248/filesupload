<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filesupload.io</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
            color: #51545e;
        }

        table {
            border-spacing: 0;
            width: 100%;
        }

        td {
            padding: 0;
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
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #45a049;
        }

        /* Responsive styles */
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
                            Filesupload.io
                        </div>

                        <!-- Body -->
                        <div class="email-body">
                            <h1>Hello {{ $mailData['name'] }},</h1>
                            <p>{{ $mailData['message'] }}</p>
                            <p>
                                <a href="https://filesupload.io" class="btn">Visit Filesupload.io</a>
                            </p>
                            <p>
                                If you have any questions, feel free to contact us at contact@filesupload.io.
                            </p>
                            <p>Thank you,<br>The Filesupload Support Team</p>
                        </div>

                        <!-- Footer -->
                        <div class="email-footer">
                            &copy; {{ date('d-m-Y') }} Filesupload.io. All rights reserved.
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
