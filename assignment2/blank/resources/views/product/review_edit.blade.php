@extends('layouts.master')
@section('content')
    <!-- @if (count($errors) > 0)
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif -->
    @if (count($errors) > 0)

    <form method="POST" action='{{url("review/$review->id")}}'>
        {{csrf_field()}}
        {{ method_field('PUT') }}
        <input type = "hidden" name="user_id" value="{{Auth::user()->id}}">
        <input type = "hidden" name="user_name" value="{{Auth::user()->name}}">
        <input type = "hidden" name="likecount" value= 0>
        <input type = "hidden" name="dislikecount" value= 0>
        <p><label>Review: </label><input type="textarea" name="review" value="{{ old('review') }}">{{$errors->first('review')}}</p>
        <p><label>Rating: </label><input type="text" name="rating" value="{{ old('rating') }}">{{$errors->first('rating')}}</p>
        <p><select name="product">

        @foreach ($products as $product)
            
            @if($product->id == $review ->product_id)
                <option value="{{$product->id}}" selected="selected"> {{$product->name}}</option>
            @else
                <option value="{{$product->id}}">{{$product->name}}</option>
            @endif

        @endforeach
        </select></p>
        <input type="submit" value="Edit"> </form>

    @else

        <form method="POST" action='{{url("review/$review->id")}}'>
        {{csrf_field()}}
        {{ method_field('PUT') }}
        <input type = "hidden" name="user_id" value="{{Auth::user()->id}}">
        <input type = "hidden" name="user_name" value="{{Auth::user()->name}}">
        <input type = "hidden" name="likecount" value= 0>
        <input type = "hidden" name="dislikecount" value= 0>
        <p><label>Review: </label><input type="textarea" name="review" value="{{ $review->review }}"></p>
        <p><label>Rating: </label><input type="text" name="rating" value="{{ $review->rating }}"></p>
        <p><select name="product">

        @foreach ($products as $product)
            
            @if($product->id == $review ->product_id)
                <option value="{{$product->id}}" selected="selected"> {{$product->name}}</option>
            @else
                <option value="{{$product->id}}">{{$product->name}}</option>
            @endif

        @endforeach
        </select></p>
        <input type="submit" value="Edit"> </form>
    @endif
@endsection