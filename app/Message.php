<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function website(){
        return $this->belongsTo("App\Website", "website_id");
    }
}
