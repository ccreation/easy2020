<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function templates(){
        return $this->belongsToMany('App\Website', "client_template", "client_id", "template_id")->withTimestamps()->withPivot(["website_id", "status", "plan_id", "payment_id", "price"]);
    }

    /*public function settings()
    {
        return $this->hasMany("App\ClientSetting", "client_id");
    }





    public function plugins()
    {
        return $this->belongsToMany('App\Plugin', "client_plugin", "client_id", "plugin_id")->withTimestamps()->withPivot(["plugin_id", "status", "payment_id", "price"]);
    }

    public function my_plugins()
    {
        return $this->belongsToMany('App\Plugin', "client_plugin", "client_id", "plugin_id")->withTimestamps()->withPivot(["plugin_id", "status", "payment_id", "price"])->where("status", "accepted");
    }*/

    public function websites(){
        return $this->hasMany("App\Website");
    }

    public function plan(){
        return $this->belongsTo('App\Plan', "plan_id");
    }

    public function default_user(){
        return $this->hasMany('App\ClientUser', "client_id")->where("default", 1);
    }
}
