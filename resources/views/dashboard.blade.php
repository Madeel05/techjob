@extends('layouts.app')

@section('content')

    <div class="container mt-5 text-center">
        Hello, {{auth()->user()->name}}
        @if(auth()->check() && Auth::user()->user_type === 'employer')
        <p>Your trial {{now()->format('Y-m-d') > auth()->user()->user_trial ? 'was expire' : 'will expire'}} on {{Auth::user()->user_trial}}</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card-counter primary">
                    <p class="text-counter mt-3 lead">
                        User Profile
                    </p>
                    <button class="btn btn-primary float-end">
                            View
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-counter danger">
                    <p class="text-counter mt-3 lead">
                        Post Job
                    </p>
                    <button class="btn btn-primary float-end">
                        View
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-counter success">
                    <p class="text-counter mt-3 lead">
                        All Jobs
                    </p>
                    <button class="btn btn-primary float-end">
                        View
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-counter info">
                    <p class="text-counter mt-3 lead">
                        Item 4
                    </p>
                    <button class="btn btn-primary float-end">
                        View
                    </button>
                </div>
            </div>
        </div>
    </div>
    <style>
        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 130px;
            border-radius: 5px;
            transition: .3s linear all;
        }
        .card-counter.primary {
            background-color: #007bff;
            color: #FFF;
        }
        .card-counter.danger {
            background-color: #ef5350;
            color: #FFF;
        }
        .card-counter.success {
            background-color: #66bb6a;
            color: #FFF;
        }
        .card-counter.info {
            background-color: #26c6da;
            color: #FFF;
        }
    </style>
@endsection
