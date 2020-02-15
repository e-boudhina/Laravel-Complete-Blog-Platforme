<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    public function index()
    {
        return View('users.index')->with('users',User::all());
    }
    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        session()->flash('success','User role changed to Administrator');
        return redirect()->back();
    }
    public function edit()
    {
return view('users.edit')->with('user',auth()->user());
    }
    public function update(UpdateProfileRequest $request)
    {
        $user =auth()->user();
        $user->update([
            'name' =>$request->name,
            'about' => $request->about
        ]);

        session()->flash('success','User profile updated');
        return redirect()->back();
    }
}
