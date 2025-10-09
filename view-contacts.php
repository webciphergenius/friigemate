<?php
/**
 * Simple script to view contact form submissions
 * Run: php view-contacts.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Contact;

echo "\n========================================\n";
echo "CONTACT FORM SUBMISSIONS\n";
echo "========================================\n\n";

$contacts = Contact::orderBy('created_at', 'desc')->get();

if ($contacts->isEmpty()) {
    echo "No contact submissions yet.\n\n";
} else {
    foreach ($contacts as $contact) {
        echo "ID: {$contact->id}\n";
        echo "Name: {$contact->username}\n";
        echo "Email: {$contact->email}\n";
        echo "Message: " . ($contact->message ?: 'No message') . "\n";
        echo "IP: {$contact->ip_address}\n";
        echo "Emailed: " . ($contact->emailed ? 'YES ✓' : 'NO ✗') . "\n";
        echo "Submitted: {$contact->created_at}\n";
        echo "----------------------------------------\n\n";
    }
    
    echo "Total: " . $contacts->count() . " submissions\n";
    echo "Emailed: " . $contacts->where('emailed', true)->count() . "\n";
    echo "Not Emailed: " . $contacts->where('emailed', false)->count() . "\n\n";
}

