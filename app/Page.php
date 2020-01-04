<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function user(){
        return $this->belongsTo("App\ClientUser", "user_id");
    }

    public function website(){
        return $this->belongsTo("App\Website");
    }
}
