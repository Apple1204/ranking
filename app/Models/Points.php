<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    //
    protected $table = "points";

    protected $fillable = [
        'competitorId', 'eventId', 'date', 'point', 'ranking'
    ];
}
