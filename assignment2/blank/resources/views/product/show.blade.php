@extends('layouts.master')
@section('content')

<h1>Product Name: {{$product->name}}</h1>
<p>Price: {{$product->price}}</p>
<p>Manufactured By: {{$product->manufacturer->name}}</p>

@foreach ($productimages as $productimage)
    <img src="{{url($productimage->image)}}" alt="product image" style="width:300px; height:300px;">
    <p> <i> Image uploaded by: {{$productimage-> user_name}} </i> </p>
@endforeach

@auth <!--- user is logged in --->

    @php
         $reviewexists = 0;
         $memberid = Auth::user()->id;
    @endphp

    @foreach ($productreviews as $productreview)
        @if ($productreview -> user_id == $memberid)
            @php
                $reviewexists = 1;
            @endphp
            
        @endif

    @endforeach

    @if ($reviewexists == 0)
        <p><a href=' {{url("review/create/$product->id")}}'>Add a review</a></p>
    @endif


    <p><a href=' {{url("productimages/create/$product->id")}}'>Add an Image</a></p>
    
    @php
         $membertype = Auth::user()->membertype;
         
    @endphp
    
    @if ($membertype == "Moderator")        
            <p><a href=' {{url("product/$product->id/edit")}}'>Edit This Product</a></p>
            <p>
            <form method="POST" action= '{{url("product/$product->id")}}'>
            {{csrf_field()}}
            {{ method_field('DELETE') }}
            <input type="submit" value="Delete">
            </form>
            </p>
    @endif
        
        

@endauth

    <p><a href=' {{url("review/$product->id")}}'>View Product Reviews</a></p>


@endsection