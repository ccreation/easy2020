<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UsersController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Show the general dashboard users.
     *
     * @return a view of users index
     */
    public function index(){
        if(!permissions("users"))
            return redirect()->route("admin.settings.no_permissions");

        $users = User::with("role")->orderby("created_at", "desc")->get();
        $roles = Role::orderby("created_at", "desc")->get();

        return view('admin.users.index', compact("users", "roles"));
    }

    /**
     * User create from.
     *
     * @return a view
     */
    public function add(){
        if(!permissions("add_user"))
            return redirect()->route("admin.settings.no_permissions");

        $roles = Role::orderby("created_at", "desc")->get();

        return view('admin.users.add', compact("roles"));
    }

    /**
     * Save the user
     * @param  Request  $request
     * @return a redirect to users list (index)
     */
    public function save(Request $request){
        if(!permissions("add_user"))
            return redirect()->route("admin.settings.no_permissions");

        $request->validate(["name"=>"required",
            "role_id"=>"required",
            "email"=>"required|email|unique:users",
            "mobile"=>"required|string|unique:users",
            "password"=>"required"]);

        $user           = new User;
        $user->name     = $request->name;
        $user->role_id  = $request->role_id;
        $user->email    = $request->email;
        $user->mobile   = $request->mobile;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route("admin.users.index")->with("success", __("l.success_save"));
    }

    /**
     * Delete the user
     * @param  User id  $id
     * @return a redirect to users list (index)
     */
    public function delete($id=null){
        if(!permissions("remove_user"))
            return redirect()->route("admin.settings.no_permissions");

        if($id!=1){
            $user           = User::find($id);
            $user->delete();
        }

        return back()->with("success", __("l.success_delete"));
    }

    /**
     * User edit from.
     * @param user id $id
     * @return a view
     */
    public function edit($id=null){
        if(!permissions("update_user"))
            return redirect()->route("admin.settings.no_permissions");

        if($id!=1){
            $user = User::find($id);
            if(!$user)
                return back();
        }else{
            return back();
        }

        $roles = Role::orderby("created_at", "desc")->get();

        return view('admin.users.edit', compact("roles", "user"));
    }

    /**
     * Update the user
     * @param  Request  $request
     * @return a redirect to users list (index)
     */
    public function update(Request $request){
        if(!permissions("update_user"))
            return redirect()->route("admin.settings.no_permissions");

        if($request->id==1)
            return back();

        $request->validate(["name"=>"required",
            "role_id"=>"required",
            "mobile"=>"required|string",
            "email"=>"required|email"
            ]);

        $userx = User::where("id", "!=", $request->id)->where("email", $request->email)->first();
        if($userx)
            return back()->with("error", "الإيميل مستعمل من قبل مستخدم آخر");

        $usery = User::where("id", "!=", $request->id)->where("mobile", $request->mobile)->first();
        if($usery)
            return back()->with("error", "رقم الجوال مستعمل من قبل مستخدم آخر");

        $user           = User::find($request->id);

        if($user){
            $user->name     = $request->name;
            $user->role_id  = $request->role_id;
            $user->email    = $request->email;
            $user->mobile   = $request->mobile;
            if($request->password and $request->password!="")
                $user->password = bcrypt($request->password);
            $user->save();
        }

        return redirect()->route("admin.users.index")->with("success", __("l.success_update"));
    }

}
