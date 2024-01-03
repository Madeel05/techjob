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
                <div class="card" id="card">
                    <div class="card-header">Register</div>
                    <form action="#" method="post" autocomplete="off" id="registrationForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Full Name</label>
                                <input type="text" name="name" class="form-control" required>
                                @if($errors->has('name'))
                                    <div class="text-danger">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required>
                                @if($errors->has('email'))
                                    <div class="text-danger">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                                @if($errors->has('password'))
                                    <div class="text-danger">{{$errors->first('password')}}</div>
                                @endif
                            </div>
                            <br/>
                            <div class="form-group">
                                <button class="btn btn-primary" id="btnRegister">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="message"></div>
            </div>
        </div>
    </div>
    <script>
        var url = "{{route('store.seeker')}}"
        document.getElementById("btnRegister").addEventListener("click", function (event) {
            var form = document.getElementById('registrationForm');
            var message = document.getElementById('message');
            message.innerHTML = ''
            var formData = new FormData(form)
            var card = document.getElementById('card');

            var button = event.target;
            button.disabled = true;
            button.innerHTML = 'Sending Email.....'

            fetch(url, {
                method: "POST",
                headers:{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                body:formData
            }).then(response => {
                if (response.ok){
                    // return response.json();
                }else {
                    throw new Error('error')
                }
            }).then(data => {
                button.innerHTML = 'Register';
                button.disabled = false;
                message.innerHTML = '<div class="alert alert-success">Registration was successful. Please check email for verify</div>'
                card.style.display = 'none';
            }).catch(error =>{
                button.innerHTML = 'Register';
                button.disabled = false;
                message.innerHTML = '<div class="alert alert-danger">Something went wrong. Please try again</div>'
            })
        });
    </script>
@endsection
