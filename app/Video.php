<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function category(){
        return $this->belongsTo("App\VideoCategory", "category_id");
    }
}
