<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function index()
    {
        return view('pages.inquiry');
    }

    public function create(Request $request)
    {
        // Check if the user is a guest (not logged in)
        if (Auth::guest()) {
            return redirect()->route('login')->with('error', 'You must be logged in to submit the form.');
        }

        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Optional file uploads
        ]);

        // Process the form data (e.g., save to database, send email, etc.)
        // Example: Save to database
        // Inquiry::create([
        //     'user_id' => Auth::id(),
        //     'email' => $request->email,
        //     'subject' => $request->subject,
        //     'message' => $request->message,
        // ]);

        // Redirect back with success message
        return redirect()->route('inquiry')->with('success', 'Your inquiry has been submitted successfully!');
    }
}
