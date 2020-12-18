<?php

namespace App\Http\Controllers\Api\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
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
     * @param Course $course
     * @param User $user
     * @return User
     */
    public function userByRollno(Course $course, User $user)
    {
        return $user->loadCount('issued');
    }
}
