<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController
{
    public function __invoke(Request $request)
    {
        if ($request->filled('website')) {
            info('bot detected', [
                'website' => $request->website,
                'ip' => $request->ip(),
            ]);

            return back()->with('message', 'Thanks for your message. We\'ll be in touch.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile' => ['nullable', 'numeric'],
            'message' => ['required', 'string'],
        ]);

        Contact::create($data);

        return back()->with('message', 'Thanks for your message. We\'ll be in touch.');
    }
}
