<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Review;
use App\Models\Reviewlikes;

class ReviewLikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }
    public function storereviewlike(Request $request)
    {
        $reviewlike = new Reviewlikes();
        $reviewlike->review_id = $request->review_id;
        $reviewlike->likecount = 1;
        $reviewlike->dislikecount = 0;
        $reviewlike->user_id = $request->user_id;
        $product_id = $request->product_id;
        $reviewlike->save();

        $reviewtoupdate = Review::find($request->review_id);
        $reviewtoupdate->likecount = $reviewtoupdate->likecount + 1;
        $reviewtoupdate->save();

        return redirect("product/$product_id");

    }
    public function storereviewdislike(Request $request)
    {
        $reviewlike = new Reviewlikes();
        $reviewlike->review_id = $request->review_id;
        $reviewlike->likecount = 0;
        $reviewlike->dislikecount = 1;
        $reviewlike->user_id = $request->user_id;
        $product_id = $request->product_id;
        $reviewlike->save();

        $reviewtoupdate = Review::find($request->review_id);
        $reviewtoupdate->dislikecount = $reviewtoupdate->dislikecount + 1;
        $reviewtoupdate->save();

        return redirect("product/$product_id");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $review = new Reviewlikes();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->reviewername = $request->user_name;
        $review->likecount = 1;
        $review->dislikecount = $request->dislikecount;
        $review->product_id = $request->product;
        $review->user_id = $request->user_id;
        $review->save();
        return redirect("product/$review->product_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
