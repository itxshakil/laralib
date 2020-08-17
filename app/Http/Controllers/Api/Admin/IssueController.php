<?php

namespace App\Http\Controllers\Api\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\IssueResource;
use App\IssueLog;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $issue =  IssueLog::query();

        if ($request->has('issued')) {
            $issue = $issue->issued();
        } else if ($request->has('returned')) {
            $issue = $issue->returned();
        }

        return IssueResource::collection($issue->latest()->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =  User::where('rollno', $request->rollno)->course($request->course)->first();

        $book =  Book::where('isbn', $request->isbn)->first();

        $issue =   auth('admin')->user()->issue_logs()->create([
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);

        $book->decrement('count');

        return response($issue, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book                 $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book                 $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book                 $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
    }
}
