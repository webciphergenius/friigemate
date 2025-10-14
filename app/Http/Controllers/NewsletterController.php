<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Mail\NewsletterSubscriptionMail;
use App\Models\NewsletterSubscription;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Check if email already exists
            $existingSubscription = NewsletterSubscription::where('email', $request->email)->first();
            
            if ($existingSubscription) {
                if ($existingSubscription->active) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This email is already subscribed to our newsletter.'
                    ], 409);
                } else {
                    // Reactivate subscription
                    $existingSubscription->update([
                        'active' => true,
                        'unsubscribed_at' => null,
                        'emailed' => false
                    ]);
                }
            } else {
                // Create new subscription
                $subscription = NewsletterSubscription::create([
                    'email' => $request->email,
                    'ip_address' => $request->ip(),
                    'emailed' => false,
                    'active' => true,
                    'subscribed_at' => now()
                ]);

                Log::info('Newsletter subscription saved to database', [
                    'id' => $subscription->id,
                    'email' => $request->email
                ]);
            }

            // TRY to send email (but don't fail if it doesn't work)
            try {
                Mail::to($request->email)->send(new NewsletterSubscriptionMail($request->email));
                
                // Mark as emailed if successful
                $subscription = NewsletterSubscription::where('email', $request->email)->first();
                if ($subscription) {
                    $subscription->update(['emailed' => true]);
                }
                
                Log::info('Newsletter subscription email sent successfully', ['email' => $request->email]);
            } catch (\Exception $emailError) {
                // Email failed but we have it in database
                Log::warning('Newsletter subscription saved but email failed', [
                    'email' => $request->email,
                    'error' => $emailError->getMessage()
                ]);
                // Don't throw - still return success since we saved it
            }

            return response()->json([
                'success' => true,
                'message' => 'Subscribed successfully! An email has been sent.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Newsletter subscription error: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'request_data' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to subscribe: ' . $e->getMessage()
            ], 500);
        }
    }
}