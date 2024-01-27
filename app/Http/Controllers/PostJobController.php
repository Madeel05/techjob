<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostJobFormRequest;
use App\Models\Listing;
use App\Post\JobPost;
use Illuminate\Http\Request;

class PostJobController extends Controller
{
    protected $job;
    public function __construct(JobPost $job){
        $this->job = $job;
    }
    public function create()
    {
        return view('job.create');
    }

    public function store(PostJobFormRequest $request){
        $this->job->store($request);
        return back();
    }

    public function edit(Listing $listing){
        return view('job.edit', compact('listing'));
    }
}
