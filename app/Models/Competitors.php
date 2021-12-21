<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competitors extends Model
{
    //
    protected $table = 'competitors';
    
    protected $fillable = [
        'first_name', 'last_name', 'photo', 'gender', 'leagueId', 'divisionId'
    ];
}
