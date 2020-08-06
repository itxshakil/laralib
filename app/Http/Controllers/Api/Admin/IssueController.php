<?php

namespace App\Http\Controllers\Api\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
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
    public function index()
    {
        return IssueResource::collection(IssueLog::latest()->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =  User::where('rollno', $request->rollno)->where('course_id', $request->course)->get()->first();

        $book =  Book::where('isbn', $request->isbn)->get()->first();

        return  auth('admin')->user()->issue_logs()->create([
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);
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
