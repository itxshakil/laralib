<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $courses  = Course::select('id', 'name')->get();
        return view('admin.users.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'course' => ['required', 'numeric', 'exists:courses,id'],
            'rollno' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        Course::find($request->course)->users()->create($request->only('name', 'email', 'rollno', 'password'));

        return redirect(route('admin.users.index'))->with('flash', "User added successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        $user->load('course', 'issue_logs.book')->loadCount('issue_logs');

        $pending_count = $user->issue_logs()->issued()->count();

        return view('admin.users.show', compact('user', 'pending_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $user->load('course');
        $courses = Course::select('id', 'name')->get();
        return view('admin.users.edit', compact('user', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'course' => ['required', 'numeric', 'exists:courses,id'],
            'rollno' => ['required', 'integer'],
        ]);

        $user->update(array_merge($request->only('name', 'email', 'rollno'), ['course_id' => $request->course]));

        return redirect(route('admin.users.index'))->with('flash', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return bool
     * @throws Exception
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }
}
