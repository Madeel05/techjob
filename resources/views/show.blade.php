@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img src="{{Storage::url($listing->feature_image)}}" class="card-img-top" alt="Cover Image"
                         style="height: 150px; object-fit: cover;">
                    <div class="card-body">
                        <h2 class="card-title">{{$listing->title}}</h2>
                        <span class="badge bg-primary">{{$listing->job_type}}</span>
                        <p>Salary: {{$listing->salary}}</p>
                        <p>Address: {{$listing->address}}</p>
                        <h4 class="mt-4">Description</h4>
                        <p class="card-text">{!!$listing->description!!}</p>

                        <h4>Roles and Responsibilities</h4>
                        {!! $listing->roles !!}

                        <p class="card-text mt-4">Application closing date: {{$listing->application_close_date}}</p>

                        <a href="#" class="btn btn-primary mt-3">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
