<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Plan;
use App\Website;
use App\Client;
use App\Subscription;
use App\Payment;

class SubscriptionsController extends ClientBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(!cpermissions("my_subscriptions_list"))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;
        $c              = Client::find($client->id);
        $templates      = $c->templates;
        foreach ($templates as $template){
            if(@$template->pivot->website_id){
                $website    = Website::where(["client_id" => $c->id, "id" => @$template->pivot->website_id])->first();
                $template->setAttribute("website", $website);

            }else{
                $template->setAttribute("website", null);
            }
        }

        $plugins      = $c->plugins;
        $subscriptions = Subscription::with("plan")->where("client_id", $c->id)->get();

        return view("client.subscriptions.index", compact("templates", "subscriptions", "plugins"));
    }
}
