<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Productimages;
use App\Models\Review;
use App\Models\Reviewlikes;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(){
        $this->middleware('auth',['except'=>['index', 'show']]);
    } 

    public function index()
    {
        //
        $products = Product::all();
        return view('product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create')->with('manufacturers', Manufacturer::all());
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric|gt:0',
            'manufacturer' =>'exists:manufacturers,id'
        ] );

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->manufacturer_id = $request->manufacturer;
        $product->save();
        return redirect("product/$product->id");
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
        $reviewsofproduct = Review:: where('product_id','=', $id)->get();
        $product = Product::find($id);
        $productimages = Productimages::where('product_id','=', $id)->get();
        return view('product.show')->with('product', $product) ->with('productimages', $productimages) ->with ('productreviews', $reviewsofproduct);
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
        $product = Product::find($id);
        return view('product.edit_form')->with('product', $product)->with('manufacturers', Manufacturer::all());
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric|gt:0',
            'manufacturer' =>'exists:manufacturers,id'
        ] );
        //
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->manufacturer_id = $request->manufacturer;
        $product->save();
        return redirect("product/$product->id");
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
        $productreviews = Review::where('product_id','=',$id)->get();
        foreach ($productreviews as $productreview)
        {
            $productreviewlikes = Reviewlikes::where('review_id', '=' , $productreview->id);
            $productreviewlikes->delete();  
            $productreview->delete();
        }

        $productimages = Productimages::where('product_id','=', $id)->get();
        foreach ($productimages as $productimage)
        {
            $productimage->delete();
        }



        $findproduct = Product::find($id);
        $findproduct->delete();
        $products = Product::all();
        return redirect("product");
    }
}
