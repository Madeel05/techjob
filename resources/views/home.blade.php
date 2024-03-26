@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h4>Recommended Jobs</h4>
            <div class=" dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Salary
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('listing.index',['sort'=> 'salary_high_to_low'])}}">High
                            to low</a></li>
                    <li><a class="dropdown-item" href="{{route('listing.index',['sort'=> 'salary_low_to_high'])}}">Low
                            to high</a></li>
                </ul>

                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Date
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{route('listing.index',['date'=> 'latest'])}}">Latest</a></li>
                    <li><a class="dropdown-item" href="{{route('listing.index',['date'=> 'oldest'])}}">Oldest</a></li>
                </ul>

                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Job type
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item"
                           href="{{route('listing.index',['job_type'=> 'Fulltime'])}}">Fulltime</a></li>
                    <li><a class="dropdown-item"
                           href="{{route('listing.index',['job_type'=> 'Parttime'])}}">Parttime</a></li>
                    <li><a class="dropdown-item" href="{{route('listing.index',['job_type'=> 'Casual'])}}">Casual</a>
                    </li>
                    <li><a class="dropdown-item"
                           href="{{route('listing.index',['job_type'=> 'Contract'])}}">Contract</a></li>
                </ul>
            </div>
        </div>

        <div class="row mt-2 g-1">
            @foreach($jobs as $job)
                <div class="col-md-3">
                    <x-card :job_type="$job->job_type" :slug="$job->slug" :salary="$job->salary">
                        <x-slot name="image">
                            <img class="rounded-circle" src="{{Storage::url($job->profile->profile_pic)}}" width="100"/>
                        </x-slot>
                        <x-slot name="address" class="d-flex flex-row align-items-center justify-content-center">
                            <small class="ml-1">{{$job->address}}</small>
                        </x-slot>
                        <span class="d-bl>ock font-weight-bold">{{$job->title}}</span>
                        <hr>
                        <span>{{$job->profile->name}}</span>
                    </x-card>
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
