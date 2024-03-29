<?php

namespace App\Http\Controllers\Api\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * Get book by ISBN.
     *
     * @param Book $book
     * @return Response
     */
    public function bookByISBN(Book $book)
    {
        return $book->only('title', 'count', 'language');
    }
}
