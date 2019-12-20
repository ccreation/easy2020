<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function payments(){
        return $this->morphMany('App\Payment', 'paymentable');
    }

    public function clients(){
        return $this->hasMany('App\Client', 'plan_id');
    }
}
