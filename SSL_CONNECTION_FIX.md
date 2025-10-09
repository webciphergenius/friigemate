# SSL Connection Reset Fix - Titan Email

## Error You're Getting

```
Connection could not be established with host "ssl://smtp.titan.email:465":
stream_socket_client(): SSL: Connection reset by peer
```

## The Problem

Titan Email SMTP server is rejecting the SSL handshake. This happens when:

1. SSL verification is too strict
2. The server certificate doesn't match
3. Wrong encryption/port combination

## ✅ SOLUTION 1: Use TLS on Port 587 (RECOMMENDED)

Update your production `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=587
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-actual-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

Then run:

```bash
php artisan config:clear
php artisan cache:clear
```

## ✅ SOLUTION 2: Disable SSL Verification (If Solution 1 Doesn't Work)

I've already updated `config/mail.php` to include SSL stream options that disable strict verification.

Now you just need to deploy the updated `config/mail.php` file to your production server and run:

```bash
php artisan config:clear
```

The configuration now includes:

-   `allow_self_signed` → allows self-signed certificates
-   `verify_peer` → disables peer verification
-   `verify_peer_name` → disables hostname verification

## ✅ SOLUTION 3: Use Titan's Alternative SMTP Settings

Titan Email often has multiple SMTP endpoints. Try these:

**Option A: Standard SMTP**

```env
MAIL_HOST=smtp.titan.email
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

**Option B: Secure SMTP (if available)**

```env
MAIL_HOST=smtp.titan.email
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
```

**Option C: Submission Port**

```env
MAIL_HOST=smtp.titan.email
MAIL_PORT=587
MAIL_ENCRYPTION=starttls
```

## 🔧 Testing After Each Change

Always test after updating .env:

```bash
# Clear config
php artisan config:clear

# Test in tinker
php artisan tinker

# In tinker, run:
Mail::raw('Testing Titan SMTP', function($m) {
    $m->to('info@gofreightmate.com')->subject('Test');
});

# If successful, you'll see: = Symfony\Component\Mailer\SentMessage
# If failed, you'll see the error
```

## 🚀 Files to Deploy

Deploy these updated files to your production server:

1. **config/mail.php** (updated with SSL stream options)
2. **app/Http/Controllers/ContactController.php** (better error handling)
3. **app/Mail/ContactMail.php** (with queue support)
4. **resources/views/contact.blade.php** (null-safe)
5. **resources/js/components/HomePage.vue** (detailed errors)
6. **resources/views/welcome.blade.php** (CSRF token)
7. **resources/js/bootstrap.js** (CSRF handling)

After deploying, run:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
npm run build  # if you changed JS/Vue files
```

## 🔄 Still Not Working? Alternative Mail Services

If Titan Email continues to have issues, I recommend switching to a more reliable service:

### SendGrid (Most Reliable)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

Free tier: 100 emails/day

### Mailgun (Easy Setup)

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=mg.gofreightmate.com
MAILGUN_SECRET=your-api-key
MAILGUN_ENDPOINT=api.mailgun.net
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

Free tier: 100 emails/day for 3 months

### Amazon SES (Cheapest for Volume)

```env
MAIL_MAILER=ses
AWS_ACCESS_KEY_ID=your-key
AWS_SECRET_ACCESS_KEY=your-secret
AWS_DEFAULT_REGION=us-east-1
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

$0.10 per 1,000 emails

## 📊 Troubleshooting Checklist

-   [ ] Updated `.env` with port 587 and TLS
-   [ ] Deployed new `config/mail.php` with SSL stream options
-   [ ] Ran `php artisan config:clear`
-   [ ] Tested with `php artisan tinker`
-   [ ] Checked `storage/logs/laravel.log` for errors
-   [ ] Verified Titan password is correct
-   [ ] Tried without SSL verification
-   [ ] Considered alternative mail service

## 💡 Pro Tip

For production, I recommend using **SendGrid** or **Mailgun** instead of Titan Email. They're:

-   More reliable
-   Better error messages
-   Free tier available
-   Easier to configure
-   Better deliverability

Just sign up, get an API key, update `.env`, and it works! 🎉
