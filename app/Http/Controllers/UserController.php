<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_EMPLOYER = 'employer';

    public function createSeeker()
    {
        return view('user.seeker-register');
    }

    public function storeSeeker(RegistrationFormRequest $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'user_type' => self::JOB_SEEKER,
        ]);

        return redirect()->route('login')->with('successMessage', 'Your Account Created Successfully');

    }

    public function createEmployer()
    {
        return view('user.employer-register');
    }

    public function storeEmployer(RegistrationFormRequest $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'user_type' => self::JOB_EMPLOYER,
            'user_trial' => now()->addWeek()
        ]);

        return redirect()->route('login')->with('successMessage', 'Your Account Created Successfully');
    }

    public function login()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }

        return 'Wrong email or password';
    }

    public function logout(){
        auth()->logout();

        return redirect()->route('login');
    }
}
