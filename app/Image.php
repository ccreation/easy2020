<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function category(){
        return $this->belongsTo("App\ImageCatgeory", "category_id");
    }
}
