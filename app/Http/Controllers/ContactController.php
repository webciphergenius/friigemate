<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Process the data (e.g., save to database or send email)
        // Example: Save to database
        // Contact::create($request->all());

        // Example: Send email
         Mail::to('info@gofreightmate.com')->send(new ContactMail($request->all()));

        return response()->json(['message' => 'Message sent successfully!'], 200);
    }
}
?>