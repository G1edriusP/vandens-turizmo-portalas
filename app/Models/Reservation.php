<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    public $timestamps = false;
    protected $guarded = [];

    protected $casts = [
        'data_from' => 'date',
        'data_to' => 'date'
    ];
}
