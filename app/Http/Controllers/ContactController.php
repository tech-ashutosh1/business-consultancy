<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display the contact form
     */
    public function show()
    {
        return view('contact');
    }

    /**
     * Handle form submission
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        // Save to database using Contact model
        Contact::create($validated);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}