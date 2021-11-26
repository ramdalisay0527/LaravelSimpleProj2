<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Review;
use App\Models\Reviewlikes;
use App\Models\Followuser;




class FollowUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $follows = Followuser::all();
        $users = User::all();
        return view('product.follow_index')->with('users',$users) ->with('follows', $follows);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $followuser = new FollowUser();
        $followuser->follower_id = $request->follower_id;
        $followuser->followername = $request->follower_name;
        $followuser->followee_id= $request->followee_id;
        $followuser->followeename= $request ->followee_name;
        $followuser->save();
        return redirect("followuser");
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
        $followedusers = Followuser::where('follower_id','=', $id)->get();
        return view('product.followedusers')->with('followedusers', $followedusers);
    }

    public function showreviewsofuser($id)
    {
        $reviewsofuser = Review::where('user_id','=',$id)->get();
        $user_reviewer = User::where('id','=',$id)->get();
        $products = Product::all();
        return view('product.followeduserreviews')->with('reviewsofuser',$reviewsofuser)->with('products',$products)->with('userreviewer',$user_reviewer);
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
        $follow = Followuser::find($id);
        $follow->delete();
        $products = Product::all();
        return redirect("product");
    }
}
