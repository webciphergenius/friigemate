<?php

/*
 * TITAN EMAIL SMTP CONFIGURATION OPTIONS
 * 
 * If you're having issues with Titan Email SMTP, try these configurations:
 */

// Option 1: TLS on Port 587 (Try this first)
/*
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=587
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
*/

// Option 2: SSL on Port 465 with stream options
/*
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=465
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
*/

// Option 3: No encryption on port 25 (if available)
/*
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=25
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
*/

// Add to config/mail.php in the 'smtp' array if SSL verification is the issue:
return [
    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
            
            // Add these options if SSL verification is causing issues
            'stream' => [
                'ssl' => [
                    'allow_self_signed' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ],
        ],
    ],
];

