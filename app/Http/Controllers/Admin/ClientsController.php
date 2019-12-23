<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Subscription;
use Illuminate\Http\Request;
use App\Client;
use App\ClientUser;
use App\Plan;
use View;
use Gabievi\Promocodes\Models\Promocode;
use App\Page;
use App\Payment;
use App\Ticket;
use App\Website;

class ClientsController extends AdminBaseController
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
     * Show the general dashboard clients.
     *
     * @return a view of clients index
     */
    public function index(){
        if(!permissions("clients"))
            return redirect()->route("admin.settings.no_permissions");


        $clients    = Client::with("plan")->orderby("created_at", "desc")->get();
        foreach ($clients as $client){
            $subscription = Subscription::where(["status" => "accepted", "plan_id" => $client->plan_id])->where("client_id", $client->id)->orderby("created_at", "desc")->first();
            $client->subscription = $subscription;
        }
        $plans      = Plan::orderby("created_at", "desc")->get();
        $promocodes = Promocode::all();
        foreach ($promocodes as $promocode)
            if(!is_array($promocode->data))
                $promocode->data = json_decode($promocode->data, true);

        $settings           = Setting::all()->KeyBy("key");
        $employee_columns   = (@$settings["employee_columns"]) ? explode(";", @$settings["employee_columns"]->value) : [];


        return view('admin.clients.index', compact("clients", "plans", "promocodes", "employee_columns"));
    }

    /**
     * Client create from.
     *
     * @return a view
     */
    public function add(){
        if(!permissions("add_client"))
            return redirect()->route("admin.settings.no_permissions");

        $plans = Plan::orderby("created_at", "desc")->get();

        return view('admin.clients.add', compact("plans"));
    }

    /**
     * Save the client
     * @param  Request  $request
     * @return a redirect to clients list (index)
     */
    public function save(Request $request){
        if(!permissions("add_client"))
            return redirect()->route("admin.settings.no_permissions");

        $request->validate([
            "name"      => "required",
            "name2"      => "required",
            "email"     => "required|email|unique:client_users",
            "mobile"    => "required|unique:client_users",
            "password"  => "required"
        ]);

        if($request->hasFile("image"))
            $request->validate(["image" => "image"]);

        $client           = new Client;
        $client->name     = $request->name;
        $client->plan_id  = $request->plan_id;
        if($request->hasFile("image")){
            $client->image  = $request->image->store("uploads/clients");
        }
        $client->save();

        $clientUser             = new ClientUser;
        $clientUser->client_id  = $client->id;
        $clientUser->name       = $request->name2;
        $clientUser->email      = $request->email;
        $clientUser->mobile     = $request->mobile;
        $clientUser->password   = bcrypt($request->password);
        $clientUser->default    = 1;
        $clientUser->save();

        return redirect()->route("admin.clients.index")->with("success", __("l.success_save"));
    }

    /**
     * Delete the client
     * @param  Client id  $id
     * @return a redirect to clients list (index)
     */
    public function delete($id=null){
        if(!permissions("remove_client"))
            return redirect()->route("admin.settings.no_permissions");

        $client           = Client::find($id);
        if($client and $client->image and file_exists(storage_path("app/".$client->image)) and is_file(storage_path("app/".$client->image)))
            unlink(storage_path("app/".$client->image));

        ClientUser::where("client_id", $id)->delete();
        Page::where("client_id", $id)->delete();
        Payment::where("client_id", $id)->delete();
        Subscription::where("client_id", $id)->delete();
        Ticket::where("client_id", $id)->delete();
        Website::where("client_id", $id)->delete();
        
        $client->delete();

        return back()->with("success", __("l.success_delete"));
    }

    /**
     * Edit a client
     * @param  Client id  $id
     * @return a redirect to clients list (index)
     */
    public function edit($id=null){
        if(!permissions("update_client"))
            return redirect()->route("admin.settings.no_permissions");

        $client           = Client::find($id);
        if(!$client)
            return back();

        $plans = Plan::orderby("created_at", "desc")->get();

        return view('admin.clients.edit', compact("client", "plans"));
    }

    /**
     * Update the client
     * @param  Request  $request
     * @return a redirect to clients list (index)
     */
    public function update(Request $request){
        if(!permissions("update_client"))
            return redirect()->route("admin.settings.no_permissions");

        $request->validate([
            "id"=>"required",
            "name"=>"required",
        ]);

        if($request->hasFile("image"))
            $request->validate(["image" => "image"]);

        $client                 = Client::find($request->id);
        if($client){
            $client->name       = $request->name;
            $client->plan_id    = $request->plan_id;
            $client->status     = $request->status;
            if($request->hasFile("image")){
                if($client and $client->image and file_exists(storage_path("app/".$client->image)) and is_file(storage_path("app/".$client->image)))
                    unlink(storage_path("app/".$client->image));
                $client->image  = $request->image->store("uploads/clients");
            }
            $client->save();
        }

        return redirect()->route("admin.clients.index")->with("success", __("l.success_update"));
    }

    /**
     * Edit a client
     * @param  Client id  $id
     * @return a redirect to clients list (index)
     */
    public function show($id=null){
        if(!permissions("show_client"))
            return redirect()->route("admin.settings.no_permissions");

        $client           = Client::with("websites.pages")->where("id", $id)->first();
        if(!$client)
            return back();

        $size0 = 0;
        $f = storage_path("app/uploads/client/".$client->id);
        if(is_dir($f)){
            $io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
            $size = fgets ( $io, 4096);
            $size = substr ( $size, 0, strpos ( $size, "\t" ) );
            $size0 += $size;
            pclose ( $io );
        }
        $f = storage_path("app/uploads/clients/".$client->id);
        if(is_dir($f)){
            $io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
            $size = fgets ( $io, 4096);
            $size = substr ( $size, 0, strpos ( $size, "\t" ) );
            $size0 += $size;
            pclose ( $io );
        }
        $my_size =  intval($size0/1024);

        $plans = Plan::orderby("created_at", "desc")->get();

        $subscription = Subscription::where(["status" => "accepted", "plan_id" => $client->plan_id])->where("client_id", $client->id)->orderby("created_at", "desc")->first();
        $client->subscription = $subscription;

        return view('admin.clients.show', compact("client", "plans", "my_size"));
    }

    public function employee_columns(Request $request){
        $employee_columns   = implode(";", $request->employee_columns);
        $setting            = Setting::where("key", "employee_columns")->first();
        if(!$setting){
            $setting        = new Setting;
            $setting->key   = "employee_columns";
        }
        $setting->value     = $employee_columns;
        $setting->save();
    }

}
