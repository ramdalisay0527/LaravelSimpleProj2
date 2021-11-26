<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followuser extends Model
{
    function user(){
        return $this->belongsTo('App\Models\User');
    }
    use HasFactory;
}
