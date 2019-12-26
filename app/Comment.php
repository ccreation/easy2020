<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function author(){
        return $this->belongsTo("App\Visitor", "visitor_id");
    }

    public function page(){
        return $this->belongsTo("App\Page", "page_id");
    }

    public function website(){
        return $this->belongsTo("App\Website", "website_id");
    }
}
