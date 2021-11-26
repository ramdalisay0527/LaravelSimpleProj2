@extends('layouts.master')
@section('title')
Products
@endsection
@section('content')

<h1>Reviews of followed user: 
@foreach ($userreviewer as $r)
{{$r->name}}</h1>
@endforeach

<ul>
@foreach ($reviewsofuser as $reviewofuser)

<li>Review of user: <b> {{ $reviewofuser->review }} </b></li>

    @foreach ($products as $product)
        @if ($product->id == $reviewofuser->product_id)
            <li> Product: <b> {{$product->name}} </b> </li>
        @endif
    @endforeach
<hr></hr>

@endforeach
</ul>
@endsection