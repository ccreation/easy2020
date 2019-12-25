<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Plan;
use App\Setting;
use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use App\CatgeoryWebsite;
use App\Website;
use App\Notification;

class WebsiteController extends AdminBaseController
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

    // Templates

    /**
     * Show the templates list
     *
     * @return View
     */
    public function index(){
        if(!permissions("websites_index"))
            return redirect()->route("admin.settings.no_permissions");

        $catgeories         = CatgeoryWebsite::orderby("created_at", "asc")->get();
        $websites           = Website::withCount("pages")->withCount("visits")->with("category", "client")->where("client_id","!=", 1)->orderby("created_at", "desc")->get();
        foreach ($websites as $website){
            $client = $website->client;
            if($client){
                $subscription = Subscription::where(["status" => "accepted", "plan_id" => $client->plan_id])->where("client_id", $client->id)->orderby("created_at", "desc")->first();
                $client->subscription = $subscription;
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
                $client->my_size =  intval($size0/1024);
            }
        }

        $plans              = Plan::orderby("created_at", "desc")->get();
        $settings           = Setting::all()->KeyBy("key");
        $website_columns    = (@$settings["website_columns"]) ? explode(";", @$settings["website_columns"]->value) : [];
        $clients            = Client::orderby("created_at", "asc")->get();

        return view("admin.websites.index", compact("catgeories", "websites", "website_columns", "plans", "clients"));
    }

    public function website_columns(Request $request){
        $website_columns   = implode(";", $request->website_columns);
        $setting            = Setting::where("key", "website_columns")->first();
        if(!$setting){
            $setting        = new Setting;
            $setting->key   = "website_columns";
        }
        $setting->value     = $website_columns;
        $setting->save();
        dd($setting);
    }

    public function block(Request $request){
        if(!permissions("websites_block"))
            return redirect()->route("admin.settings.no_permissions");

        $website = Website::find($request->id);
        if(!$website)
            return back();

        $website->status = 0;
        $website->block_reason = $request->block_reason;
        $website->save();

        $client = Client::find($website->client_id);
        if($client){
            $email = $client->default_user[0]->email;
            $body = '<h3>لقد تم حظر موقعك "<span>'.$website->name_ar.'</span>" <span>وذلك للأسباب التالية :</span></h3>';
            $body .= '<p>'.$request->block_reason.'</p>';
            mailit($email, "حظر موقع", $body);
            notification("block_website", $client->id, $website->id, $body);
        }


        return back()->with("success", "تم حظر الموقع");
    }

    public function unblock($id = null){
        if(!permissions("websites_block"))
            return redirect()->route("admin.settings.no_permissions");

        $website = Website::find($id);
        if(!$website)
            return back();

        $website->status = 1;
        $website->block_reason = null;
        $website->save();

        $client = Client::find($website->client_id);
        if($client) {
            $body = '<h3>لقد تم رفع الحظر عن موقعك "<span>'.$website->name_ar.'</span>"';
            //notification("unblock_website", $client->id, $website->id, $body);
        }

        return back()->with("success", "تم رفع حظر الموقع");
    }

}
