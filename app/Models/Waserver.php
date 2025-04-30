<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waserver extends Model
{
    //

    // add fillable
    protected $fillable = [
        'host',
        'apikey'
    ];
    // add guaded
    protected $guarded = ['id'];
    // add hidden
    protected $hidden = ['created_at', 'updated_at'];
}
