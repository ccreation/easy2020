<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\CategoryDocumentation;
use App\Plan;
use App\Documentation;

class DocumentationsController extends AdminBaseController
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if(!permissions("documentations_index"))
            return redirect()->route("admin.settings.no_permissions");

        $categories         = CategoryDocumentation::orderby("created_at", "desc")->get();
        $documentations     = Documentation::with("category")->orderby("order", "asc")->get();
        $plans              = Plan::orderby("created_at", "desc")->get();

        return view("admin.documentations.index", compact("categories", "documentations", "plans"));
    }

    public function save_category(Request $request){
        if(!permissions("documentations_cat_add"))
            return redirect()->route("admin.settings.no_permissions");

        $category       = new CategoryDocumentation;
        $category->name = $request->name;
        $category->save();

        return back()->with("success", "تم حفظ البيانات بنجاح");
    }

    public function update_category(Request $request){
        if(!permissions("documentations_cat_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $category       = CategoryDocumentation::find($request->id);
        if(!$category)
            return back();

        $category->name = $request->name;
        $category->save();

        return back()->with("success", "تم تعديل البيانات بنجاح");
    }

    public function delete_category($id = null){
        if(!permissions("documentations_cat_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $category       = CategoryDocumentation::find($id);
        if(!$category)
            return back();

        $category->delete();

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    public function create(){
        if(!permissions("documentations_add"))
            return redirect()->route("admin.settings.no_permissions");

        $categories = CategoryDocumentation::orderby("created_at", "asc")->get();
        $plans      = Plan::orderby("created_at", "asc")->get();

        return view("admin.documentations.create", compact("categories", "plans"));
    }

    public function store(Request $request){
        if(!permissions("documentations_add"))
            return redirect()->route("admin.settings.no_permissions");

        $documentation                  = new Documentation;

        $order                          = Documentation::count();
        $order                          = ($order == 0) ? 1 : $order;

        $documentation->order           = $order;
        $documentation->category_id     = $request->category_id;
        $documentation->plans           = ($request->plans and is_array($request->plans)) ? implode(";", $request->plans) : null;
        $documentation->question        = $request->question;
        $documentation->answer          = $request->answer;
        $documentation->save();

        return redirect()->route("admin.documentations.index")->with("success", "تم حفظ البيانات بنجاح");
    }

    public function destroy($id = null){
        if(!permissions("documentations_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $documentation  = Documentation::find($id);
        if(!$documentation)
            return back();

        $documentation->delete();

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    public function edit($id = null){
        if(!permissions("documentations_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $documentation  = Documentation::find($id);
        if(!$documentation)
            return back();

        $categories = CategoryDocumentation::orderby("created_at", "asc")->get();
        $plans      = Plan::orderby("created_at", "asc")->get();

        return view("admin.documentations.edit", compact("categories", "plans", "documentation"));
    }

    public function update(Request $request){
        if(!permissions("documentations_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $documentation  = Documentation::find($request->id);
        if(!$documentation)
            return back();

        $documentation->category_id     = $request->category_id;
        $documentation->plans           = ($request->plans and is_array($request->plans)) ? implode(";", $request->plans) : null;
        $documentation->question        = $request->question;
        $documentation->answer          = $request->answer;
        $documentation->save();

        return redirect()->route("admin.documentations.index")->with("success", "تم تعديل البيانات بنجاح");
    }

    public function order($id = null, $order = 1){
        $documentation          = Documentation::find($id);
        if(!$documentation)
            return back();

        $documentation->order   = $order;
        $documentation->save();
    }

}
