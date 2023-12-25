@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <h1>Looking for job?</h1>
                <h3>Please create an account</h3>
                <img src="{{asset('image/register.png')}}">
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Register</div>
                    <form action="{{route('store.seeker')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" name="name" class="form-control">
                                @if($errors->has('name'))
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control">
                                @if($errors->has('email'))
                                    <div class="text-danger">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                                @if($errors->has('password'))
                                    <div class="text-danger">{{$errors->first('password')}}</div>
                                @endif
                            </div>
                            <br/>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
