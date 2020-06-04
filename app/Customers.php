<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    public $timestamps = false;
    public function sale(){
        return $this->belongsTo('App\Sales');
    }
}
