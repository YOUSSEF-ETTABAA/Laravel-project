<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showSignUpForm(){
        return view('user.signUp');
    }
    public function index(){
        return view('user.profile');
    }
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->city = $request->input('city');
        $user->password = bcrypt($request->input('password')); 
        $user->save();


        return redirect()->back()->with('success', 'User registered successfully!');
    }

}
