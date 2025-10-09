<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body>
    <h2>New Message from {{ $contact['username'] ?? 'Unknown' }}</h2>
    <p><strong>Email:</strong> {{ $contact['email'] ?? 'No email provided' }}</p>
    @if(isset($contact['message']) && !empty($contact['message']))
        <p><strong>Message:</strong></p>
        <p>{{ $contact['message'] }}</p>
    @else
        <p><strong>Message:</strong></p>
        <p><em>No message provided</em></p>
    @endif
</body>
</html>
