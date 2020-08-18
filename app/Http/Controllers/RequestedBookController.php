<?php

namespace App\Http\Controllers;

use App\RequestedBook;
use Illuminate\Http\Request;

class RequestedBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'author' => ['required', 'alpha', 'max:255'],
            'isbn' => ['nullable', 'digits_between:10,13',],
            'publisher' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'numeric'],
            'message' => ['nullable', 'string'],
            'user_id' => ['sometimes', 'nullable', 'max:255'],
        ]);

        RequestedBook::create($data);
        return back()->with('message', 'Book Request sent successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RequestedBook  $requestedBook
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('requestedbooks.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RequestedBook  $requestedBook
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestedBook $requestedBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RequestedBook  $requestedBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestedBook $requestedBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RequestedBook  $requestedBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestedBook $requestedBook)
    {
        //
    }
}
