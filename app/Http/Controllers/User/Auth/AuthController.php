<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('user.auth.login');
    }

    public function postLogin(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('error', 'Account does not exist. Please register first');
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password is incorrect');
        }

        Auth::login($user);
        $level = UserLevel::find($user->id, 'user_id');
        if (!$level) {
            UserLevel::create([
                'user_id' => $user->id
            ]);
        }
        return redirect('/')->with('success', 'Log in successfully. Welcome ' . $user->display_name);
    }

    public function showRegister()
    {
        return view('user.auth.register');
    }

    public function postRegister(Request $request)
    {
        // validation
        request()->validate([
            'display_name' => 'required',
            'full_name' => 'required',
            'image' => 'required|mimes: jpeg,jpg,webp,png|max:2000',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
        ]);

        if ($request->password !== $request->confirmPassword) {
            return redirect()->back()->with('error', 'Passwords do not match');
        }

        // check whether email exist
        $email = User::where('email', $request->email)->first();
        if ($email) {
            return redirect()->back()->with('error', 'Email already existed.');
        }

        //store image to public
        $image = $request->file('image');
        $image_name = uniqid() . $image->getClientOriginalName();
        $image->move(public_path('/images'), $image_name);

        //store data
        User::create([
            'display_name' => $request->display_name,
            'full_name' => $request->full_name,
            'image' => $image_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'suspended' => 0
        ]);
        return redirect('/login')->with('success', 'Your account is created successfully. Please Log in');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Log out successfully');
    }
}
