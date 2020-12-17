<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return Response
     */
    public function show(Author $author)
    {
        $author->load('books');

        return view('authors.show', compact('author'));
    }
}
