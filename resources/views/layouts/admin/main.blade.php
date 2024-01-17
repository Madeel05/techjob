<!DOCTYPE html>
<html lang="en">
@include('layouts.admin.header')
<body class="sb-nav-fixed">
@include('layouts.admin.navbar')
<div id="layoutSidenav">
    @include('layouts.admin.sidebar')
    <div id="layoutSidenav_content">
        {{--@include('layouts.admin.body')--}}
        @yield('content')
        @include('layouts.admin.footer')
    </div>
</div>
@include('layouts.admin.scripts')
</body>
</html>
