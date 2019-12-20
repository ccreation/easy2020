<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function type(){
        return $this->belongsTo("App\TicketType", "ticket_type_id");
    }

    public function client(){
        return $this->belongsTo("App\Client", "client_id");
    }

    public function user(){
        return $this->belongsTo("App\User", "user_id");
    }

    public function website(){
        return $this->belongsTo("App\Website", "website_id");
    }

    public function replies(){
        return $this->hasMany("App\Ticket", "parent_id")->orderBy('created_at', "desc");
    }
}
