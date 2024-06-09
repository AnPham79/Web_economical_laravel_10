<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = "shippings";

    public $fillable = [
        'order_id',
        'user_name',
        'mobile',
        'email',
        'province',
        'city',
        'commune',
        'address2'
    ];
}
