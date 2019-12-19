<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatgeoryWebsite extends Model
{
    public function websites(){
        return $this->hasMany("App\Website", "category_id");
    }

    public function templates(){
        return $this->hasMany("App\Website", "category_id")->where("client_id", 1);
    }
}
