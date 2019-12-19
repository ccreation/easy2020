<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Promocodes;
use Gabievi\Promocodes\Models\Promocode;

class PromocodesController extends AdminBaseController
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
     * Display a listing of promocodes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(!permissions("promocodes_index"))
            return redirect()->route("admin.settings.no_permissions");

        $promocodes = Promocode::orderby("id", "desc")->get();
        foreach ($promocodes as $promocode)
            if(!is_array($promocode->data))
                $promocode->data = json_decode($promocode->data, true);

        return  view("admin.promocodes.index", compact("promocodes"));
    }

    /**
     * Store a newly created promocode in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request){
        if(!permissions("promocodes_add"))
            return redirect()->route("admin.settings.no_permissions");

        $expire_in = Carbon::parse($request->expires_at)->diffInDays(Carbon::now());

        Promocodes::create(1, $request->reward, ["name" => $request->name, "status" => $request->status, "type" => $request->type, "reward_type" => $request->reward_type], $expire_in, $request->quantity, ($request->type=="0")?false:true);

        return redirect()->back()->with("success", "تم حفظ الكوبون الجديد");
    }

    /**
     * Display the specified promocode statistics.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function statistics($id = null)
    {
        $promocode = Promocode::find($id);
        if(!$promocode)
            return back();

        return  view("admin.promocodes.statistics", compact("promocode"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id= null){
        if(!permissions("promocodes_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $promocode = Promocode::find($id);
        if(!$promocode)
            return back();

        if(!is_array($promocode->data))
            $promocode->data = json_decode($promocode->data, true);

        return  view("admin.promocodes.edit", compact("promocode"));
    }

    /**
     * Update the specified romocode in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        if(!permissions("promocodes_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $promocode              = Promocode::find($request->id);
        if(!$promocode)
            return back();

        $promocode->code        = $request->code;
        $promocode->reward      = $request->reward;
        $promocode->quantity    = $request->quantity;
        $promocode->data        = json_encode(["name" => $request->name, "status" => $request->status, "type" => $request->type, "reward_type" => $request->reward_type], true);
        $promocode->is_disposable = ($request->type=="0")?false:true;
        $promocode->expires_at  = ($request->expires_at and $request->expires_at!="")?Carbon::parse($request->expires_at):null;
        $promocode->save();

        return redirect()->route("admin.promocodes.index")->with("success", "تم تعديل الكوبون بنجاح");
    }

    /**
     * Remove the specified promocode from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id = null){
        if(!permissions("promocodes_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $promocode = Promocode::find($id);
        if(!$promocode)
            return back();

        $promocode->delete();

        return redirect()->route("admin.promocodes.index")->with("success", "تم حذف الكوبون بنجاح");
    }
}
