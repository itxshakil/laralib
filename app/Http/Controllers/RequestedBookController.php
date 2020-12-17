<?php

namespace App\Http\Controllers;

use App\RequestedBook;
use App\Rules\ISBN;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestedBookController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('requestedbooks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', new ISBN,],
            'publisher' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'numeric'],
            'message' => ['nullable', 'string'],
            'user_id' => ['sometimes', 'nullable', 'numeric'],
        ]);

        RequestedBook::create($data);
        return back()->with('message', 'Book Request sent successfully.');
    }
}
