<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function client(){
        return $this->belongsTo("App\Client", "client_id");
    }

    public function client_user(){
        return $this->belongsTo("App\ClientUser", "client_user_id");
    }

    public function plan(){
        return $this->belongsTo("App\Plan", "plan_id");
    }

    public function template(){
        return $this->belongsTo("App\Website", "template_id");
    }

    public function website(){
        return $this->belongsTo("App\Website", "website_id");
    }

    public function plugin(){
        return $this->belongsTo("App\Plugin", "plugin_id");
    }

    public function promocode(){
        return $this->belongsTo("Gabievi\Promocodes\Models\Promocode", "promocode_id");
    }

    public function to_bank(){
        return $this->belongsTo("App\Bank", "bank_id");
    }

    public function from_bank(){
        return $this->belongsTo("App\Bank2", "transferer_bank");
    }
}
