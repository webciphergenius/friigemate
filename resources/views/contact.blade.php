<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body>
    <h2>New Message from {{ $contact['username'] }}</h2>
    <p><strong>Email:</strong> {{ $contact['email'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $contact['message'] }}</p>
</body>
</html>
