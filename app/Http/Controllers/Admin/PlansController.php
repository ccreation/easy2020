<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Website;
use App\Plan;

class PlansController extends AdminBaseController
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
     * Display a listing of plans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(!permissions("plans_index"))
            return redirect()->route("admin.settings.no_permissions");

        $plans = Plan::orderby("created_at", "asc")->get();

        return view("admin.plans.index", compact("plans"));
    }

    /**
     * Show the form for creating a new plan.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        if(!permissions("plans_add"))
            return redirect()->route("admin.settings.no_permissions");

        $websites = Website::where("client_id", 1)->whereNotNull("homepage")->whereNotNull("price")->orderby("created_at", "desc")->get();

        return view("admin.plans.add", compact("websites"));
    }

    /**
     * Store a newly created plan in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request){
        if(!permissions("plans_add"))
            return redirect()->route("admin.settings.no_permissions");

        $plan                       = new Plan;
        $plan->name_ar              = $request->name_ar;
        $plan->name_en              = $request->name_en;
        $plan->monthly_subscription = $request->monthly_subscription;
        $plan->annual_subscription  = $request->annual_subscription;
        $plan->discount_percentage  = $request->discount_percentage;
        $plan->discount_amount      = $request->discount_amount;
        $plan->minimum_subscription_period = $request->minimum_subscription_period;
        $plan->website_numbers      = $request->website_numbers;
        $plan->color                = $request->color;
        $plan->disk_space           = $request->disk_space;
        $plan->root_domain          = $request->root_domain;
        $plan->multiple_users       = $request->multiple_users;
        $plan->default_lang         = $request->default_lang;
        if($request->has("templates") and is_array($request->templates))
            $plan->templates        = serialize($request->templates);
        $plan->save();

        return redirect()->route("admin.plans.index")->with("success", "تم حفظ الباقة بنجاح");
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
     * Show the form for editing the specified plan.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null){
        if(!permissions("plans_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $plan = Plan::find($id);
        if(!$plan or $id==1)
            return back();

        $websites = Website::where("client_id", 1)->whereNotNull("homepage")->whereNotNull("price")->orderby("created_at", "desc")->get();

        return view("admin.plans.edit", compact("websites", "plan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        if(!permissions("plans_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $plan = Plan::find($request->id);
        if(!$plan or $request->id==1)
            return back();

        $plan->name_ar              = $request->name_ar;
        $plan->name_en              = $request->name_en;
        $plan->monthly_subscription = $request->monthly_subscription;
        $plan->annual_subscription  = $request->annual_subscription;
        $plan->discount_percentage  = $request->discount_percentage;
        $plan->discount_amount      = $request->discount_amount;
        $plan->minimum_subscription_period = $request->minimum_subscription_period;
        $plan->website_numbers      = $request->website_numbers;
        $plan->color                = $request->color;
        $plan->disk_space           = $request->disk_space;
        $plan->root_domain          = $request->root_domain;
        $plan->multiple_users       = $request->multiple_users;
        $plan->default_lang         = $request->default_lang;
        if($request->has("templates") and is_array($request->templates))
            $plan->templates        = serialize($request->templates);
        else
            $plan->templates        = null;
        $plan->save();

        return redirect()->route("admin.plans.index")->with("success", "تم تعديل الباقة بنجاح");
    }

    /**
     * Remove the specified plan from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id = null){
        if(!permissions("plans_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $plan = Plan::find($id);
        if(!$plan or $id==1)
            return back();

        $plan->delete();
        return redirect()->route("admin.plans.index")->with("success", "تم حذف الباقة بنجاح");
    }
}
