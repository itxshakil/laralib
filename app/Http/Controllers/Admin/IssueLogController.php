<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\User;
use App\Course;
use App\IssueLog;
use Illuminate\Http\Request;
use App\Rules\AlreadyNotIssued;
use App\Http\Controllers\Controller;

class IssueLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.issue_logs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses =  Course::all();
        return view('admin/issue_logs.create', compact('courses'));
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

        $request->validate([
            'rollno' => ['required', 'exists:users'],
            'course' => ['required', 'exists:courses,id'],
            'isbn' => ['required', 'exists:books', new AlreadyNotIssued($user)],
        ]);

        auth('admin')->user()->issue_logs()->create([
            'book_id' => $book->id,
            'user_id' => $user->id,
        ]);

        $book->decrement('count');

        return redirect(route('admin.issue_logs.index'));
    }

    /**
     * mark IssueLog as Returned.
     *
     * @param  \App\IssueLog  $issueLog
     * @return \Illuminate\Http\Response
     */
    public function markAsReturn(IssueLog $issueLog)
    {
        $issueLog->update(['returned_at' => now(), 'returned_to' => auth('admin')->id()]);
        $issueLog->book()->increment('count');
        return response('1');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IssueLog  $issueLog
     * @return \Illuminate\Http\Response
     */
    public function edit(IssueLog $issueLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IssueLog  $issueLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueLog $issueLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IssueLog  $issueLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueLog $issueLog)
    {
        //
    }
}
