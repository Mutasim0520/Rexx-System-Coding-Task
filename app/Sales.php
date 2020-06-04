<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public $timestamps = false;
    public function product(){
        return $this->belongsTo('App\Products');
    }

    public function customer(){
        return $this->belongsTo('App\Customers');
    }
}
