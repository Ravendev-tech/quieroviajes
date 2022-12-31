<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
class UserController extends Controller
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


    public function avatarupdate(Request $request)
    {
      $id = $request->userid;
      $request->validate([
           'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
       $imageName = time().'.'.$request->avatar->getClientOriginalName();
       $request->avatar->move(public_path('assets/images/avatars'), $imageName);

       $user = User::findorfail($id);
       $user->update([
         'user_avatar'  => $imageName
         ]);

       return redirect()->back();
    }


    public function homeadmin(){

      $today = date("Y-m-d");
      $next15 = date("Y-m-d",strtotime($today."+ 15 days"));

      $nextpayments = DB::select(DB::raw("SELECT
      	travels.client_fullname,
      	travels.client_phone,
      	travels.date_departure,
      	travels.localizador,
	      travels.id_travels
      FROM
      	travels
      WHERE
      	travels.passenger_order = 1
       AND
      	travels.date_departure < '$next15'"));
      return view('homeadmin',compact(
        'nextpayments'
      ));
    }

    public function homecostumer()
    {
        $today = date("Y-m-d");
        $next15 = date("Y-m-d",strtotime($today."+ 15 days"));

        $nextpayments = DB::select(DB::raw("SELECT
          travels.client_fullname,
          travels.client_phone,
          travels.date_departure,
          travels.localizador,
          travels.id_travels
        FROM
          travels
        WHERE
          travels.passenger_order = 1
         AND
          travels.date_departure < '$next15'"));
        return view('homecostumer',compact(
          'nextpayments'
        ));
    }




    public function profile($hash)
    {
      $id = Auth::user()->id;
      $client = DB::select(DB::raw("SELECT * FROM users WHERE id = $id"));

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
      		orders.id = points.order_id
        WHERE
        orders.client = $id"));


      $ordercant = count($orders);


      $totalpoints = DB::select(DB::raw("SELECT
          points.client,
          points.action,
          SUM(points.points) as suma
        FROM
          points
        WHERE
          points.client = $id
        GROUP BY
          points.action,
          points.client"));


      $points = DB::select(DB::raw("SELECT
          points.action,
          points.points,
          points.nro_invoice,
          points.client,
	        points.created_at
        FROM
          points
        WHERE
          points.client = $id"));

        $changes = DB::select(DB::raw("SELECT
          	changes.id_change,
          	changes.id_client
          FROM
          	changes
          WHERE
            changes.id_client = $id"));

        $changeslist = DB::select(DB::raw("SELECT
        	 changes.*,
        	 products.title,
        	  products.photo
          FROM
        	 changes
        	LEFT JOIN
        	 products
        	ON
      		  changes.id_product = products.id
          WHERE
            changes.id_client = $id"));

        $changescant = count($changes);
        //retorno y paso la a la vista
        return view('profile',compact(
          'client',
          'orders',
          'totalpoints',
          'ordercant',
          'points',
          'hash',
          'changescant',
          'changeslist'
        ));
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
