<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use Illuminate\Support\Facades\App;
use Auth;
use Session;
use App\ClientUser;
use App\ClientSetting;
use Storage;

class Pages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        date_default_timezone_set('Asia/Riyadh');

        if(!Auth::guard("client")->check() and !Auth::guard("web")->check())
            return redirect()->route("client.login");

        $client             = Session::get("myclient");

        if ($client === null or @$client->status==0){
            Auth::guard("web")->logout();
            $request->session()->forget("web");
            Auth::guard("client")->logout();
            $request->session()->forget("client");
            return redirect()->route("home");
        }

        $client_user        = Auth::guard("client")->user();
        if(Auth::guard("web")->check()){
            $client_user    = ClientUser::find(1);
        }else{
            if ($client_user->client_id != @$client->id){
                Auth::guard("web")->logout();
                $request->session()->forget("web");
                Auth::guard("client")->logout();
                $request->session()->forget("client");
                return redirect()->route("home");
            }
        }

        $settings           = ClientSetting::where("client_id", $client->id)->get()->keyBy("key");
        $client->settings   = $settings;

        $lang               = @$settings["default_lang"];
        $lang               = ($lang)?$lang->value:"ar";

        $frontLang          = @$settings["website_default_lang"];
        $frontLang          = ($frontLang)?$frontLang->value:"ar";

        $request->merge(["client" => $client, "redirectTo" => "client/home", "langg" => $lang, "frontLang" => $frontLang]);
        
        if(!file_exists(storage_path("app/uploads/clients/".$client->id)))
            Storage::disk('local')->makeDirectory("uploads/clients/".$client->id);

        return $next($request);
    }
}
