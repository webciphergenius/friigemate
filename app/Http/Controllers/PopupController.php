<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\PopupSubmission;

class PopupController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'userName' => 'required|string|max:255',
                'userEmail' => 'required|email|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // SAVE TO DATABASE FIRST (never lose a submission!)
            $submission = PopupSubmission::create([
                'user_name' => $request->userName,
                'user_email' => $request->userEmail,
                'ip_address' => $request->ip(),
                'emailed' => false
            ]);

            Log::info('Popup submission saved to database', [
                'id' => $submission->id,
                'email' => $request->userEmail,
                'name' => $request->userName
            ]);

            // TODO: Add email functionality if needed
            // For now, just mark as "emailed" since we don't have a specific mail class
            $submission->update(['emailed' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you! We\'ll be in touch soon.'
            ], 200);

        } catch (\Exception $e) {
            // Log detailed error
            Log::error('Popup form error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to submit form: ' . $e->getMessage()
            ], 500);
        }
    }
}
