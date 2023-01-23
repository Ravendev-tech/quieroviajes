<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travels;
use Illuminate\Support\Facades\Auth;
use App\Models\Destinations;
use DB;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $expedientes = DB::select(DB::raw("SELECT
      	payments.localizador AS localizador_val,
      	travels.id_travels,
      	travels.localizador,
      	travels.client_fullname,
      	travels.date_departure,
      	users.`name`
      FROM
      	travels
      	LEFT JOIN
      	payments
      	ON
      		travels.localizador = payments.localizador
      	LEFT JOIN
      	users
      	ON
      		travels.id_user = users.id
      WHERE
      	travels.passenger_order = 1
      GROUP BY
      	localizador_val,
        users.`name`,
      	travels.id_travels,
      	travels.localizador,
      	travels.client_fullname,
      	travels.date_departure"));



        return view('travels.index',compact(
          'expedientes',
      ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = Destinations::get();
        return view('travels.create',compact(
          'destinations'
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
      $userid = Auth::id();
      $localizador = request('localizador');
      $validalocalizador = Travels::where("localizador","=",$localizador )->count();
      if($validalocalizador > 1){
        return "Ya existe un epediente con ese Localizador, debes eliminar el anterior para poder cargar este.";
      }
      else{
        $counter = $request->counter;
      for ($i = 1; $i <= $counter; $i++) {
        // print "<p>$i</p>\n";
        $name = "name".$i;
        $phone = "phone".$i;
        $pvp = "pvp".$i;
        $neto = "neto".$i;

        Travels::Create([
            'localizador' => request('localizador'),
            // 'validalocalizador' => request('validalocalizador'),
            'client_fullname' => $request->$name,
            'client_phone' => $request->$phone,
            'travel_type' => request('travel_type'),
            'travel_pvp' =>  $request->$pvp,
            'travel_neto' =>  $request->$neto,
            'travel_cancelacion' => request('travel_cancelacion'),
            'date_departure' => request('date_departure'),
            'date_arrival' => request('date_arrival'),
            'travel_from' => request('travel_from'),
            'travel_to' => request('travel_to'),
            'travel_details' => request('travel_details'),
            'passenger_order' => $i,
            'id_user'  => $userid,
          ]);
      };
      }

      return redirect(route('payment.edit',[$localizador]))->with('message', 'State saved correctly!!!');;

    }


    // this is for update
    public function store2(Request $request)
    {
      $userid = Auth::id();
      $localizador = request('localizador');
      $counter = $request->counter2;
      for ($i = 1; $i <= $counter; $i++) {
        // print "<p>$i</p>\n";
        $name = "name".$i;
        $phone = "phone".$i;
        $pvp = "pvp".$i;
        $neto = "neto".$i;

        Travels::Create([
            'localizador' => request('localizador'),
            // 'validalocalizador' => request('validalocalizador'),
            'client_fullname' => $request->$name,
            'client_phone' => $request->$phone,
            'travel_type' => request('travel_type'),
            'travel_pvp' =>  $request->$pvp,
            'travel_neto' =>  $request->$neto,
            'date_departure' => request('date_departure'),
            'date_arrival' => request('date_arrival'),
            'travel_from' => request('travel_from'),
            'travel_to' => request('travel_to'),
            'travel_cancelacion' => request('travel_cancelacion'),
            'travel_details' => request('travel_details'),
            'passenger_order' => 5,
            'id_user'  => $userid,
          ]);
      };

      return redirect(route('payment.edit',[$localizador]))->with('message', 'State saved correctly!!!');;

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
      $destinations = Destinations::get();
      $amount = Travels::where('localizador', $id)->sum('travel_pvp');
      $passangers = Travels::where('localizador',$id)->count();
      $expediente = DB::select(DB::raw("SELECT
travels.*,
destfrom.name_destination as 'destfrom',
destto.name_destination as 'destto'
FROM
travels
LEFT JOIN
destinations AS `destfrom`
ON
	travels.travel_from = destfrom.id_destination
LEFT JOIN
destinations AS `destto`
ON
	travels.travel_to = destto.id_destination
      WHERE
      	travels.localizador = '$id'
      "));
        return view('travels.edit',compact(
          'expediente',
          'amount',
          'passangers',
          'destinations'
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
      $travels = DB::select(DB::raw("DELETE FROM travels  WHERE localizador = '$id'"));
      $payments = DB::select(DB::raw("DELETE FROM payments  WHERE localizador = '$id'"));
      return redirect()->back()->with(['Registro eliminado correctamente', 'Registro eliminado correctamente']);
    }
}
