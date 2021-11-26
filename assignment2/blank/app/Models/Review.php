<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    function product(){
        return $this->belongsTo('App\Models\Product');
    }
    function user(){
        return $this->belongsTo('App\Models\User');
    }
    function reviewlikes(){
        return $this->hasMany('App\Models\Reviewlikes');
    }
    function followuser(){
        return $this->hasMany('App\Models\Followuser');
    }
    use HasFactory;
}
