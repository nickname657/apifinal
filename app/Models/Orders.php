<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;


    // pagada o pendiente

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
    ];
}
