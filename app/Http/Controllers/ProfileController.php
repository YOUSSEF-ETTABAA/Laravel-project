<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index(){
        return view('profile');
    }
    public function ShowProfile(){
        return view('user.UserProfile');
    }

    public function ShowUpdateForm(){
        return view('user.updateProfile');
    }
    public function updateUserProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(),
            'phone_number' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        $user = User::find(Auth::user()->id);

        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->city = $request->input('city');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    public function updatePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size if needed
        ]);

        $user = User::find(Auth::id());

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads/profile_pictures'), $imageName);
            
            $user->profile_picture = 'uploads/profile_pictures/'.$imageName;
            $user->save();

            return redirect()->back()->with('success', 'Profile picture updated successfully.');
        }

        return redirect()->back()->with('error', 'Failed to update profile picture.');
    }
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if ($user->role === 'admin') {

                return redirect()->route('admin.dashboard');
            } else {

                return redirect()->route('user.profile');
            }
        }
    
        return redirect()->back()->withInput($request->only('email'))->withErrors(["error" => 'Invalid email or password']);
    }
    public function logout(){
        CartItem::where('user_id', Auth::id())->delete();
        Session::flush();
        Auth::logout();
        
        return redirect()->route('login');
    }
}
