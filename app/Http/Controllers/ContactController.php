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

            // SAVE TO DATABASE FIRST (never lose a submission!)
            $contact = Contact::create([
                'username' => $request->username,
                'email' => $request->email,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'emailed' => false
            ]);

            Log::info('Contact saved to database', [
                'id' => $contact->id,
                'email' => $request->email,
                'username' => $request->username
            ]);

            // TRY to send email (but don't fail if it doesn't work)
            try {
                Mail::to('info@gofreightmate.com')->send(new ContactMail($request->all()));
                
                // Mark as emailed if successful
                $contact->update(['emailed' => true]);
                
                Log::info('Contact email sent successfully', ['contact_id' => $contact->id]);
            } catch (\Exception $emailError) {
                // Email failed but we have it in database
                Log::warning('Contact saved but email failed', [
                    'contact_id' => $contact->id,
                    'error' => $emailError->getMessage()
                ]);
                // Don't throw - still return success since we saved it
            }

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!'
            ], 200);

        } catch (\Swift_TransportException $e) {
            // SMTP/Mail transport error
            Log::error('Mail transport error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Email service unavailable. Error: ' . $e->getMessage(),
                'debug' => [
                    'type' => 'transport',
                    'mailer' => config('mail.default')
                ]
            ], 500);

        } catch (\Throwable $e) {
            // Log detailed error
            Log::error('Contact form error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message: ' . $e->getMessage(),
                'debug' => [
                    'type' => get_class($e),
                    'file' => basename($e->getFile()),
                    'line' => $e->getLine()
                ]
            ], 500);
        }
    }
}