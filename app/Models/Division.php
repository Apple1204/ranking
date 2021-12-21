<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    //
    protected $table = 'division';

    protected $fillable = [
        'categoryId', 'gender', 'weight'
    ];
}
