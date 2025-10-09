# Contact Form Email Setup Guide

## Overview

The contact form on the homepage sends emails to `info@gofreightmate.com` when users submit the form.

## What's Been Fixed

1. **CSRF Token**: Added CSRF token to the welcome page and configured Axios to send it automatically
2. **Vue Component**: Fixed the form data handling and added proper success/error messages
3. **Error Handling**: Improved ContactController with try-catch and logging
4. **Validation**: Made message field optional (nullable)

## Production Email Configuration

For the contact form to work in production, you need to configure your `.env` file with proper SMTP settings:

### Option 1: Using Gmail SMTP (for testing)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-specific-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@gofreightmate.com
MAIL_FROM_NAME="Go FreightMate"
```

### Option 2: Using a Mail Service (Recommended)

For production, use a dedicated email service like:

**Mailgun:**

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.com
MAILGUN_SECRET=your-mailgun-api-key
MAIL_FROM_ADDRESS=noreply@gofreightmate.com
MAIL_FROM_NAME="Go FreightMate"
```

**SendGrid:**

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@gofreightmate.com
MAIL_FROM_NAME="Go FreightMate"
```

**Amazon SES:**

```env
MAIL_MAILER=ses
AWS_ACCESS_KEY_ID=your-aws-key
AWS_SECRET_ACCESS_KEY=your-aws-secret
AWS_DEFAULT_REGION=us-east-1
MAIL_FROM_ADDRESS=noreply@gofreightmate.com
MAIL_FROM_NAME="Go FreightMate"
```

### Option 3: For Testing - Log Emails

If you just want to test without actually sending emails:

```env
MAIL_MAILER=log
```

Emails will be written to `storage/logs/laravel.log`

## Testing the Contact Form

1. Make sure your `.env` file has the correct mail configuration
2. Clear the config cache: `php artisan config:clear`
3. Visit your website and fill out the contact form
4. Check logs at `storage/logs/laravel.log` for any errors

## Troubleshooting

### Form not submitting

-   Check browser console for JavaScript errors
-   Verify CSRF token is present in the page source
-   Check `storage/logs/laravel.log` for server errors

### Email not being sent

-   Verify SMTP credentials are correct
-   Check if your hosting provider blocks outgoing SMTP
-   Review `storage/logs/laravel.log` for mail errors
-   Test with `MAIL_MAILER=log` to verify the form logic works

### 419 CSRF Token Mismatch

-   Clear browser cache and cookies
-   Verify the meta tag is in the HTML: `<meta name="csrf-token" content="...">`
-   Check that axios is sending the X-CSRF-TOKEN header

## Files Modified

-   `resources/views/welcome.blade.php` - Added CSRF meta tag
-   `resources/js/bootstrap.js` - Configured Axios to send CSRF token
-   `resources/js/components/HomePage.vue` - Fixed form data handling
-   `app/Http/Controllers/ContactController.php` - Added error handling and logging
