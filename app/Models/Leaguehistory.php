<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaguehistory extends Model
{
    //
    protected $table = 'league_history';

    protected $fillable = [
        'competitorId', 'orginal_leagueId', 'change_leagueId'
    ];
}
