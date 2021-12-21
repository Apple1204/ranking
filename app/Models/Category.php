<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';

    protected $fillable = [
        'name', 'age_min', 'age_max'
    ];
}
