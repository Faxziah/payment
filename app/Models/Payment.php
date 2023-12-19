<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'outer_payment_id',
        'type',
        'user_login',
        'requisites',
        'sum',
        'currency',
        'status'
    ];
}
