@extends('layouts.master')
@section('title')
Products
@endsection
@section('content')

<h1>Follow Some Users: </h1>

<ul>
@foreach ($users as $user)

    @php
        $userfollowed = 0;
        $memberid = Auth::user()->id;
    @endphp

    @foreach ($follows as $follow)
        @if ($follow-> follower_id == $memberid and $user->id == $follow-> followee_id )
            @php
                $userfollowed = 1 
            @endphp
        @endif
    @endforeach

        @if($userfollowed == 0)
            <li>{{ $user->name }}</li>

            <form method="POST" action='{{url("followuser")}}'>
                {{csrf_field()}}
                <input type = "hidden" name="followee_id" value="{{ $user->id }}">
                <input type = "hidden" name="followee_name" value="{{ $user->name }}">
                <input type = "hidden" name="follower_id" value="{{Auth::user()->id}}">
                <input type = "hidden" name="follower_name" value="{{Auth::user()->name}}">

                <button name="followuser" type="submit" value='Create'>follow</button>     
            </form>
        @endif

@endforeach
</ul>
@endsection