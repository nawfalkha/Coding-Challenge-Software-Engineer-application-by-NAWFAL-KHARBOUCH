<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\Productsresource;
use Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        return Productsresource::collection($products);
    }
    public function filter(Request $req)
    {
        if(isset($req->category) && !isset($req->orderby)){
             $products=Product::where("category_id",$req->category)->get();
         }else if (!isset($req->category) && isset($req->orderby)) {
             $products=Product::orderBy($req->orderby,"asc")->get();
         }else{
            if(isset($req->category) && isset($req->orderby)){

                $products=Product::where("category_id",$req->category)->orderBy($req->orderby,"asc")->get();
            }else{
                $products=Product::all();
             }
        }
       
        //$products->orderBy("id","asc");
        //return $products;
        return Productsresource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string|max:191',
            'description'=>'required|string|max:191',
            'price'=>'required|numeric',
            'image'=>'required'
        ]);
        $product=new Product();
        if($request->image){
            $name=time().'.'.explode('/',explode(':',substr($request->image,0,strpos($request->image,';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/').$name);
            $request->merge(['image'=>'images/'.$name]);
        }
        $product=Product::create($request->all());
        return Productsresource::collection($products);
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
        $product=Product::findOrFail($id);
        $product->delete();
        return Response::json(array(
          'success' => true,
          'message'   => "Product deleted successfully."
        ));
    }
}
