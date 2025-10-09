<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactMail;

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

            // Check mail configuration
            $mailMailer = config('mail.default');
            $mailFromAddress = config('mail.from.address');
            
            // Log mail configuration for debugging
            Log::info('Mail configuration', [
                'mailer' => $mailMailer,
                'from_address' => $mailFromAddress,
            ]);

            // Send email
            Mail::to('info@gofreightmate.com')->send(new ContactMail($request->all()));

            // Log success
            Log::info('Contact form submitted successfully', [
                'email' => $request->email,
                'username' => $request->username
            ]);

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