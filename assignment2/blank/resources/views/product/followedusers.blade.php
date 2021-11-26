@extends('layouts.master')
@section('title')
Products
@endsection
@section('content')
<h1>Reviewers whom you follow:</h1>
<ul>
@foreach ($followedusers as $followeduser)
<a href= ' {{url("followuser/showreviews/{$followeduser->followee_id}")}}'><li>{{ $followeduser->followeename }}</li></a>

        <form method="POST" action='{{url("followuser/$followeduser->id")}}'>
            {{csrf_field()}}
            {{ method_field('DELETE') }}
            <input type = "hidden" name="followee_id" value="{{ $followeduser->followee_id }}">
            <input type = "hidden" name="followee_name" value="{{ $followeduser->followeename }}">
            <input type = "hidden" name="follower_id" value="{{ $followeduser->followeduser_id }}">
            <input type = "hidden" name="follower_name" value="{{ $followeduser->followername}}">
            <input type = "hidden" name="follow_id" value="{{ $followeduser->id}}">

            <button name="followuser" type="submit" value='Delete'>unfollow</button>  
        </form>
@endforeach
</ul>
@endsection