<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    public function fields(){
        return $this->hasMany("App\FormField", "form_id");
    }

    public function data(){
        return $this->hasMany("App\FormData", "form_id");
    }
}
