<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChangesController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if($user->user_level == 1){
          return redirect('homeadmin');
        }
        if($user->user_level == 3){
          return redirect('homecostumer');
        }
    }
    else{
      return redirect('login');
    }
});


Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');


Auth::routes();



  Route::patch('/avatarupdate', [UserController::class, 'avatarupdate'])->name('avatarupdate');

  Route::get('/travels-list', [TravelController::class, 'index'])->name('travels.index');
  Route::get('/travels-create', [TravelController::class, 'create'])->name('travels.create');
  Route::post('/travels-create-s', [TravelController::class, 'store'])->name('travels.store');
  Route::post('/travels-create-s2', [TravelController::class, 'store2'])->name('travels.store2');
  Route::get('/travels-edit/{id}', [TravelController::class, 'edit'])->name('travels.edit');
  Route::get('/travels-destroy/{id}', [TravelController::class, 'destroy'])->name('travels.destroy');

  Route::get('/payment-edit/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
  Route::post('/payment-s', [PaymentController::class, 'store'])->name('payment.store');
  Route::patch('/payment-update', [PaymentController::class, 'update'])->name('payment.update');

  Route::get('/checkpayment/{id}', [PaymentController::class, 'checkpayment'])->name('checkpayment');
  Route::get('/checkpaid/{id}', [PaymentController::class, 'checkpaid'])->name('checkpaid');
  Route::get('/checktotal/{id}', [PaymentController::class, 'checktotal'])->name('checktotal');

  Route::get('/checktotal/{id}', [PaymentController::class, 'checktotal'])->name('checktotal');

  Route::get('/paymentrecipet/{id}', [HomeController::class, 'paymentrecipet'])->name('paymentrecipet');

  Route::get('/destination-list', [DestinationsController::class, 'index'])->name('destination.index');
  Route::get('/destination-create', [DestinationsController::class, 'create'])->name('destination.create');
  Route::post('/destination-create-s', [DestinationsController::class, 'store'])->name('destination.store');
  Route::get('/destination-edit/{id}', [DestinationsController::class, 'edit'])->name('destination.edit');
  Route::patch('/destination-update/{id}', [DestinationsController::class, 'update'])->name('destination.update');
  Route::get('/destination-destroy/{id}', [DestinationsController::class, 'destroy'])->name('destination.destroy');


  Route::get('/checkclient/{id}', [HomeController::class, 'checkclient'])->name('checkclient');



// routes for admins (1 admin, 2 vendor, 3 costumer)
Route::middleware(['auth','user-role:1'])->group(function(){
  Route::get('/homeadmin', [UserController::class, 'homeadmin'])->name('homeadmin');
  Route::get('/user-list', [ClientsController::class, 'index'])->name('clients.index');
  Route::get('/user-create', [ClientsController::class, 'create'])->name('clients.create');
  Route::post('/user-create-s', [ClientsController::class, 'store'])->name('clients.store');
  Route::get('/user-edit/{id}', [ClientsController::class, 'edit'])->name('clients.edit');
  Route::patch('/user-update/{id}', [ClientsController::class, 'update'])->name('clients.update');
  Route::get('/user-destroy/{id}', [ClientsController::class, 'destroy'])->name('clients.destroy');

  Route::get('/daily/{id}', [HomeController::class, 'daily'])->name('daily');
  Route::post('/checkdaily/', [HomeController::class, 'checkdaily'])->name('checkdaily');

  Route::get('/agents/', [HomeController::class, 'agents'])->name('agents');
  Route::post('/agents/', [HomeController::class, 'agents'])->name('agents');
});


// routes for costumers
Route::middleware(['auth','user-role:3'])->group(function(){
  Route::get('/homecostumer', [UserController::class, 'homecostumer'])->name('homecostumer');
  Route::get('/my-profile/{hash}', [UserController::class, 'profile'])->name('profile');
  Route::patch('/avatarupdate', [UserController::class, 'avatarupdate'])->name('avatarupdate');
  //reate change
  Route::post('/change-create-s', [ChangesController::class, 'store'])->name('change.store');
});
