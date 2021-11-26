@extends('layouts.master')
@section('content')
    @if (count($errors) > 0)
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif

<form method="POST" action='{{url("productimages")}}' enctype="multipart/form-data">
{{csrf_field()}}
<p><label>Name: </label><input type="text" name="name" ></p>
<input type = "hidden" name="user_id" value="{{Auth::user()->id}}">
<input type = "hidden" name="user_name" value="{{Auth::user()->name}}">
<input type = "hidden" name="product_id" value="{{ $productid }}">
<p><input type="file" name="image"></p>

<input type="submit" value="Upload Now"> </form>
@endsection