@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('message')
                <div class="card shadow-lg">
                    <div class="card-header">Login</div>
                    <form action="{{route('login.post')}}" method="post" autocomplete="off">
                        @csrf
                        <div class="card-body">
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
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
