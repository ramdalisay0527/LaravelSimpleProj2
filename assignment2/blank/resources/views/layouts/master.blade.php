<html>
<head>
<title>@yield('title')</title>
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
    @auth <!--- user is logged in --->
        {{Auth::user()->name}} || Member Type:
        {{Auth::user()->membertype}}
        @php
            $id = Auth::user()->id
        @endphp
        <form method="POST" action= "{{url('/logout')}}">
            {{csrf_field()}}
            <input type="submit" value="Logout">
        </form>
        <hr></hr>

        <a href="{{ url("product") }}">See All products Here</a>
        <p></p>
        <a href="{{ url("followuser") }}">Follow Reviewers Here</a>
        <p></p>


        <a href="{{ url("followuser/$id") }}">See Your Followed Reviewers Here</a>
        <hr></hr>
    @else <!--- user is not logged in --->
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endauth
@yield('content')
</body>
</html>