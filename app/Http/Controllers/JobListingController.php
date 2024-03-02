<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index(Request $request)
    {

        $sort = $request->query("sort");
        $job_type = $request->query("job_type");
        $date = $request->query("date");

        $listing = Listing::query();
        if ($sort == 'salary_high_to_low') {
            $listing->orderBy('salary', 'desc');
        } elseif ($sort == 'salary_low_to_high') {
            $listing->orderBy('salary', 'asc');
        }

        if ($date == 'latest') {
            $listing->orderByRaw('CAST(salary AS UNSIGNED) DESC');
        } elseif ($sort == 'oldest') {
            $listing->orderByRaw('CAST(salary AS UNSIGNED) ASC');
        }

        if ($job_type == 'Fulltime') {
            $listing->where('job_type', 'Fulltime');
        } elseif ($job_type == 'Parttime') {
            $listing->where('job_type', 'Parttime');
        } elseif ($job_type == 'Casual') {
            $listing->where('job_type', 'Casual');
        } elseif ($job_type == 'Contract') {
            $listing->where('job_type', 'Contract');
        }

        $jobs = $listing->with('profile')->get();
        return view('home', compact('jobs'));
    }

    public function show(Listing $listing)
    {
        return view('show', compact('listing'));
    }

    public function company($id)
    {
        $company = User::with('jobs')->where('id', $id)->where('user_type', 'employer')->first();
        return view('company', compact('company'));

    }
}
