<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Plan;
use App\Website;
use App\Client;
use App\Bank;
use App\Subscription;
use App\Setting;
use Promocodes;
use Gabievi\Promocodes\Models\Promocode;

class PlansController extends ClientBaseController
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
        if(!cpermissions("plans_list"))
            return redirect()->route("client.settings.no_permissions");

        $plans = Plan::orderby("created_at", "desc")->get();
        $client     = $this->client;
        $c          = Client::find($client->id);
        foreach ($plans as $plan){
            $subscription = Subscription::where(["client_id" => $c->id, "plan_id" => $plan->id])->latest('id')->first();
            if($subscription){
                $plan->status = $subscription->status;
            }
            if($plan->id == 1){
                $plan->status = "accepted";
            }
        }

        return  view("client.plans.index", compact("plans", "c"));
    }

    /**
     * Show the form for buying a plan.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function buy($id = null){
        if(!cpermissions("plans_purchase_use"))
            return redirect()->route("client.settings.no_permissions");

        $client     = $this->client;
        $c          = Client::find($client->id);
        if($c->plan_id == $id)
            return back();

        $plan       = Plan::find($id);
        if(!$plan or $id==1)
            return back();

        $templates  = collect();
        if($plan->templates and is_array(unserialize($plan->templates))){
            foreach (unserialize($plan->templates) as $idd){
                $template = Website::where(["client_id" => 1, "id" => $idd])->first();
                if($template)
                    $templates->add($template);
            }
        }

        $c              = Client::find($client->id);
        $sold_templates = [];
        foreach ($c->templates as $t){
            array_push($sold_templates, $t);
        }

        $subscription = Subscription::where(["client_id" => $c->id, "plan_id" => $plan->id])->latest('id')->first();
        if($subscription){
            if($subscription->status=="accepted"){
                //$c->plan_id = $id;
                //$c->save();
                return back();
            }elseif($subscription->status=="rejected"){
            }else{
                return back();
            }
        }
        $settings_admin = Setting::all()->KeyBy("key");

        return view("client.plans.buy", compact("plan", "templates", "sold_templates", "settings_admin"));
    }

    public function details($id = null){
        if(!cpermissions("plans_purchase_use"))
            return redirect()->route("client.settings.no_permissions");

        $client     = $this->client;
        $c          = Client::find($client->id);
        if($c->plan_id != $id)
            return back();

        $plan       = Plan::find($id);
        if(!$plan or $id==1)
            return back();

        $subscription = Subscription::where(["client_id" => $c->id, "plan_id" => $plan->id])->latest('id')->first();
        /*if($subscription){
            if($subscription->status!="accepted"){
                return back();
            }
        }else{
            return back();
        }*/
        $settings_admin = Setting::all()->KeyBy("key");

        return view("client.plans.details", compact("plan", "settings_admin", "subscription"));
    }

    /**
     * Calculate coupon.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function coupon(Request $request)
    {
        $client             = $this->client;
        $plan               = Plan::find($request->plan_id);
        if(!$plan or $request->plan_id==1)
            return response()->json([], 404);
        $promocode_check    = Promocodes::check($request->coupon_code);
        $promocode          = Promocode::where("code", $request->coupon_code)->first();
        if(!$promocode_check or !$promocode)
            return response()->json([], 404);

        if(!is_array($promocode->data))
            $promocode->data = json_decode($promocode->data, true);

        $total = $plan->monthly_subscription * $request->months_number+$plan->annual_subscription*$request->years_number;

        if(@$promocode->data["reward_type"]==0)
            $total = ($total - ($total/100*floatval($promocode->reward)));
        else
            $total = $total - floatval($promocode->reward);

        $total = ($total<=0)?0:$total;
        $total = number_format($total, 1);

        return response()->json(["total" => $total], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
