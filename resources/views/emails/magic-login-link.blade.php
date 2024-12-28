<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magic Login Link</title>
</head>
<body>
    <p>Hello {{ $user->name }},</p>
    <p>Click the link below to log in:</p>
    <a href="{{ $url }}">Login Now</a>
</body>
</html>
