@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 justify-content-center">
        <div class="card">
            <div class="card-header">
                Verify Account
            </div>
            <div class="card-body">
                Your account not verified. Please verify your account first.
                <a href="{{route('resend.email')}}">Resend verification link</a>
            </div>
        </div>
    </div>
</div>
@endsection
