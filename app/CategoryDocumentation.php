<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDocumentation extends Model
{

    public function documentations(){
        return $this->hasMany("App\Documentation", "category_id")->orderby("order", "asc");
    }

}
