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
        $users =  User::with('course');

        if ($request->has('course')) {
            $users =  $users->course($request->course);
        }
        if ($request->has('search')) {
            $users =  $users->search($request->search);
        }

        return UserResource::collection($users->paginate(20));
    }

    /**
     * get User By Roll no and Course.
     *
     * @param  \App\Book                 $book
     * @return \Illuminate\Http\Response
     */
    public function userByRollno(Course $course, User $user)
    {
        return $user->loadCount('issued');
    }
}
