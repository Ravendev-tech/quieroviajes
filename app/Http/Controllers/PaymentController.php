<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travels;
use App\Models\Payments;
use App\Models\Destinations;
use Illuminate\Support\Facades\Auth;
use DB;

class PaymentController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $userid = Auth::id();
        $cantpagos = $request->cantpagos;

        if($cantpagos == 1){
          Payments::Create([
              'localizador' => request('localizador'),
              'payment_method' => request('method1'),
              'payment_amount' => request('total1'),
              'payment_date' => request('fecha1'),
              'payment_status' => request('status1'),
              'id_user'  => $userid,
            ]);
        }

        if($cantpagos == 2){
          Payments::Create([
              'localizador' => request('localizador'),
              'payment_method' => request('method1'),
              'payment_amount' => request('total1'),
              'payment_date' => request('fecha1'),
              'payment_status' => request('status1'),
              'id_user'  => $userid,
            ]);

          Payments::Create([
              'localizador' => request('localizador'),
              'payment_method' => request('method2'),
              'payment_amount' => request('total2'),
              'payment_date' => request('fecha2'),
              'payment_status' => 2,
              'id_user'  => $userid,
            ]);
          }

          if($cantpagos == 3){
            Payments::Create([
                'localizador' => request('localizador'),
                'payment_method' => request('method1'),
                'payment_amount' => request('total1'),
                'payment_date' => request('fecha1'),
                'payment_status' =>  request('status1'),
                'id_user'  => $userid,
              ]);

            Payments::Create([
                'localizador' => request('localizador'),
                'payment_method' => request('method2'),
                'payment_amount' => request('total2'),
                'payment_date' => request('fecha2'),
                'payment_status' => 2,
                'id_user'  => $userid,
              ]);

            Payments::Create([
                'localizador' => request('localizador'),
                'payment_method' => request('method3'),
                'payment_amount' => request('total3'),
                'payment_date' => request('fecha3'),
                'payment_status' => 2,
                'id_user'  => $userid,
              ]);
            }

          return redirect()->back()->with('success', 'Datos cargados correctamente.');

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
        $datatravel = DB::select(DB::raw("SELECT
      	travels.*,
      	destinationfrom.name_destination AS destinationfrom,
      	destinationto.name_destination AS destinationto
      FROM
      	travels
      	LEFT JOIN
      	destinations AS destinationfrom
      	ON
      		travels.travel_from = destinationfrom.id_destination
      	LEFT JOIN
      	destinations AS destinationto
      	ON
      		travels.travel_to = destinationto.id_destination
        WHERE
  	       travels.localizador = '$id'
        "));
        $amount = Travels::where('localizador', $id)->sum('travel_pvp');
        $payment = Payments::where('localizador',$id)->get();
        $haspayment = Payments::where('localizador',$id)->count();
        $amountpaid = Payments::where('localizador', $id)->where('payment_status', 1)->sum('payment_amount');


        return view('payments.edit',compact(
          'datatravel',
          'amount',
          'haspayment',
          'payment',
          'amountpaid'
        ));

    }


    public static function checkpayment($id)
    {
        $haspayment = Payments::where('localizador',$id)->count();

        if($haspayment > 0){
          return "tiene";
        }
        else{
          return "no tiene";
        }

    }


    public static function checkpaid($id)
    {
        $checkpaid = Payments::where('localizador',$id)->where('payment_status',1)->sum('payment_amount');
        return $checkpaid;
    }

    public static function checktotal($id)
    {
        $checktotal = Travels::where('localizador', $id)->sum('travel_pvp');
        return $checktotal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cant = count($request->input());
        $userid = Auth::id();
        if($cant == 3){
          $product = Payments::findorfail($request->v2);
          $product->update([
            'payment_status'  => 1,
            'id_user' => $userid,
            ]);
        }

        if($cant == 4){
          $product = Payments::findorfail($request->v2);
          $product->update([
            'payment_status'  => 1,
            'id_user' => $userid,
            ]);

          $product = Payments::findorfail($request->v3);
          $product->update([
            'payment_status'  => 1,
            'id_user' => $userid,
            ]);
        }

        return redirect()->back()->with('success', 'Datos cargados correctamente.');

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
