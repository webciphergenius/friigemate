# Production Troubleshooting - Contact Form

## Error: "Failed to send message. Please try again later."

This error means the server caught an exception when trying to send the email. Here's how to fix it:

### Step 1: Check Your Production `.env` File

Make sure your production server has proper MAIL configuration:

```env
# Current (WRONG - only logs emails, doesn't send them):
MAIL_MAILER=log

# Change to SMTP (or another mailer):
MAIL_MAILER=smtp
MAIL_HOST=smtp.yourprovider.com
MAIL_PORT=587
MAIL_USERNAME=your-smtp-username
MAIL_PASSWORD=your-smtp-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

### Step 2: Clear Cache on Production Server

After updating `.env`, run these commands on your production server:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Step 3: Check Laravel Logs

SSH into your production server and check the logs:

```bash
tail -f storage/logs/laravel.log
```

Look for entries starting with "Contact form error" - this will show you the exact error.

### Step 4: Verify File Permissions

Make sure Laravel can write to the logs directory:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

(Replace `www-data` with your web server user, might be `nginx`, `apache`, or `nobody`)

## Common Issues

### Issue: "Connection refused" or "Connection timed out"

**Cause:** Your hosting provider blocks outgoing SMTP connections
**Solution:**

-   Use your hosting provider's SMTP server
-   Or use a mail service API like Mailgun, SendGrid, or Amazon SES

### Issue: "Authentication failed"

**Cause:** Wrong SMTP credentials
**Solution:**

-   Double-check username/password in `.env`
-   For Gmail, use App Passwords (not regular password)

### Issue: "Address in mailbox given does not comply with RFC 2822"

**Cause:** Invalid email address format in `.env`
**Solution:**

-   Remove quotes if not needed
-   Make sure no extra spaces

### Issue: Still not working

**Cause:** Configuration is cached
**Solution:**

```bash
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
```

## Recommended Mail Services for Production

### 1. Mailgun (Easiest)

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=mg.yourdomain.com
MAILGUN_SECRET=your-api-key
MAILGUN_ENDPOINT=api.mailgun.net
MAIL_FROM_ADDRESS="noreply@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

### 2. SendGrid

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

### 3. Amazon SES

```env
MAIL_MAILER=ses
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
MAIL_FROM_ADDRESS="noreply@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

## Quick Test

To test if mail is configured correctly, run this in your production server:

```bash
php artisan tinker
```

Then in tinker:

```php
Mail::raw('Test email', function($message) {
    $message->to('info@gofreightmate.com')->subject('Test');
});
```

If you get an error, that's your mail configuration issue.

## Need More Help?

Check the detailed error in `storage/logs/laravel.log` after submitting the form. The error log now includes:

-   Exception type
-   Error message
-   File and line number
-   Full stack trace

This will tell you exactly what's wrong.
