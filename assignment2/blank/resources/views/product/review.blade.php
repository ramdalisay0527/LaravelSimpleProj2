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

<form method="POST" action='{{url("review")}}'>
{{csrf_field()}}
<input type = "hidden" name="user_id" value="{{Auth::user()->id}}">
<input type = "hidden" name="user_name" value="{{Auth::user()->name}}">
<input type = "hidden" name="likecount" value= 0>
<input type = "hidden" name="dislikecount" value= 0>
<p><label>Review: </label><input type="textarea" name="review" value="{{ old('name') }}"></p>
<p><label>Rating: </label><input type="text" name="rating" value="{{ old('price')}}"></p>
<p><select name="product">

@foreach ($products as $product)
    
    @if($product->id == $productidtobereviewed)
        <option value="{{$product->id}}" selected="selected"> {{$product->name}}</option>
    @else
        <option value="{{$product->id}}">{{$product->name}}</option>
    @endif

@endforeach
</select></p>
<input type="submit" value="Create"> </form>
@endsection