<?php

namespace App\Http\Controllers\Api\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::with('authors');
        if ($request->has('search')) {
            $books = $books->search($request->search);
        }
        return BookResource::collection($books->paginate(15));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function isbn(Book $book)
    {
        return $book->only('title', 'count', 'language');
    }
}
