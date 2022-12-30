<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
        return view('print.paymentrecipet',compact(
          'datapayment'
        ));
    }



}
