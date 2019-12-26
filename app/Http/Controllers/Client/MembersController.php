<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Visitor;
use App\Website;

class MembersController extends ClientBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(!cpermissions("members_management_list"))
            return redirect()->route("client.settings.no_permissions");

        $client     = $this->client;
        $visitors   = Visitor::where("client_id", $client->id)->orderby("created_at", "desc")->get();

        return view("client.members.index", compact("visitors"));
    }

    public function deactivate($id=null){
        if(!cpermissions("members_management_update"))
            return redirect()->route("client.settings.no_permissions");

        $client             = $this->client;
        $visitor            = Visitor::where(["id" => $id, "client_id" => $client->id])->first();
        if(!$visitor)
            return back();
        $visitor->status    = 0;
        $visitor->save();

        return back()->with("success", __("l.success_update"));
    }

    public function activate($id=null){
        if(!cpermissions("members_management_update"))
            return redirect()->route("client.settings.no_permissions");

        $client             = $this->client;
        $visitor            = Visitor::where(["id" => $id, "client_id" => $client->id])->first();
        if(!$visitor)
            return back();
        $visitor->status    = 1;
        $visitor->save();

        return back()->with("success", __("l.success_update"));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        if(!cpermissions("members_management_add"))
            return redirect()->route("client.settings.no_permissions");

        $client             = $this->client;
        $websites           = Website::where("client_id", $client->id)->orderby("created_at", "desc")->get();

        return view("client.members.add", compact("websites"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if(!cpermissions("members_management_add"))
            return redirect()->route("client.settings.no_permissions");

        $client                 = $this->client;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:visitors'],
            'password' => ['required', 'string'],
        ]);

        if($request->hasFile("image"))
            $request->validate(["image" => "image"]);

        $visitor                = new Visitor;
        $visitor->client_id     = $client->id;
        $visitor->website_id    = $request->website_id;
        $visitor->name          = $request->name;
        $visitor->email         = $request->email;
        $visitor->password  = bcrypt($request->password);
        if($request->hasFile("image")){
            $path               = $request->image->store("uploads/client/".$client->id);
            $visitor->image     = $path;
        }
        $visitor->status        = $request->status;
        $visitor->save();

        return redirect()->route("client.members.index")->with("success", __("l.success_save"));
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
        if(!cpermissions("members_management_update"))
            return redirect()->route("client.settings.no_permissions");

        $client             = $this->client;
        $visitor            = Visitor::where(["id" => $id, "client_id" => $client->id])->first();
        if(!$visitor)
            return back();

        $websites           = Website::where("client_id", $client->id)->orderby("created_at", "desc")->get();

        return view("client.members.edit", compact("visitor", "websites"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        if(!cpermissions("members_management_update"))
            return redirect()->route("client.settings.no_permissions");

        $client                 = $this->client;
        $visitor                = Visitor::where(["id" => $request->id, "client_id" => $client->id])->first();
        if(!$visitor)
            return back();

        if($request->hasFile("image"))
            $request->validate(["image" => "image"]);

        $visitor->name          = $request->name;
        if($request->password and $request->password!="")
            $visitor->password  = bcrypt($request->password);
        if($request->hasFile("image")){
            if($visitor->image and file_exists(storage_path("app/".$visitor->image)) and is_file(storage_path("app/".$visitor->image)))
                unlink(storage_path("app/".$visitor->image));
            $path               = $request->image->store("uploads/client/".$client->id);
            $visitor->image     = $path;
        }
        $visitor->status        = $request->status;
        $visitor->website_id    = $request->website_id;
        $visitor->save();

        return redirect()->route("client.members.index")->with("success", __("l.success_update"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        if(!cpermissions("members_management_delete"))
            return redirect()->route("client.settings.no_permissions");

        $client             = $this->client;
        $visitor            = Visitor::where(["id" => $id, "client_id" => $client->id])->first();
        if(!$visitor)
            return back();

        $visitor->delete();

        return redirect()->route("client.members.index")->with("success", __("l.success_delete"));
    }
}
