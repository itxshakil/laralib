<?php

namespace App\Http\Controllers\Api\Admin;

use App\Book;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users =  User::query();

        if ($request->has('course')) {
            $users =  $users->course($request->course);
        }
        if ($request->has('search')) {
            $users =  $users->search($request->search);
        }

        return UserResource::collection($users->with('course')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book                 $book
     * @return \Illuminate\Http\Response
     */
    public function rollno(Course $course, User $user)
    {
        return $user->loadCount('alreadyIssued');
    }
}
