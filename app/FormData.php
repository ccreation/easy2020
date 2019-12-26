<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    public function website(){
        return $this->belongsTo("App\Website", "website_id");
    }
}
