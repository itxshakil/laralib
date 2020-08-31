<?php

namespace App\Http\Controllers;

use App\Author;

class AuthorController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $author->load('books');

        return view('authors.show', compact('author'));
    }
}
