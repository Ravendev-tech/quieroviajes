<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Redirect;


class ClientsController extends Controller

{

    use RegistersUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $clients = DB::select(DB::raw("SELECT * FROM users WHERE user_level = 3"));
        return view('clients.index',compact(
          'clients',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validmail = User::where('email',$request['email']) -> first();
      if($validmail){
        return redirect()->back()->with('error', 'Este correo ya fue utilizado, prueba utilizando uno diferente o edita el usuario existente');
      }
      else{
         User::create([
            'name' => $request['name'] . " " . $request['lastname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'address' => $request['address'],
            'city' => $request['city'],
            'phone' => $request['phone'],
            'whatsapp' => $request['whatsapp'],
            'user_level' => 3,
            'user_active' =>1,
            'user_avatar' =>"user.jpg",
        ]);

        return redirect('client-list')->with('success', 'El cliente fue creado exitosamente');
      }
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

      $changescant = count($changes);

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

        //retorno y paso la a la vista
        return view('clients.edit',compact(
          'client',
          'orders',
          'totalpoints',
          'ordercant',
          'points',
          'changescant',
          'changeslist'
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
      $client = User::findorfail($id);
      $client->update([
        'name' => $request['name'] . " " . $request['lastname'],
        'address' => $request['address'],
        'city' => $request['city'],
        'phone' => $request['phone'],
        'whatsapp' => $request['whatsapp'],
        'user_active' =>1,
       ]);
       return redirect()->back()->with('success', 'Datos actualizados correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $client = DB::select(DB::raw("DELETE FROM client WHERE id = $id"));
      return Redirect::back()->withErrors(['Registro eliminado correctamente', 'Registro eliminado correctamente']);
    }
}
