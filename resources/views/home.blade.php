@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h4>Recommended Jobs</h4>
            <button class="btn btn-dark">View</button>
        </div>

        <div class="row mt-2 g-1">
            @foreach($jobs as $job)
                <div class="col-md-3">
                    <div class="card p-2">
                        <div class="text-right"><small class="badge text-bg-info">{{$job->job_type}}</small></div>
                        <div class="text-center mt-2 p-3"><img class="rounded-circle"
                                                               src="{{Storage::url($job->profile->profile_pic)}}"
                                                               width="100"/> <br>
                            <span class="d-bl>ock font-weight-bold">{{$job->title}}</span>
                            <hr>
                            <span>{{$job->profile->name}}</span>
                            <div class="d-flex flex-row align-items-center justify-content-center">
                                <small class="ml-1">{{$job->address}}</small>
                            </div>
                            <div class="d-flex justify-content-between mt-3"><span>${{$job->salary}}</span>
                                <a href="{{route('jobs.show',[$job->slug])}}">
                                    <button class="btn btn-dark">Apply Now</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        .card:hover {
            background-color: #efefef;
        }
    </style>
@endsection
