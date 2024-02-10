<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'user_type' => self::JOB_SEEKER,
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json('success');

        // return redirect()->route('verification.notice')->with('successMessage', 'Your Account Created Successfully');

    }

    public function createEmployer()
    {
        return view('user.employer-register');
    }

    public function storeEmployer(RegistrationFormRequest $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'user_type' => self::JOB_EMPLOYER,
            'user_trial' => now()->addWeek()
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        // return redirect()->route('verification.notice')->with('successMessage', 'Your Account Created Successfully');
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
        if (Auth::attempt($credentials)) {
            if (auth()->user()->user_type == 'employer') {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        return 'Wrong email or password';
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    public function profile()
    {
        return view('profile.index');
    }

    public function seekerProfile()
    {
        return view('seeker.profile');
    }

    public function update(Request $request)
    {
        if ($request->hasFile('profile_pic')) {
            $image_path = $request->file('profile_pic')->store('profile', 'public');
            User::find(auth()->user()->id)->update(['profile_pic' => $image_path]);
        }

        User::find(auth()->user()->id)->update($request->except('profile_pic'));
        return back()->with('success', 'Your Profile Updated Successfully');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Your Current Password InnCorrect');
        }
        $user->password = Hash::make($request->current_password);
        $user->save();

        return back()->with('success', 'Password Updated Successfully');
    }

    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx',
        ]);

        if ($request->hasFile('resume')) {
            $imagePath = $request->file('resume')->store('resume', 'public');
            User::find(auth()->user()->id)->update(['resume' => $imagePath]);

            return back()->with('success', 'Your Resume Has Been Updated Successfully');
        }
    }
}
