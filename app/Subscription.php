<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public function plan(){
        return $this->belongsTo("App\Plan");
    }

    public function payment(){
        return $this->belongsTo("App\Payment", "payment_id");
    }
}
