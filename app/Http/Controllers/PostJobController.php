<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostJobController extends Controller
{
    public function create()
    {
        return view('job.create');
    }
}
