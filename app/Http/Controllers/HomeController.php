<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Payments;
use App\Models\Travels;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function agents(Request $request)
    {
      if(isset($request->date1)){
        $date1 = $request->date1;
        $date2 = $request->date2;
      }else{
        $date1 = "0000-00-00";
        $date2 = "0000-00-00";
      }

      if($request->user == 0){
        $user = " ";
      }else{
        $user = "payments.id_user = $request->user AND " ;
      }
      $daily = DB::select(DB::raw("SELECT
      SUM(travels.travel_pvp) AS pvp, 
      SUM(travels.travel_neto) AS neto, 
      travels.localizador, 
      travels.id_user, 
	    travels.created_at,
      users.`name`
    FROM
      travels
      LEFT JOIN
      users
      ON 
        travels.id_user = users.id
    WHERE
      travels.created_at >= '2023-01-18' AND
      travels.created_at <= '2023-01-20'
    GROUP BY
      travels.localizador, 
      travels.id_user, 
      users.`name`,
      travels.created_at
      "));


      $cantservicios = DB::select(DB::raw("SELECT
        	COUNT(travels.client_fullname) as servicios
        FROM
        	payments
        	LEFT JOIN
        	travels
        	ON
        		payments.localizador = travels.localizador
        	LEFT JOIN
        	users
        	ON
        		payments.id_user = users.id
        WHERE
          $user
        	travels.passenger_order = 1 AND
        	payments.payment_status = 1 AND
        	(
        		payments.updated_at >= '$date1' AND
        		payments.updated_at <= '$date2'
        	)
      "));

      $totales = DB::select(DB::raw("SELECT
        	SUM(travels.travel_pvp) AS totalpvp,
        	SUM(travels.travel_neto) AS totalneto
        FROM
        	payments
        	LEFT JOIN
        	travels
        	ON
        		payments.localizador = travels.localizador
        	LEFT JOIN
        	users
        	ON
        		payments.id_user = users.id
        WHERE
          $user
        	travels.passenger_order = 1 AND
        	payments.payment_status = 1 AND
        	(
            payments.updated_at >= '$date1' AND
        		payments.updated_at <= '$date2'
        	)
      "));



      $users = User::get();
      return view('reports.agents',compact(
        'daily',
        'users',
        'cantservicios',
        'totales'
      ));
    }

    public static function checkclient($id)
    {
        $checkpaid = Travels::where('localizador',$id)->where('passenger_order',1)->get();
        return $checkpaid[0]->client_fullname;
    }


    public function daily($id)
    {
      $date = $id;
      $daily = DB::select(DB::raw("SELECT
        	payments.*,
        	travels.client_fullname,
        	travels.passenger_order,
        	users.`name`
        FROM
        	payments
        	LEFT JOIN
        	travels
        	ON
        		payments.localizador = travels.localizador
        	LEFT JOIN
        	users
        	ON
        		payments.id_user = users.id
        WHERE
          	travels.passenger_order = 1 AND
            payments.payment_status = 1 AND
        	  (payments.created_at LIKE '$id%' OR
          	payments.updated_at LIKE '$id%')
      "));

      return view('reports.daily',compact(
        'daily',
        'date'
      ));

    }

    // update checked status
    public function checkdaily(Request $request)
    {
        $paymentid = $request->idpayment;
        $checkpayment = Payments::findorfail($paymentid);

        if(is_null($checkpayment->payments_checked) or $checkpayment->payments_checked == 0 ){
          $setval = 1;
        }else{
          $setval = 0;
        };
        $checkpayment->update([
          'payments_checked'  => $setval,
        ]);
    }




    public function paymentrecipet($id)
    {
      $datapayment = DB::select(DB::raw("SELECT
        	payments.id_payments,
        	payments.localizador,
        	payments.payment_method,
        	payments.payment_amount,
        	payments.payment_date,
        	travels.client_fullname,
        	travels.client_phone,
        	travels.id_travels,
        	travels.date_departure,
          travels.travel_cancelacion,
          travels.date_arrival,
        	destfrom.name_destination AS destfrom,
        	destto.name_destination AS destto
        FROM
        	payments
        	LEFT JOIN
        	travels
        	ON
        		payments.localizador = travels.localizador
        	LEFT JOIN
        	destinations AS destfrom
        	ON
        		travels.travel_from = destfrom.id_destination
        	LEFT JOIN
        	destinations AS destto
        	ON
        		travels.travel_to = destto.id_destination
        WHERE
        	travels.passenger_order = 1 AND
        	payments.id_payments = $id
        "));

        $localizador = $datapayment[0]->localizador;
        $payments = Payments::where('localizador',$localizador)->where('payment_status',1)->get();
        $services = Travels::where('localizador', $localizador)->get();
        $hitos = Payments::where('localizador',$localizador)->where('payment_status',2)->get();


        return view('print.paymentrecipet',compact(
          'datapayment',
          'services',
          'hitos'
        ));
    }



}
