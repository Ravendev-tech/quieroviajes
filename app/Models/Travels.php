<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travels extends Model
{
    use HasFactory;

    protected $table = 'travels';
    protected $primaryKey = 'id_travels';

    protected $fillable = [
      'id_travels',
      'localizador',
      'validalocalizador',
      'client_fullname',
      'client_phone',
      'travel_type',
      'travel_from',
      'travel_to',
      'travel_cancelacion',
      'travel_pvp',
      'travel_neto',
      'travel_details',
      'date_departure',
      'date_arrival',
      'passenger_order',
      'id_user',
      'travels_checked'
    ];
}
