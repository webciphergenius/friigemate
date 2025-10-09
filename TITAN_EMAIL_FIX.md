# Titan Email SMTP Fix

## Issue Found

Your production server is configured with Titan Email SMTP but the connection is being closed:

```
Connection to "smtp.titan.email:587" has been closed unexpectedly
```

## Solution: Update Production `.env` File

### Option 1: Try Port 465 with SSL (Recommended for Titan)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=465
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-titan-email-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

### Option 2: Try Port 587 with TLS and Verification Disabled

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=587
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-titan-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

### Option 3: Queue the Emails (Best for Production)

Instead of sending emails immediately, queue them to prevent timeout issues:

1. Update `.env`:

```env
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=465
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-titan-email-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

2. Run on your server:

```bash
php artisan queue:table
php artisan migrate
php artisan queue:work --daemon
```

3. Update ContactMail to use queue (I'll do this below)

## Important Titan Email Settings

✅ **Make sure:**

-   Username is the FULL email address (info@gofreightmate.com)
-   Password is correct
-   Your server IP might need to be whitelisted in Titan dashboard
-   Use port 465 with SSL (most reliable for Titan)

## After Changing .env

Always run these commands:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Test SMTP Connection

SSH into your server and run:

```bash
php artisan tinker
```

Then test:

```php
Mail::raw('Test', function($m) { $m->to('info@gofreightmate.com')->subject('Test'); });
```

If it works, you'll see no error. If it fails, you'll see the exact error.

## Alternative: Use Titan's App Password

If you have 2FA enabled on your Titan email:

1. Log into Titan webmail
2. Go to Settings → Security
3. Generate an App Password
4. Use that password instead of your regular password in `.env`
