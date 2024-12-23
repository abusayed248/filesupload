<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Login Link</title>
</head>
<body>
    <h1>Login to Your Account</h1>
    <p>Click the link below to log in:</p>
    <p><a href="{{ $magicLinkUrl }}">Login with Magic Link</a></p>
    <p>This link will expire in 15 minutes.</p>
</body>
</html>
