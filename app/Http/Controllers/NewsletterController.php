<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\NewsletterSubscriptionMail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Send Subscription Email
        Mail::to($request->email)->send(new NewsletterSubscriptionMail($request->email));

        return response()->json(['message' => 'Subscribed successfully! An email has been sent.'], 200);
    }
}

?>