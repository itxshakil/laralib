<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Author;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Rules\ISBN;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $authors = Author::all();
        return view('admin.books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->only('title', 'isbn', 'count', 'language'));
        $book->authors()->sync($request->authors);

        return redirect(route('admin.books.index'))->with('flash', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return Response
     */
    public function show(Book $book)
    {
        $book->load('issue_logs.user')->loadCount('issue_logs');

        $pending_count = $book->issue_logs()->issued()->count();
        return view('admin.books.show', compact('book', 'pending_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return Response
     */
    public function edit(Book $book)
    {
        $book_authors = $book->authors()->pluck('id');

        $authors =  Author::all();
        return view('admin.books.edit', compact('book', 'authors', 'book_authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'isbn' => ['required', new ISBN, Rule::unique('books')->ignore($book)],
            'count' => ['required', 'integer'],
            'language' => ['required', 'string'],
            'authors' => ['required', 'array']
        ]);

        $book->update($request->only('title', 'isbn', 'count', 'language'));
        $book->authors()->sync($request->authors);

        return redirect(route('admin.books.index'))->with('flash', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return bool
     * @throws Exception
     */
    public function destroy(Book $book)
    {
        return $book->delete();
    }
}
