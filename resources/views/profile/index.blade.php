@extends('layouts.admin.main')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
            <form action="{{route('user.profile')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control" id="logo" name="profile_pic">
                        @if(auth()->user()->profile_pic)
                            <img src="{{Storage::url(auth()->user()->profile_pic)}}" width="150" class="mt-3">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name">Company name</label>
                        <input type="text" class="form-control" name="name" value="{{auth()->user()->name}}">
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row justify-content-center">
            <h2>Change your password</h2>
            @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
            <form action="{{route('user.password')}}" method="post">@csrf
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="current_password">Your current password</label>
                        <input type="password" name="current_password" class="form-control" id="current_password">
                    </div>
                    <div class="form-group">
                        <label for="password">Your new password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                               id="password_confirmation">
                    </div>
                    <div class="form-group mt-4">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
