<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageCatgeory extends Model
{
    public function images(){
        return $this->hasMany("App\Image", "category_id");
    }
}
