<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeProduct extends Model
{
    use HasFactory;

    public $fillable = [
        'size'
    ];
}
