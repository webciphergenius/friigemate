# Contact Form Deployment Instructions

## Problem Identified
Your Titan Email SMTP connection is closing unexpectedly. This is a common issue with SMTP servers.

## Quick Fix (Deploy These Changes)

### Step 1: Update Your Production `.env` File

Try these Titan Email settings (port 465 with SSL works better):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=465
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-actual-titan-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

### Step 2: Clear Cache on Production

SSH into your server and run:
```bash
cd /app  # or wherever your Laravel app is
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Step 3: Choose Sync or Queue

#### Option A: Synchronous (Simpler - No Queue Worker Needed)
If you DON'T have a queue worker running, update `ContactController.php` line 8:

```php
use App\Mail\ContactMailSync;  // Change this line
```

And line 41:
```php
Mail::to('info@gofreightmate.com')->send(new ContactMailSync($request->all()));
```

Then copy `ContactMailSync.php` to your server.

#### Option B: Queued (Better - Requires Queue Worker)
If you HAVE a queue worker running:
1. The code is already set up for queuing (ContactMail implements ShouldQueue)
2. Make sure your queue worker is running: `php artisan queue:work --daemon`
3. Set `QUEUE_CONNECTION=database` in `.env`

### Step 4: Test the SMTP Connection

Before deploying, test if Titan SMTP works:

```bash
php artisan tinker
```

Then run:
```php
Mail::raw('Test from Laravel', function($message) {
    $message->to('info@gofreightmate.com')
            ->subject('SMTP Test');
});
```

If you see no errors, it works! If you see an error, try these:

1. **Try port 587 with TLS** instead:
   ```env
   MAIL_PORT=587
   MAIL_ENCRYPTION=tls
   ```

2. **Check your Titan credentials** - make sure password is correct

3. **Use an App Password** if you have 2FA enabled on Titan

4. **Whitelist your server IP** in Titan's dashboard

### Step 5: Deploy Files to Production

Upload these modified files to your production server:
- `app/Http/Controllers/ContactController.php`
- `app/Mail/ContactMail.php` (queued version) OR `app/Mail/ContactMailSync.php` (sync version)
- `resources/views/contact.blade.php`
- `resources/js/components/HomePage.vue`
- `resources/views/welcome.blade.php`
- `resources/js/bootstrap.js`

### Step 6: Rebuild Frontend Assets

If you're using Vite/Mix:
```bash
npm run build
# or
npm run production
```

### Step 7: Test Again

1. Submit the contact form
2. Check the browser console - you should now see detailed error messages
3. Check `storage/logs/laravel.log` for the exact error

## Alternative: Use a Different Mail Service

If Titan keeps failing, consider using:

### Mailgun (Easy Setup)
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=mg.gofreightmate.com
MAILGUN_SECRET=your-mailgun-api-key
MAIL_FROM_ADDRESS="info@gofreightmate.com"
```

### SendGrid
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
```

### Gmail (For Testing Only)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-gmail@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

## Common Titan Email Issues

1. **"Connection closed"** → Try port 465 with SSL
2. **"Authentication failed"** → Wrong password or need App Password
3. **"Connection timeout"** → Server firewall blocking port 587/465
4. **Still not working** → Check Titan dashboard for server IP restrictions

## Need Help?

Check the logs after each test:
```bash
tail -f storage/logs/laravel.log
```

The new error messages will show you exactly what's wrong!

