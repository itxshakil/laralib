<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile' => ['nullable', 'numeric'],
            'message' => ['required', 'string'],
        ]);

        Contact::create($data);

        return back()->with('message', 'Message Sent Successfully');
    }
}
