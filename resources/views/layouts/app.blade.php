<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
</head>
<body>
<nav class="navbar bg-dark navbar-expand-lg" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="#">TechJobs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>

                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{Storage::url( auth()->user()->profile_pic)}}" width="40" height="40"
                                 class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{route('seeker.profile')}}">Profile</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                   href="{{route('job.applied')}}">Job applied</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" id="logout">logout</a>
                            </li>
                            <form id="form-logout" action="{{route('logout')}}" method="post">@csrf</form>

                        </ul>
                    </li>
                @endif
                @if(!Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('create.seeker')}}">Job Seeker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('create.employer')}}">Employer</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
    let logout = document.getElementById('logout');
    let form = document.getElementById('form-logout');
    logout.addEventListener('click', function () {
        form.submit();
    })
</script>

@yield('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
