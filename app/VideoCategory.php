<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    public function videos(){
        return $this->hasMany("App\Video", "category_id");
    }
}
