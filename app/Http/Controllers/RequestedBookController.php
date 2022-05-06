<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestedBook;
use App\RequestedBook;
use Illuminate\Http\RedirectResponse;
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
     * @param  \App\Http\Requests\StoreRequestedBook  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequestedBook $request): RedirectResponse
    {
        RequestedBook::create($request->validated());
        return back()->with('message', 'Book Request sent successfully.');
    }
}
