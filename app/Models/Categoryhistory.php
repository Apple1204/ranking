<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoryhistory extends Model
{
    //
    protected $table = 'category_history';
    protected $fillable = [
        'competitorId', 'orginal_category', 'change_category'
    ];
}
