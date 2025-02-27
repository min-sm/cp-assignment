<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\InquiryImage;
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
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'files' => 'nullable|max:3',
            'files.*' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $inquiry = Inquiry::create([
            'user_id' => Auth::id(),
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Handle file uploads (if any)
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Store the file in the 'public/inquiry_images' directory
                $path = $file->store('img/inquiry/' . $inquiry->id, 'public');

                // Save the image path to the inquiry_images table
                InquiryImage::create([
                    'inquiry_id' => $inquiry->id,
                    'image_path' => $path,
                ]);
            }
        }

        // Redirect back with success message
        return redirect()->route('inquiry')->with('success', 'Your inquiry has been submitted successfully!');
    }
}
