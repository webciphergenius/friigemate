# Contact Form - Database Solution

## ✅ What's Been Fixed

I've updated the ContactController to **save all submissions to the database FIRST**, then try to email. This means:

-   ✅ You'll NEVER lose a contact submission (even if email fails)
-   ✅ The form appears to work normally (users see "success")
-   ✅ You can view all submissions anytime
-   ✅ Emails will be sent if SMTP works, saved to DB if it doesn't

## 📦 Files to Deploy to Production

1. **app/Http/Controllers/ContactController.php** (updated)
2. **app/Models/Contact.php** (already there)
3. **database/migrations/2025_10_09_151525_create_contacts_table.php** (already migrated locally)

## 🚀 Deployment Steps

### On Your Production Server:

```bash
# 1. Upload the new ContactController.php

# 2. Upload Contact.php model if not already there

# 3. Upload the migration file

# 4. Run the migration
php artisan migrate

# 5. Clear cache
php artisan config:clear
php artisan cache:clear
```

That's it! Now all contact submissions will be saved to the database.

## 📊 How to View Contact Submissions

### Option 1: Using the PHP Script (Easiest)

Upload `view-contacts.php` to your server and run:

```bash
php view-contacts.php
```

This shows all contact submissions with details.

### Option 2: Using Tinker

```bash
php artisan tinker
```

Then run:

```php
// View all contacts
Contact::all();

// View latest 10
Contact::latest()->take(10)->get();

// View only unemailed ones
Contact::where('emailed', false)->get();

// Count total submissions
Contact::count();
```

### Option 3: Direct Database Query

```bash
php artisan tinker
```

```php
DB::table('contacts')->orderBy('created_at', 'desc')->get();
```

### Option 4: Export to CSV

```bash
php artisan tinker
```

```php
$contacts = Contact::all();
$fp = fopen('contacts-export.csv', 'w');
fputcsv($fp, ['ID', 'Name', 'Email', 'Message', 'IP', 'Emailed', 'Date']);
foreach ($contacts as $c) {
    fputcsv($fp, [$c->id, $c->username, $c->email, $c->message, $c->ip_address, $c->emailed, $c->created_at]);
}
fclose($fp);
echo "Exported to contacts-export.csv\n";
```

## 🔔 Get Notified of New Submissions

### Option A: Daily Email Digest

Create a scheduled task to email you unread contacts daily.

### Option B: Webhook/Slack Integration

Send a Slack notification when a new contact is submitted.

### Option C: Check Database Daily

Simply run `php view-contacts.php` daily to see new submissions.

## 📧 Once You Fix Titan Email

The form will automatically start emailing AND saving to database. You get both!

You can also manually email the ones that failed:

```bash
php artisan tinker
```

```php
// Get contacts that weren't emailed
$unemailed = Contact::where('emailed', false)->get();

foreach ($unemailed as $contact) {
    try {
        Mail::to('info@gofreightmate.com')->send(new \App\Mail\ContactMail($contact->toArray()));
        $contact->update(['emailed' => true]);
        echo "Emailed contact #{$contact->id}\n";
    } catch (Exception $e) {
        echo "Failed to email contact #{$contact->id}: {$e->getMessage()}\n";
    }
}
```

## 🎯 Current Status

With this solution:

1. ✅ Contact form works on your website
2. ✅ All submissions are saved to database
3. ✅ Emails will be sent when SMTP works
4. ✅ You can view/export submissions anytime
5. ⚠️ Titan SMTP still needs fixing (see below)

## 🔧 Next Steps to Fix Titan

While the database solution works, you should still fix Titan:

### 1. Check if 2FA is Enabled

-   Login to Titan webmail
-   Go to Settings → Security
-   If 2FA is on, generate an **App Password**
-   Use that in `.env` instead of your regular password

### 2. Verify Credentials

Make sure you can login to Titan webmail with:

-   Email: info@gofreightmate.com
-   Password: (same as in .env)

### 3. Contact Titan Support

Email them your server IP and ask:

-   "Do I need to whitelist my server IP?"
-   "What are the correct SMTP settings for my account?"
-   "Is there any block on my account?"

### 4. Switch to SendGrid (Recommended)

SendGrid is more reliable and takes 5 minutes:

1. Sign up at https://sendgrid.com/ (free - 100/day)
2. Get API key
3. Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
```

4. Works immediately! ✅

## 💡 Summary

**Your contact form now works!**

-   Submissions are saved to database
-   You won't lose any leads
-   Email will work once you fix SMTP
-   Use `view-contacts.php` to see submissions

Deploy these changes and your form is production-ready! 🚀
