<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leagues extends Model
{
    //

    protected $table = 'leagues';

    protected $fillable = [
        'name', 'short_name', 'photo'
    ];
}
