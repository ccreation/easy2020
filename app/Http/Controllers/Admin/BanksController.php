<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Bank;
use App\Bank2;

class BanksController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(!permissions("banks_index"))
            return redirect()->route("admin.settings.no_permissions");

        $banks  = Bank::orderby("created_at", "desc")->get();
        $banks2 = Bank2::orderby("created_at", "desc")->get();

        return view("admin.banks.index", compact("banks", "banks2"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        if(!permissions("banks_add"))
            return redirect()->route("admin.settings.no_permissions");

        return view("admin.banks.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if(!permissions("banks_add"))
            return redirect()->route("admin.settings.no_permissions");

        $bank                   = new Bank;
        $bank->name             = $request->name;
        $bank->account_number   = $request->account_number;
        $bank->iban             = $request->iban;
        $bank->save();

        return redirect()->route("admin.banks.index")->with("success", "تم حفظ البيانات بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if(!permissions("banks_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $bank = Bank::find($id);
        if(!$bank)
            return back();

        return view("admin.banks.edit", compact("bank"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(!permissions("banks_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $bank = Bank::find($id);
        if(!$bank)
            return back();

        $bank->name             = $request->name;
        $bank->account_number   = $request->account_number;
        $bank->iban             = $request->iban;
        $bank->save();

        return redirect()->route("admin.banks.index")->with("success", "تم حذف البيانات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(!permissions("banks_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $bank = Bank::find($id);
        if(!$bank)
            return back();

        $bank->delete();

        return redirect()->route("admin.banks.index")->with("success", "تم حذف البيانات بنجاح");
    }

    public function banks2_create(){
        if(!permissions("banks_add"))
            return redirect()->route("admin.settings.no_permissions");

        return view("admin.banks.banks2.create");
    }

    public function banks2_store(Request $request){
        if(!permissions("banks_add"))
            return redirect()->route("admin.settings.no_permissions");

        $bank                   = new Bank2;
        $bank->name_ar          = $request->name_ar;
        $bank->name_en          = $request->name_en;
        $bank->save();

        return redirect()->route("admin.banks.index")->with("success", "تم حفظ البيانات بنجاح");
    }

    public function banks2_edit($id){
        if(!permissions("banks_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $bank = Bank2::find($id);
        if(!$bank)
            return back();

        return view("admin.banks.banks2.edit", compact("bank"));
    }

    public function banks2_update(Request $request, $id){
        if(!permissions("banks_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $bank = Bank2::find($id);
        if(!$bank)
            return back();

        $bank->name_ar          = $request->name_ar;
        $bank->name_en          = $request->name_en;
        $bank->save();

        return redirect()->route("admin.banks.index")->with("success", "تم حذف البيانات بنجاح");
    }

    public function banks2_destroy($id){
        if(!permissions("banks_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $bank = Bank2::find($id);
        if(!$bank)
            return back();

        $bank->delete();

        return redirect()->route("admin.banks.index")->with("success", "تم حذف البيانات بنجاح");
    }

}
