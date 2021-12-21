<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventOut extends Model
{
    //
    protected $table = "event_out";
    
    protected $fillable = [
        'eventId', 'competitorId', 'new_point'
    ];
}

