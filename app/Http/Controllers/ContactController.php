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

            // Send email
            Mail::to('info@gofreightmate.com')->send(new ContactMail($request->all()));

            // Log success
            Log::info('Contact form submitted', [
                'email' => $request->email,
                'username' => $request->username
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!'
            ], 200);

        } catch (\Exception $e) {
            // Log detailed error
            Log::error('Contact form error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            // In production, return generic error. In development, show details
            $errorMessage = app()->environment('production') 
                ? 'Failed to send message. Please try again later.'
                : 'Error: ' . $e->getMessage();

            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ], 500);
        }
    }
}