<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationItem extends Model
{
    protected $table = 'reservation_item';
    public $timestamps = false;
    protected $guarded = [];
}
