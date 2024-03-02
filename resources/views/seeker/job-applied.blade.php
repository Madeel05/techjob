@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-md-8">
                <h3>Applied Jobs</h3>
                @foreach($user->listing as $job)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$job->title}}</h5>
                            <p class="card-text">Applied At: {{$job->pivot->created_at}}</p>
                            <a href="{{route('jobs.show', [$job->slug])}}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
