<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = DB::select(DB::raw("SELECT
      	orders.file_invoice,
      	orders.nro_invoice,
      	orders.amount_invoice,
      	orders.created_at,
      	users.`name`,
      	orders.client,
      	orders.id,
      	points.points
      FROM
      	orders
      	LEFT JOIN
      	users
      	ON
      		orders.client = users.id
      	LEFT JOIN
      	points
      	ON
      		orders.id = points.order_id"));
      // return $orders;
        return view('orders.index',compact(
          'orders',
        ));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clients = DB::select(DB::raw("SELECT * FROM users WHERE user_level = 3"));
        return view('orders.create',compact(
          'clients',
        ));
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
             'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
         ]);
         $fileName = time().'.'.$request->file->getClientOriginalName();
         $request->file->move(public_path('assets/orders/'), $fileName);

         Orders::Create([
             'client'  => request('client'),
             'file_invoice' => $fileName,
             'nro_invoice' => request('nro_invoice'),
             'amount_invoice' => request('amount_invoice'),

           ]);

         return redirect()->route('orders.index');
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
      $orders = DB::select(DB::raw("SELECT *, orders.id,users.id AS client_id, orders.client, orders.file_invoice, orders.nro_invoice, users.`name` FROM orders LEFT JOIN users ON Orders.client = users.id AND orders.client = users.id WHERE orders.id = $id"));
      $clients = DB::select(DB::raw("SELECT * FROM client"));
      // return $orders;
        return view('orders.edit',compact(
          'orders',
          'clients',
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
        $order = Orders::findorfail($id);
        $order->update([
          'client'  => request('client'),
          'nro_invoice' => request('nro_invoice'),
          ]);
       return redirect()->route('orders.index');

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
