<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index()
    {
        $jobs = Listing::with('profile')->get();
        return view('home', compact('jobs'));
    }

    public function show(Listing $listing)
    {
        return view('show', compact('listing'));
    }
}
