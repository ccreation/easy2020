<?php

namespace App\Http\Controllers\Client;


use Illuminate\Http\Request;
use App\ClientUser;
use App\Client;
use App\ClientRole;
use App\Plan;

class UsersController extends ClientBaseController{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Show the client dashboard users.
     *
     * @return a view of users index
     */
    public function index(){
        if(!cpermissions("users_section_list"))
            return redirect()->route("client.settings.no_permissions");

        $users      = ClientUser::with("role")->where("client_id", $this->client->id)->orderby("created_at", "desc")->paginate(20);

        $client     = Client::find(@$this->client->id);
        $plan       = Plan::find($client->plan_id);
        if($plan->multiple_users!=1)
            return back();

        $roles      = ClientRole::where("client_id", $client->id)->orderby("created_at", "asc")->get();

        return view('client.users.index', compact("users", "roles"));
    }

    /**
     * ClientUser create from.
     *
     * @return a view
     */
    public function add(){
        if(!cpermissions("users_section_add"))
            return redirect()->route("client.settings.no_permissions");

        $c          = Client::find(@$this->client->id);
        $plan       = Plan::find($c->plan_id);
        if($plan->multiple_users!=1)
            return back();

        $roles      = ClientRole::where("client_id", $c->id)->orderby("created_at", "asc")->get();

        return view('client.users.add', compact("roles"));
    }

    /**
     * Save the clientuser
     * @param  Request  $request
     * @return a redirect to clientusers list (index)
     */
    public function save(Request $request){
        $c          = Client::find(@$this->client->id);
        $plan       = Plan::find($c->plan_id);
        if($plan->multiple_users!=1)
            return back();

        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:client_users",
            "mobile"=>"required|unique:client_users",
            "password"=>"required"
        ]);

        if($request->hasFile("image"))
            $request->validate(["image"=>"image"]);


        $user               = new ClientUser;
        $user->client_id    = $this->client->id;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->mobile       = $request->mobile;
        $user->role_id      = $request->role_id;
        $user->password = bcrypt($request->password);
        if($request->hasFile("image"))
            $user->image = $request->image->store("uploads/clients");
        $user->status = 1;
        $user->save();

        return redirect()->route("client.users.index")->with("success", __("l.success_save"));
    }

    /**
     * Delete the user
     * @param  ClientUser id  $id
     * @return a redirect to users list (index)
     */
    public function delete($id=null){
        if(!cpermissions("users_section_delete"))
            return redirect()->route("client.settings.no_permissions");

        $c          = Client::find(@$this->client->id);
        $plan       = Plan::find($c->plan_id);
        if($plan->multiple_users!=1)
            return back();

        $user           = ClientUser::where(["id" => $id, "client_id"=>$this->client->id])->first();
        if($user->default==1)
            return back();

        if($user->image and file_exists(storage_path("app/".$user->image)) and is_file(storage_path("app/".$user->image)))
            unlink(storage_path("app/".$user->image));
        $user->delete();

        return back()->with("success", __("l.success_delete"));
    }

    /**
     * ClientUser edit from.
     *
     * @return a view
     */
    public function edit($id=null){
        if(!cpermissions("users_section_edit"))
            return redirect()->route("client.settings.no_permissions");

        $c          = Client::find(@$this->client->id);
        $plan       = Plan::find($c->plan_id);
        if($plan->multiple_users!=1)
            return back();

        $user = ClientUser::where(["id" => $id, "client_id"=>$this->client->id])->first();
        if(!$user)
            return back();

        $roles      = ClientRole::where("client_id", $c->id)->orderby("created_at", "asc")->get();

        return view('client.users.edit', compact("user", "roles"));
    }

    /**
     * Update the user
     * @param  Request  $request
     * @return a redirect to users list (index)
     */
    public function update(Request $request){
        if(!cpermissions("users_section_edit"))
            return redirect()->route("client.settings.no_permissions");

        $c          = Client::find(@$this->client->id);
        $plan       = Plan::find($c->plan_id);
        if($plan->multiple_users!=1)
            return back();

        $request->validate([
            "id"    => "required",
            "name"  => "required",
            "email" => "required|email",
            "mobile"=> "required"
            ]);

        $userx = ClientUser::where("id", "!=", $request->id)->where("email", $request->email)->first();
        if($userx)
            return back()->with("error", __("l.email_used"));

        $usery = ClientUser::where("id", "!=", $request->id)->where("mobile", $request->mobile)->first();
        if($usery)
            return back()->with("error", __("l.mobile_used"));

        $user           = ClientUser::where(["id" => $request->id, "client_id"=>$this->client->id])->first();
        if(!$user)
            return back();

        if($request->hasFile("image"))
            $request->validate(["image"=>"image"]);

        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->mobile       = $request->mobile;
        $user->role_id      = $request->role_id;
        if($request->password and $request->password!="")
            $user->password = bcrypt($request->password);
        if($request->hasFile("image")){
            if($user->image and file_exists(storage_path("app/".$user->image)) and is_file(storage_path("app/".$user->image)))
                unlink(storage_path("app/".$user->image));
            $user->image = $request->image->store("uploads/clients");
        }

        $user->status = $request->status;
        $user->save();
        return redirect()->route("client.users.index")->with("success", __("l.success_update"));
    }

}
