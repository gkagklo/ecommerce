<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
