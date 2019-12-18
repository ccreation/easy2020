<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    /*public function pages(){
        return $this->hasMany("App\Page");
    }

    public function category(){
        return $this->belongsTo("App\CatgeoryWebsite", "category_id");
    }
    public function visits(){
        return $this->hasMany("Sarfraznawaz2005\VisitLog\Models\VisitLog");
    }
    */

    public function user(){
        return $this->belongsTo("App\ClientUser", "user_id");
    }

    public function client(){
        return $this->belongsTo("App\Client", "client_id");
    }
    
}
