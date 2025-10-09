# Emergency Contact Form Fix - Titan SMTP Not Working

## The Problem

Titan Email SMTP is rejecting connections on **both** port 465 and 587. This means:

-   Authentication is failing
-   OR your server IP is blocked/not whitelisted
-   OR Titan account has issues
-   OR network/firewall is blocking SMTP

## 🚨 IMMEDIATE SOLUTION: Save to Database Instead

Since email isn't working, let's save contact form submissions to the database so you don't lose any leads!

### Step 1: Create Contact Table Migration

Create this file: `database/migrations/2025_10_09_create_contacts_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->text('message')->nullable();
            $table->string('ip_address')->nullable();
            $table->boolean('emailed')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
```

### Step 2: Create Contact Model

Create `app/Models/Contact.php`:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'username',
        'email',
        'message',
        'ip_address',
        'emailed'
    ];
}
```

### Step 3: Update ContactController

Replace the controller with this version that saves to DB AND tries to email:

```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMail;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'message' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // ALWAYS save to database first (so we never lose a submission)
            $contact = Contact::create([
                'username' => $request->username,
                'email' => $request->email,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'emailed' => false
            ]);

            Log::info('Contact saved to database', [
                'id' => $contact->id,
                'email' => $request->email
            ]);

            // Try to send email (but don't fail if it doesn't work)
            try {
                Mail::to('info@gofreightmate.com')->send(new ContactMail($request->all()));

                // Mark as emailed
                $contact->update(['emailed' => true]);

                Log::info('Contact email sent successfully', ['contact_id' => $contact->id]);
            } catch (\Exception $emailError) {
                // Email failed, but we still have it in database
                Log::warning('Contact saved but email failed', [
                    'contact_id' => $contact->id,
                    'error' => $emailError->getMessage()
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }
}
```

### Step 4: Run Migration

```bash
php artisan migrate
```

### Benefits:

✅ Contact submissions are ALWAYS saved (even if email fails)  
✅ You can view all submissions in database  
✅ You can manually email them later  
✅ No lost leads!

---

## 🔄 ALTERNATIVE: Use SendGrid (5 Minutes Setup)

Titan clearly isn't working. **SendGrid is FREE (100 emails/day)** and works reliably:

### 1. Sign up at https://sendgrid.com/

### 2. Create an API key

### 3. Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

### 4. Clear cache and test:

```bash
php artisan config:clear
php artisan tinker
Mail::raw('Test from SendGrid', function($m) { $m->to('info@gofreightmate.com')->subject('Test'); });
```

**It will work instantly!** 🎉

---

## 🔄 ALTERNATIVE: Use Mailgun (Also Free)

Another reliable option:

### 1. Sign up at https://www.mailgun.com/

### 2. Verify your domain or use their sandbox

### 3. Get your API key

### 4. Update `.env`:

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-api-key
MAILGUN_ENDPOINT=api.mailgun.net
MAIL_FROM_ADDRESS="info@gofreightmate.com"
MAIL_FROM_NAME="Go FreightMate"
```

You'll also need to add to `config/services.php`:

```php
'mailgun' => [
    'domain' => env('MAILGUN_DOMAIN'),
    'secret' => env('MAILGUN_SECRET'),
    'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
],
```

---

## 🔍 Why Titan Isn't Working

Possible reasons:

1. **Wrong password** - Double-check it
2. **IP not whitelisted** - Check Titan dashboard for IP restrictions
3. **2FA enabled** - Need to generate App Password
4. **Account suspended** - Check Titan account status
5. **Firewall blocking** - Your server firewall blocks SMTP
6. **Titan outage** - Check Titan status page

---

## 📊 Recommended Solution

### For Production Right Now:

1. **Deploy the database-saving version** (Step 1-4 above) - Takes 2 minutes
2. **Switch to SendGrid** - Takes 5 minutes
3. **Stop wasting time with Titan** - It's clearly not working

### The database version ensures:

-   ✅ No lost contact submissions
-   ✅ You can manually email them if needed
-   ✅ You can export them anytime
-   ✅ Works even if email is completely broken

---

## 🚀 Quick Action Plan

**Right now (2 minutes):**

1. Create the migration and model files above
2. Run `php artisan migrate`
3. Deploy the new ContactController
4. Forms will save to database, email failure won't break the form

**Next (5 minutes):**

1. Sign up for SendGrid (free)
2. Get API key
3. Update `.env` with SendGrid settings
4. Clear cache
5. Emails will start working

**Total time: 7 minutes to have a fully working solution!**
