<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productimages extends Model
{
    use HasFactory;

    function product(){
        return $this->belongsTo('App\Models\Product');
    }
    function user(){
        return $this->belongsTo('App\Models\User');
    }
    
}
