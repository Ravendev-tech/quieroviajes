<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changes extends Model
{
    use HasFactory;

    protected $table = 'changes';
    protected $primaryKey = 'id_change';

    protected $fillable = [
      'id_client',
      'id_product',
      'points',
      'status',
    ];
}
