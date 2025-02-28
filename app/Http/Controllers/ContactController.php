<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:1000'
        ]);

        // Send an email
        Mail::to('admin@example.com')->send(new ContactMail($validatedData));

        // Return a JSON response
        return response()->json(['message' => 'Your message has been sent successfully!'], 200);
    }
}
?>