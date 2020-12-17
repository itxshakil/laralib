<?php

namespace App\Http\Controllers\Api\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\IssueResource;
use App\IssueLog;
use App\Rules\AlreadyNotIssued;
use Illuminate\Http\Response;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $issue =  IssueLog::with('admin', 'user', 'book');

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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $user =  User::where('rollno', $request->rollno)->course($request->course)->first();

        $book =  Book::where('isbn', $request->isbn)->first();

        $request->validate([
            'rollno' => ['required', 'exists:users'],
            'course' => ['required', 'exists:courses,id'],
            'isbn' => ['required', 'exists:books', new AlreadyNotIssued($user)],
        ]);

        $issue =   auth('admin')->user()->issue_logs()->create([
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);

        $book->decrement('count');

        return response($issue, 201);
    }
}
