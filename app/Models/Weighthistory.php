<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weighthistory extends Model
{
    //
    protected $table = 'weight_history';

    protected $fillable = [
        'competitorId', 'orginal_weight', 'change_weight'
    ];
}
