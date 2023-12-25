<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';

    public function createSeeker()
    {
        return view('user.seeker-register');
    }

    public function storeSeeker(Request $request)
    {
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'user_type' => self::JOB_SEEKER,
        ]);

        return redirect()->back();
    }
}
