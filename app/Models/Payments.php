<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'id_payments';

    protected $fillable = [
      'id_payments',
      'localizador',
      'payment_method',
      'payment_amount',
      'payment_date',
      'payment_status',
      'id_user',
      'payments_checked'
    ];
}
