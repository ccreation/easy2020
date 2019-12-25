<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    public function website(){
        return $this->belongsTo("App\Website", "website_id");
    }
}
