<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    public function category(){
        return $this->belongsTo("App\CategoryDocumentation", "category_id");
    }
}
