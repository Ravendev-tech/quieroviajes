<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasFactory;

    protected $table = 'points';
    protected $primaryKey = 'id';

    protected $fillable = [
      'client',
      'action',
      'order_id',
      'nro_invoice',
      'points'
    ];
}
