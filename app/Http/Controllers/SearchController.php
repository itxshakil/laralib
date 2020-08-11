<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $books = Book::search($request->query('q'))
            ->with('authors')
            ->paginate(12);

        return view('search.show', compact('books'));
    }
}
