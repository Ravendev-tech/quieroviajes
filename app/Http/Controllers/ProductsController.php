<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use DB;
use Illuminate\Support\Facades\Auth;
use Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $products = DB::select(DB::raw("SELECT * FROM products"));
        return view('products.index',compact(
          'products',
        ));
    }

    //lista para clientes
    public function indexcostumer()
    {
      $userid = Auth::id();

      $products = DB::select(DB::raw("SELECT * FROM products"));

      $totalpoints = DB::select(DB::raw("SELECT
          points.client,
          points.action,
          SUM(points.points) as suma
        FROM
          points
        WHERE
          points.client = $userid
        GROUP BY
          points.action,
          points.client"));

        return view('products.indexcostumer',compact(
          'products',
          'totalpoints'
        ));
    }


    //detalle del producto
    public function productdetails($id)
    {
      $userid = Auth::id();

      $products = DB::select(DB::raw("SELECT * FROM products WHERE id = $id"));

      $totalpoints = DB::select(DB::raw("SELECT
          points.client,
          points.action,
          SUM(points.points) as suma
        FROM
          points
        WHERE
          points.client = $userid
        GROUP BY
          points.action,
          points.client"));

        return view('products.product-details',compact(
          'products',
          'totalpoints'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
           'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       $imageName = time().'.'.$request->photo->getClientOriginalName();
       $request->photo->move(public_path('assets/images/products'), $imageName);

       Products::Create([
           'title'  => request('title'),
           'description' => request('description'),
           'category' => request('category'),
           'points' => request('points'),
           'active' => 1,
           'photo' => $imageName,
         ]);

       return redirect()->route('product.index');
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
      $product = DB::select(DB::raw("SELECT * FROM products WHERE id = $id"));
        return view('products.edit',compact(
          'product',
        ));
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
        if ($request->photo) {
          $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           ]);
           $imageName = time().'.'.$request->photo->extension();
           $request->photo->move(public_path('assets/images/products'), $imageName);

           $product = Products::findorfail($id);
           $product->update([
             'title'  => request('title'),
             'description' => request('description'),
             'category' => request('category'),
             'points' => request('points'),
             'active' => 1,
             'photo' => $imageName,
            ]);
        }else{
            $product = Products::findorfail($id);
            $product->update([
              'title'  => request('title'),
              'description' => request('description'),
              'category' => request('category'),
              'points' => request('points'),
              'active' => 1,
              ]);
          };
       return redirect()->route('product.index');

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
