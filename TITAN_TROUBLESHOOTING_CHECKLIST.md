# Titan Email SMTP Troubleshooting Checklist

## Test Commands to Run on Production Server

### Step 1: Verify .env Settings

```bash
cd /path/to/your/app
grep MAIL .env
```

**Expected output should be:**

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.titan.email
MAIL_PORT=587
MAIL_USERNAME=info@gofreightmate.com
MAIL_PASSWORD=your-password-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

### Step 2: Clear All Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

### Step 3: Test SMTP Connection

```bash
php artisan tinker
```

Then run:

```php
Mail::raw('Test email from production', function($m) {
    $m->to('info@gofreightmate.com')->subject('Production Test');
});
```

### Step 4: Check What Error You Get

**Error: "Connection has been closed unexpectedly"**

-   ❌ Wrong username (must be full email: info@gofreightmate.com)
-   ❌ Wrong password
-   ❌ Need to use App Password if 2FA is enabled

**Error: "Connection could not be established"**

-   ❌ Wrong port (try 587, then 465)
-   ❌ Wrong encryption (try tls, then ssl, then null)
-   ❌ Firewall blocking SMTP

**Error: "Authentication failed"**

-   ❌ Wrong password - double check it
-   ❌ Account locked or suspended
-   ❌ Need App Password for 2FA

### Step 5: Verify Titan Account Settings

Log into your Titan Email dashboard and check:

1. **Username Format:**

    - ✅ Use: `info@gofreightmate.com` (full email)
    - ❌ NOT: `info` or `info@titan.email`

2. **SMTP Settings in Titan:**

    - Check if Titan shows custom SMTP settings
    - Some accounts have different SMTP hosts

3. **2FA/App Password:**

    - If 2FA is enabled, you MUST use an App Password
    - Go to Titan Settings → Security → App Passwords
    - Generate new password and use that in `.env`

4. **IP Whitelisting:**
    - Check if your server IP needs to be whitelisted
    - Some Titan plans require IP whitelisting

### Step 6: Try Different Port/Encryption Combinations

**Test 1: Port 587 with TLS**

```env
MAIL_PORT=587
MAIL_ENCRYPTION=tls
```

**Test 2: Port 465 with SSL**

```env
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
```

**Test 3: Port 587 with STARTTLS**

```env
MAIL_PORT=587
MAIL_ENCRYPTION=starttls
```

**Test 4: Port 25 (if available)**

```env
MAIL_PORT=25
MAIL_ENCRYPTION=null
```

After each change:

```bash
php artisan config:clear
php artisan tinker
# Test again
```

### Step 7: Check Server Firewall

Your server might be blocking outgoing SMTP connections:

```bash
# Test if you can reach Titan SMTP
telnet smtp.titan.email 587
```

If it hangs or says "Connection refused", your firewall is blocking it.

**Solutions:**

-   Contact your hosting provider to open SMTP ports
-   Use API-based email service (SendGrid, Mailgun) instead

### Step 8: Verify Titan SMTP Hostname

Some Titan accounts use different SMTP hosts:

Try these alternatives:

```env
MAIL_HOST=smtp.titan.email
# OR
MAIL_HOST=mail.titan.email
# OR
MAIL_HOST=smtp.gofreightmate.com  (if using custom domain)
```

### Step 9: Test with a Simple PHP Script

Create `test-smtp.php` in your project root:

```php
<?php
require __DIR__.'/vendor/autoload.php';

$transport = (new Swift_SmtpTransport('smtp.titan.email', 587, 'tls'))
    ->setUsername('info@gofreightmate.com')
    ->setPassword('your-password-here');

$mailer = new Swift_Mailer($transport);

$message = (new Swift_Message('Test'))
    ->setFrom(['info@gofreightmate.com' => 'Test'])
    ->setTo(['info@gofreightmate.com'])
    ->setBody('Test email');

try {
    $result = $mailer->send($message);
    echo "SUCCESS! Email sent.\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
```

Run:

```bash
php test-smtp.php
```

This bypasses Laravel and tests SMTP directly.

---

## Common Titan Email Issues & Solutions

### Issue: "Username or Password not accepted"

**Solutions:**

1. Make sure username is FULL email address
2. Check password is correct (copy-paste to avoid typos)
3. If 2FA enabled, generate App Password
4. Try logging into webmail with same credentials

### Issue: "Connection timeout" or "Connection refused"

**Solutions:**

1. Your hosting provider blocks SMTP (common on shared hosting)
2. Switch to SendGrid/Mailgun (they use API, not SMTP)
3. Ask hosting to open ports 587/465

### Issue: "Certificate verification failed" or "SSL error"

**Solutions:**

1. Deploy the updated `config/mail.php` with SSL stream options
2. Try port 587 with TLS instead of 465 with SSL

### Issue: Works in tinker but not in form

**Solutions:**

1. Make sure you deployed updated files
2. Clear cache: `php artisan config:clear`
3. Check CSRF token is working
4. Check JavaScript console for errors

---

## Quick Alternative: Use SendGrid (5 Minutes)

If Titan keeps failing, switch to SendGrid:

1. **Sign up:** https://sendgrid.com/ (free account)
2. **Create API key:** Settings → API Keys → Create API Key
3. **Update .env:**

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-api-key-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

4. **Clear cache and test** - it will work immediately!

**Benefits:**

-   ✅ 100 emails/day free
-   ✅ Works instantly (no SMTP issues)
-   ✅ Better deliverability
-   ✅ Email analytics included
-   ✅ No firewall issues (uses port 587)

---

## What to Send Me

To help you further, please run this and send me the output:

```bash
# Test 1: Check .env
grep MAIL .env

# Test 2: Test connection
php artisan tinker
Mail::raw('Test', function($m) { $m->to('info@gofreightmate.com')->subject('Test'); });
exit

# Test 3: Check logs
tail -50 storage/logs/laravel.log | grep -A 10 "Contact\|Mail"
```

Send me all three outputs and I'll tell you exactly what's wrong! 🔍
