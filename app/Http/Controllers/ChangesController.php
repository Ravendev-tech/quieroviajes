<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Changes;
use App\Models\products;
use App\Models\Points;
use DB;
use Auth;
class ChangesController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $userid = Auth::id();
      $products = DB::select(DB::raw("SELECT * FROM products WHERE id = $request->id_product"));

      Changes::Create([
          'id_client'  => $userid,
          'id_product' => $request->id_product,
          'points' => $products[0]->points,
          'status' => 1,
        ]);

      $lastchange = Changes::orderBy('created_at', 'desc')->first();

        Points::Create([
          'client'  => $userid,
          'action'  => "rmv",
          'order_id' => $lastchange->id_change,
          'points' => $products[0]->points
        ]);

      return redirect()->back();
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
