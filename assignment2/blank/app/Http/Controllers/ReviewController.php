<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Review;
use App\Models\Reviewlikes;


class ReviewController extends Controller
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
        
        return view('product.review')->with('products', Product::all());
       
        
    }
    public function createnewreviewfromshowpage($id)
    {
        //
        $productidtobereviewed = $id;
        return view('product.review')->with('products', Product::all()) ->with('productidtobereviewed', $productidtobereviewed);
       
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'review' => 'required|min:5',
            'rating' => 'required|numeric|gte:1|lte:5',
            'product' =>'exists:products,id'
        ]);

        $review = new Review();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->reviewername = $request->user_name;
        $review->likecount = $request->likecount;
        $review->dislikecount = $request->dislikecount;
        $review->product_id = $request->product;
        $review->user_id = $request->user_id;
        $review->save();
        return redirect("review/$review->product_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productidselected = $id;
        $productlikes = Reviewlikes::all();

        $productreviews = Review::where('product_id','=',$productidselected)->orderBy('likecount', 'desc') ->paginate(5);
        return view('product.review_index')->with('productreviews', $productreviews) ->with('productidselected', $productidselected) ->with('productlikes', $productlikes);
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
        $review = Review::find($id);
        return view('product.review_edit')->with('review', $review)->with('products', Product::all());
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
        $this->validate($request, [
            'review' => 'required|min:5',
            'rating' => 'required|numeric|gte:1|lte:5',
            'product' =>'exists:products,id'
        ]);

        $review = Review::find($id);
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->product_id = $request->product;
        $review->user_id = $request->user_id;
        $review->save();
        return redirect("review/$review->product_id");

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
