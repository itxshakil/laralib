<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showForm()
    {
        return view('auth.admin.passwords.change');
    }

    public function change(Request $request)
    {
        $request->validate($this->rules());

        $this->changeUserPassword($request->password);

        return redirect('/admin')->with('flash', 'Password changed successfully.');
    }

    /**
     * Get the password confirmation validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'current-password' => ['required', 'password:admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function changeUserPassword($password)
    {
        $user = Auth::guard('admin')->user();

        $user->password = Hash::make($password);
        $user->save();
    }
}
