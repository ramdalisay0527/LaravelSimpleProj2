@extends('layouts.master')
@section('content')

        <!-- <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li> {{$error}} </li>
                @endforeach
            </ul>
        </div> -->

    @if (count($errors) > 0)
        <form method="POST" action='{{url("product/$product->id")}}'>
        {{csrf_field()}}
        {{ method_field('PUT') }}
        <label>Name: </label><input type="text" name="name" value="{{ old('name') }}">{{$errors->first('name')}}
        <p></p>
        <label>Price: </label><input type="text" name="price" value="{{ old('price')}}">{{$errors->first('price')}}
        <p><select name="manufacturer">

        @foreach ($manufacturers as $manufacturer)
            @if($manufacturer->id == old('manufacturer'))
                <option value="{{$manufacturer->id}}" selected="selected">{{$manufacturer->name}}</option>
            @else
            <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
            @endif
        @endforeach
        </select></p>
        <input type="submit" value="update"> </form>

    @else


        <form method="POST" action= '{{url("product/$product->id")}}'>
        {{csrf_field()}}
        {{ method_field('PUT') }}
        </p><label>Name</label>
        <input type="text" name="name" value="{{$product->name}}"></p>
        <p><label>Price</label>
        <input type="text" name="price" value="{{$product->price}}"><br></p>
        <p><select name="manufacturer">
        
        @foreach ($manufacturers as $manufacturer)
            @if($manufacturer->id == $product->manufacturer_id)
                <option value="{{$manufacturer->id}}" selected="selected">{{$manufacturer->name}}</option>
            @else
                <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
            @endif
        @endforeach
        </select>
        <input type="submit" value="Update">
        </form>
         
    @endif

@endsection




    