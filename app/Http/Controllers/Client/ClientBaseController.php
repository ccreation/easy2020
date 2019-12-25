<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use Auth;
use App\Client;
use App\Plan;
use App\ClientSetting;
use App\Website;
use App\Setting;
use App\Notification;


class ClientBaseController extends Controller{

    public $client      = null;
    public $redirectTo  = "home";
    public $lang        =  "ar";
    public $my_plugins  = null;
    public $admin_settings = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        date_default_timezone_set('Asia/Riyadh');
        $this->middleware("auth:client")->except("login", "do_login", "showLinkRequestForm", "sendResetLinkEmail", "showResetForm", "reset");
        $this->middleware("guest:client")->only("login", "do_login", "showLinkRequestForm", "sendResetLinkEmail", "showResetForm", "reset");
        $this->middleware('language');
        $this->middleware('pages');
        $this->middleware(function($request,$next) {
            $c                  = Client::find($request->client->id);
            $this->client       = $c;
            View::share("client", $this->client);
            $plan               = Plan::find($c->plan_id);
            View::share("my_plan", $plan);
            $this->lang         = $request->langg;
            View::share("lang", $this->lang);
            $websites           = Website::where("client_id", $c->id)->count();
            View::share("my_websites", $websites);
            $this->my_plugins   = $c->my_plugins->KeyBy("id");
            View::share("my_plugins", $this->my_plugins);

            /*

            $new_notifications  = Notification::where(["client_id" => $c->id, "status" => 0])->orderby("created_at", "desc")->get();
            $new_notifications  = ($new_notifications) ? $new_notifications : collect();
            View::share("new_notifications", $new_notifications);

            $size0 = 0;
            $f = storage_path("app/uploads/client/".$c->id);
            if(is_dir($f)){
                $io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
                $size = fgets ( $io, 4096);
                $size = substr ( $size, 0, strpos ( $size, "\t" ) );
                $size0 += $size;
                pclose ( $io );
            }
            $f = storage_path("app/uploads/clients/".$c->id);
            if(is_dir($f)){
                $io = popen ( '/usr/bin/du -sk ' . $f, 'r' );
                $size = fgets ( $io, 4096);
                $size = substr ( $size, 0, strpos ( $size, "\t" ) );
                $size0 += $size;
                pclose ( $io );
            }
            View::share("my_size", intval($size0/1024));


            $this->frontLang    = $request->frontLang;
            View::share("frontLang", $this->frontLang);
            $this->redirectTo   = $request->redirectTo;
            $admin_settings     = Setting::all()->keyby("key");
            $this->admin_settings   = $admin_settings;
            View::share("admin_settings", $admin_settings);
            */
            return $next($request);
        });
    }

    // Statistics

    /**
     * Home Page for Client dasboard
     *
     * @return void
     */
    public function index(){
        if(!cpermissions("home_preview"))
            return redirect()->route("client.settings.no_permissions");

        return view("client.home");
    }

    public function statistics(){
        if(!cpermissions("statistics_preview"))
            return redirect()->route("client.settings.no_permissions");

        return view("client.statistics");
    }

    public function locale($locale = "ar"){
        \Session::put('locale', $locale);
        return redirect()->back();
    }

    public function hyperpay(){
        $responseData = $this->requestt(90);
        $responseData = json_decode($responseData);
        $checkoutId = (@$responseData->id) ? @$responseData->id : null;

        return view("hyperpay", compact("checkoutId"));
    }

    public function hyperpay_redirect(Request $request){
        if($request->resourcePath){
            $result = $this->check($request->resourcePath, $request->id);
            print_r(@$result->result);
            echo "<hr>";
            if(preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', @$result->result->code) or
                preg_match('/^(000\.400\.0[^3]|000\.400\.100)/', @$result->result->code) or
                preg_match('/^(000\.200)/', @$result->result->code))
                echo "okkkkkkkkkkkk";
            else
                echo @$result->result->description;
        }
    }

    function requestt($amount) {
        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4c96abf404b016ac07397f4036f" .
            "&amount=".$amount .
            "&currency=SAR" .
            "&paymentType=DB&createRegistration=1";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjN2E0Yzg2YThiZTJkMjAxNmE5NmU1ZWRhMDEwNzZ8Tk05ZGVhN0RGNw=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    function check($url, $id){
        $url = "https://test.oppwa.com/v1/checkouts/".$id."/payment";
        $url .= "?entityId=8ac7a4c96abf404b016ac07397f4036f";

        try{

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization:Bearer OGFjN2E0Yzg2YThiZTJkMjAxNmE5NmU1ZWRhMDEwNzZ8Tk05ZGVhN0RGNw=='));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            curl_close($ch);
            return (json_decode($responseData));
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }


}
