@extends('layouts.master')
@section('title')
Products
@endsection
@section('content')

<h1>Product Reviews:</h1>
<hr></hr>

@foreach ($productreviews as $productreview)
    @if($productreview->product_id == $productidselected)
        <p>Review: <b>{{ $productreview->review }}</b></p>
        <p>Rating: <b>{{ $productreview->rating }}</b></p>
        <p>Reviewer Name: <b>{{ $productreview->reviewername}}</b></p>
        <p>No. of Likes: <b>{{ $productreview->likecount }}</b></p>
        <p>No. of Dislikes <b>{{ $productreview->dislikecount }}</b></p>
        

        @auth <!--- user is logged in --->
            

                @php
                    $memberid = Auth::user()->id;
                    $membertype = Auth::user()->membertype;
                    $likecount = 0
                @endphp 

                @if ($memberid == $productreview->user_id or $membertype == 'Moderator')
                <p><a href=' {{url("review/$productreview->id/edit")}}'>Edit Review</a></p>
                @endif


            @foreach ($productlikes as $productlike)
                @if ( $productlike -> user_id == $memberid and $productlike->review_id == $productreview-> id )
                    @php
                        $likecount = 1;
                    @endphp
                    
                @endif

            @endforeach

            @if ($likecount == 0)
                <form method="GET" action='{{url("reviewlikes/storelike/{id}")}}'>
                    {{csrf_field()}}
                    <input type = "hidden" name="review_id" value="{{ $productreview->id }}">
                    <input type = "hidden" name="product_id" value="{{ $productreview->product_id }}">
                    <input type = "hidden" name="user_id" value="{{Auth::user()->id}}">
                    <button name="likecount" type="submit" value=1>Like</button>
                    
                    
                </form>

                <form method="GET" action='{{url("reviewlikes/storedislike/{id}")}}'>
                    {{csrf_field()}}
                    <input type = "hidden" name="review_id" value="{{ $productreview->id }}">
                    <input type = "hidden" name="product_id" value="{{ $productreview->product_id }}">
                    <input type = "hidden" name="user_id" value="{{Auth::user()->id}}">
                    <button name="dislikecount" type="submit" value=1>Dislike</button>
                    
                    
                </form>
            @endif

        @endauth

        <hr></hr>
    @endif

@endforeach
{{ $productreviews->links()}}


@endsection