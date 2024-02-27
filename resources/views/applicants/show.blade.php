@extends('layouts.admin.main')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mt-5">
                <h1>{{$listing->title}}</h1>
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
            </div>
            @foreach($listing->users as $user)
                <div class="card mt-5 {{$user->pivot->short_listing ? 'card-bg': ''}}">
                    <div class="row g-0">
                        <div class="col-auto">
                            @if($user->profile_pic)
                                <img src="{{Storage::url($user->profile_pic)}}" class="rounded-circle"
                                     style="width: 150px;"
                                     alt="Profile Picture">
                            @else
                                <img src="https://placehold.co/400" class="rounded-circle" style="width: 150px;"
                                     alt="Profile Picture">
                            @endif
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <p class="fw-bold">{{$user->name}}</p>
                                <p class="card-text">{{$user->email}}</p>
                                <p class="card-text">{{$user->pivot->created_at}}</p>
                            </div>
                        </div>
                        <div class="col-auto align-self-center">
                            <form action="{{route('applicants.shortlist', [$listing->id, $user->id])}}" method="post">
                                @csrf
                                <a href="{{Storage::url($user->resume)}}" class="btn btn-primary" target="_blank">Download
                                    Resume</a>
                                <button type="submit"
                                        class="btn btn-dark {{$user->pivot->short_listing ? 'btn-success': 'btn-dark'}}">
                                    {{$user->pivot->short_listing ? 'Shortlisted': 'Shortlist'}}
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
                <style>
                    .card-bg {
                        background-color: green;
                    }
                </style>
            @endforeach
        </div>
    </div>

@endsection
